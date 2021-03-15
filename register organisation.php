<?php
session_start();
include("admin common.php");
include("connectivity.php");
$u=$_SESSION['username'];
$sql="select Name from registration where Username='$u'";
$retval=$conn->query($sql);
if(!$retval)
	die('could not get data'.mysql_error());
while($row=$retval->fetch_assoc())
{
	$name=$row['Name'];
}
?>
<html>
<head>
<style>
		
		#option td
		{
			width:20%;	
		}
		#option td a
		{
			font-weight:bold;
			color:#FFFFFF;
			text-decoration:none;
		}
		#option td:hover
		{
			background-color:#003333;
			color:#FFFFFF;	
			cursor:pointer;	
			border-radius:13px;
		}
		input[type=text]
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
		input[type=text]:focus
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
</head>
	<body>
		<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					<?php echo "<h1>Hello, $name</h1>"; ?>
					
					<form action="" method="post" enctype="multipart/form-data">
					
					Organisation Name: <font color="#FF0000">*</font><br />
		<input type="text" name="orgname" placeholder="Your Organisation Name" required /><br /><br />
		
		Organisation Place: <font color="#FF0000">*</font><br />
		<input type="text" name="orgplace" placeholder="Your Organisation Place" required /><br /><br />
		
		<input type="submit" name="submit" value="Register" id="click">
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
	$oname=$_POST['orgname'];
	$oplace=$_POST['orgplace'];
	$sql="insert into organisation (OrganisationName, OrganisationPlace)values('$oname','$oplace')";
 	$retval=$conn->query($sql);
 	if(!$retval)
 	{
  		die('could not get data'.$conn->connect_error());
 	}
	else
	{
		echo "<script>alert('Registered successfully')</script>";
	}
	
}		
?>