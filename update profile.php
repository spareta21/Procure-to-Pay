<?php
session_start();
include("connectivity.php");
$username=$_SESSION['username'];
$sql1="select * from registration where Username='$username'";
$retval1=$conn->query($sql1);
if(!$retval1)
	die('could not get data'.mysql_error());
	
while($row1=$retval1->fetch_assoc())
{
	$name=$row1['Name'];
	$email=$row1['Email'];
	$contact=$row1['ContactNo'];
	$addr=$row1['Address'];
	$image=$row1['Image'];
	$usertype=$row1['UserType'];
}
if(strcmp($usertype,'Admin')==0)
	include("admin common.php");
else if(strcmp($usertype,'Employee')==0)
	include("employee common.php");
else if(strcmp($usertype,'Manager')==0)
	include("manager common.php");
else if(strcmp($usertype,'Vendor')==0)
	include("vendor common.php");


?>
<html>
<head>
<style>
		
		input,select,textarea
		{
			width:40%;
			border:2px solid #aaa;
			border-radius:4px;
			margin:8px 0px;
			outline:none;
			padding:8px;
			box-sizing:border-box;
			transition:1s;
		}
		input:focus, select:focus, textarea:focus
		{
			border-color:dodgerBlue;
			box-shadow:0 0 8px 0 dodgerBlue;
		}
		#click
		{
			width:15%;
			background:rgba(60,60,60,0.3);
			border: 2px solid #003366;
			color:003366;
			padding:5px;
			font-size:18px;
			cursor:pointer;
			margin:12px 0;	
		}
</style>
</head>
	<body>
		<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					<?php echo "<h1>Hello, $name</h1>"; ?>
					
					<form action="" method="post" enctype="multipart/form-data">
		
		Name: <font color="#FF0000">*</font><br />
		<input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required >
		<br /><br />
		
		Email: <font color="#FF0000">*</font><br />
		<input type="text" name="email" placeholder="E-Mail" value="<?php echo $email; ?>" required>
		<br /><br />
		
		Contact Number: <font color="#FF0000">*</font><br />
		<input type="number" name="contact" placeholder="Contact Number" value="<?php echo $contact; ?>" required >
		<br /><br />
		
		Address: <font color="#FF0000">*</font><br />
		<input type="text" name="addr" placeholder="Address" value="<?php echo $addr; ?>" required >
		<br /><br />
		
		Upload Image: <font color="#FF0000">*</font><br />
		<input type="file" name="img" required>
		<br /><br />
		
		<input type="submit" name="submit" value="Update" id="click">
					</form>
					
					
				</td>
				
			</tr>
		</table>
		
		</body>
		</html>
<?php
include("common2.php");
include("admin profile common.php");

if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$address=$_POST['addr'];
	move_uploaded_file($_FILES['img']['tmp_name'],"img/".$_FILES['img']['name']);
	$f=$_FILES['img']['name'];
	$sql="update registration set Name='".$name."',Email='".$email."',ContactNo='".$contact."',Image='".$f."',Address='".$addr."' where Username='".$username."'";
	$result=$conn->query($sql);
	if(!$result)
	{
		die('could not update values'.$conn->connect_error());
	}
	else
	{
		echo "<script>alert('Profile Updated Successfully')</script>";
	}
}
?>