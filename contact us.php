<?php
include("index common.php");
?>
<br>
<html>
	<head>
		<style>
		input[type=text]
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
		input[type=text]:focus
		{
			border-color:dodgerBlue;
			box-shadow:0 0 8px 0 dodgerBlue;
		}
		textarea
		{
			width:60%;
			border:2px solid #aaa;
			border-radius:4px;
			margin:8px 0px;
			outline:none;
			padding:8px;
			box-sizing:border-box;
			transition:1s;
			font-size:16px;
		}
		textarea:focus
		{
			border-color:dodgerBlue;
			box-shadow:0 0 8px 0 dodgerBlue;
		}
		</style>
		<title>Contact Us</title>
	</head>
	<body>
		<table border="0" width="80%" height="100%" align="center" bgcolor="#FFFFFF">
			<tr>
				<td rowspan="2" width="70%" valign="top">
					<br />
					<br />
					
					<table border="0" width="90%" height="80%" align="center">
				<tr>
					<td valign="top">	
					
					
					
					
						<a href="index.php">Home</a> > Contact Us
						<br />
			<h2 style="font-family:Arial, Helvetica, sans-serif;">Contact Us</h2>
			<hr style="width:100%; border-width:3px; margin-top:-10px;" align="left">
				<br />		
		<form action="" method="post">
		Name: <font color="#FF0000">*</font><br />
		<input type="text" name="name" placeholder="Your Name" required /><br /><br />
		
		E-mail: <font color="#FF0000">*</font><br />
		<input type="text" name="email"  placeholder="Your E-Mail" required /><br /><br />
		
		Mobile No: <font color="#FF0000">*</font><br />
		<input type="text" name="number"  placeholder="Your Mobile No." required /><br /><br />
		
		Subject: <font color="#FF0000">*</font><br />
		<textarea name="subject" rows="5" cols="50" placeholder="Your Subject" required ></textarea><br /><br />
		
		<input id="click" type="submit" name="submit" value="Click Here" style="background-color:#DF7000; color:#FFFFFF; border-radius:20px; height:30px; width:100px;" />
		
		<h3 style="color:#941714; font-size:20px;">Contact Details</h3>
MITWPU,<br>
Pune(Maharashtra)<br><br>
<b>Contact Number:</b><br>+919754536878,+919406736916<br><br>
<b>Follow Us On:</b>
<br>
<img src="img/insta1.png">
<img src="img/twitter1.png">
<img src="img/fb1.png">
<img src="img/whatsapp1.png">
<img src="img/gmail1.png">
		
		</form>
				</td>
			</tr>
		</table>
		</td>
		<td>
			<img src="img/side2.jpg" width="100%" height="60%" style="border-radius:30px;" />
		</td>
	</tr>
	<tr>
		<td>
		<img src="img/side3.jpg" width="100%" height="60%" style="border-radius:30px;" />
		</td>
	</tr>
</table>
</body>
</html>
<?php
include("common2.php");
include("connectivity.php");
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$number=$_POST['number'];
	$subject=$_POST['subject'];
	$sql="insert into contact (name,email,contact,subject) values ('$name','$email','$number','$subject');";
	if ($conn->query($sql) === TRUE)
  		echo "<script>alert('New record created successfully')</script>";
 	else 
  		echo "Error: " . $sql . "<br>" . $conn->connect_error;
$conn->close();
}
?>