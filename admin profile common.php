<?php
$name=$_SESSION['name'];
$contact=$_SESSION['contact'];
$email=$_SESSION['email'];
$image=$_SESSION['image'];
?>
<html>
<head>
	<style>
	@import "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
	
	#details
	{
		width:250px;
		height:415px;
		position:absolute;
		top:14%;
		left:76%;
		transform:translate(-50%,50%);
		color:black;
		box-shadow:5px 5px 5px 5px grey;
		padding:20px;
		background-color:rgba(192,192,192,0.2);
		border-radius:25px;
		text-align:center;
	}
	#details img
	{
		border-color:#666666;
		box-shadow:0 0 8px 0 #666666;	
	}
	#number
	{
		width:100%;
		overflow:hidden;
		font-size:20px;
		padding:8px 0;
		margin:8px 0;
		border-bottom:1px solid #003366;	
	}
	#number i
	{
		width:26px;
		float:left;
		text-align:center;
		color:black;
	}
	#number p
	{
		border:none;
		outline:none;
		background:none;
		color:black;
		font-size:18px;
		width:80%;
		float:left;
		margin:0 10px;
	}
	</style>
</head>

<div id="details">
					<?php echo"<img src='img/$image' height='50%' width='55%' style='border-radius:70px;'>"; ?>
					
					<div>
					<p style="font-size:17px;"><a href="update profile.php" style="text-align:center;"> Update Profile ?</a></p>
					<?php echo"<h2>$name</h2>"; ?>
					</div>
			
					<div id="number">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<?php echo"<p>$email</p>"; ?>
					</div>
			
					<div id="number">
					<i class="fa fa-phone" aria-hidden="true"></i>
					<?php echo"<p>+91-$contact</p>"; ?>
					</div>
</div>