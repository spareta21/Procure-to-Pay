<?php
include("admin common.php");
include("connectivity.php");

session_start();
$u=$_SESSION['username'];
$sql2="select Name from registration where Username='$u'";
$retval2=$conn->query($sql2);
if(!$retval2)
	die('could not get data'.mysql_error());
while($row2=$retval2->fetch_assoc())
{
	$name=$row2['Name'];
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
					
					
		
		Name: <font color="#FF0000">*</font><br />
		<input type="text" name="name" placeholder="Name" required>
		<br /><br />
		
		Email: <font color="#FF0000">*</font><br />
		<input type="text" name="email" placeholder="E-Mail" required>
		<br /><br />
		
		Username: <font color="#FF0000">*</font><br />
		<input type="text" name="uname" placeholder="Username" required>
		<br /><br />
		
		Password: <font color="#FF0000">*</font><br />
		<input type="password" name="upass" placeholder="Password" required>
		<br /><br />
		
		Contact Number: <font color="#FF0000">*</font><br />
		<input type="number" name="contact" placeholder="Contact Number" required>
		<br /><br />
		
		Account Number: <font color="#FF0000">*</font><br />
		<input type="number" name="accno" placeholder="Account Number" required>
		<br /><br />
		
		Address: <font color="#FF0000">*</font><br />
		<textarea name="addr" cols="30" rows="5" required placeholder="Your Address"></textarea >
		<br /><br />
		
		Upload Image: <font color="#FF0000">*</font><br />
		<input type="file" name="img" required>
		<br /><br />
		
		User Type: <font color="#FF0000">*</font><br />
		<select name="type" required>
			<option value="Admin">Admin</option>
			<option value="Employee">Employee</option>
			<option value="Manager">Manager</option>
			<option value="Vendor">Vendor</option>
			<option value="Finance Department">Finance Department</option>
		</select>
		<br /><br />
		
		<input type="submit" name="submit" value="Register User" id="click">
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
	$uname=$_POST['uname'];
	$upass=$_POST['upass'];
	$contact=$_POST['contact'];
	$addr=$_POST['addr'];
	$type=$_POST['type'];
	$accno=$_POST['accno'];
	move_uploaded_file($_FILES['img']['tmp_name'],"img/".$_FILES['img']['name']);
 	$pic=$_FILES['img']['name'];
	if(strcmp($type,'Vendor')==0)
	{
			$query="insert into registration values ('$name','$email','$uname','$upass','$contact','$addr','$accno','$pic','$type')";
			$query1="insert into vendor (VendorName,Location,Username,AccountNumber) values ('$name','$addr','$uname','$accno')";
			if($conn->query($query)===True && $conn->query($query1)===True)
			{
				echo "<script>alert('$type Register Successfully')</script>";
			}
			else
			{
				die('could not insert values');
			}
	}
	else
	{
			
			$query="insert into registration values ('$name','$email','$uname','$upass','$contact','$addr','$accno','$pic','$type')";
			if($conn->query($query)===True)
			{
				die('could not insert values');
			}
			else
			{
				echo "<script>alert('$type Register Successfully')</script>";
			}
	}
}
?>