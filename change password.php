<?php
include("connectivity.php");
session_start();
$u=$_SESSION['username'];
$sql="select UserType,Name from registration where username='$u'";
$retval=$conn->query($sql);
if(!$retval)
	die('could not get data'.mysql_error());
while($row=$retval->fetch_assoc())
{
	$usertype=$row['UserType'];
	$name=$row['Name'];
}
if(strcmp($usertype,'Admin')==0)
	include("admin common.php");
else if(strcmp($usertype,'Employee')==0)
	include("employee common.php");
else if(strcmp($usertype,'Manager')==0)
	include("manager common.php");
?>
<html>
<head>
<style>
		
		
		input
		{
			width:60%;
			border:2px solid #aaa;
			border-radius:4px;
			margin:8px 0px;
			outline:none;
			padding:8px;
			box-sizing:border-box;
			transition:1s;
		}
		input:focus
		{
			border-color:dodgerBlue;
			box-shadow:0 0 8px 0 dodgerBlue;
		}
		#click
		{
			width:20%;
			background:rgba(60,60,60,0.3);
			border: 2px solid #003366;
			color:003366;
			padding:5px;
			font-size:18px;
			cursor:pointer;
			margin:12px 0;	
		}
</style>
<title>Change Password</title>
</head>
	<body>
		<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					<?php echo "<h1>Hello, $name</h1>"; ?>
					
					<form method="post">
					
					Old Password: <font color="#FF0000">*</font><br />
		<input type="password" name="oldpass" placeholder="Old Password" required /><br /><br />
		
		New Password: <font color="#FF0000">*</font><br />
		<input type="password" name="newpass" placeholder="New Password" required /><br /><br />
		
		Confirm New Password: <font color="#FF0000">*</font><br />
		<input type="password" name="confirmpass" placeholder="Confirm New Password" required /><br /><br />
		
		<input type="submit" name="submit" value="Submit" id="click">
					</form>
					
					
				</td>
				<td valign="top" align="center">
					<?php 
					include("admin profile common.php");
					?>
				</td>
			</tr>
		</table>
		
		</body>
		</html>
<?php
include("common2.php");
if(isset($_POST['submit']))
{
	$oldpass=$_POST['oldpass'];
	$newpass=$_POST['newpass'];
	$confirmpass=$_POST['confirmpass'];
	$sql1="select Password from registration where Username='$u'";
	$retval1=$conn->query($sql1);
	if(!$retval1)
		die('could not get data'.mysql_error());
	while($row1=$retval1->fetch_assoc())
	{
		$op=$row1['Password'];
	}
	if(strcmp($oldpass,$op)==0)
	{
		if(strcmp($newpass,$confirmpass)==0)
		{
			$sql2="update registration set Password='$newpass' where Username='$u'";
			$retval2=$conn->query($sql2);
			if(!$retval2)
				die('could not get data'.mysql_error());
			else
				echo "<script>alert('Update Password Successfully')</script>";
		}
		else
			echo "<script>alert('New Password and Confirm Password does not match')</script>";
	}
	else
		echo "<script>alert('Old Password is incorrect')</script>";
}
?>