<?php
include("title logo common.php");
?>
<html>
<head>
<style>
		
		
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
				<table border="0" align="center" width="90%" height="100%" id="option">
					<tr align="center" style="color:#FFFFFF">
						<td ><a href="manager home.php">Dashboard</a></td>
						<td ><a href="requisition list.php">Requisition List</a></td>
						<td ><a href="inventory list.php">Inventory List</a></td>
						<td ><a href="invoice list.php">Invoice List</a></td>
						<td ><a href="change password.php">Change Password</a></td>
						<td ><a href="logout.php">Log Out</a></td>
					</tr>
				</table>
			</td>
			</tr>
		</table>