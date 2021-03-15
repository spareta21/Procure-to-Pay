<?php
include("title logo common.php");
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
		</style>
</head>
	<body>
	<br>
		<table border="1" width="80%" height="7%" align="center" style="border-collapse:collapse;border-radius:13px; " bgcolor="#DF7000">
			<tr>
			<td>
				<table border="0" width="80%" height="100%"  style="margin-left: 100px;" id="option">
					<tr align="center" style="color:#FFFFFF">
						<td ><a href="admin home.php">Dashboard</a></td>
						<td ><a href="registeration page.php">Registration Page</a></td>
						
						<td ><a href="change password.php">Change Password</a></td>
						<td ><a href="logout.php">Log Out</a></td>
					</tr>
				</table>
			</td>
			</tr>
		</table>