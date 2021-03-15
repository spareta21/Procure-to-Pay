<?php
include("index common.php");
?>
<br>
<html>
	<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  		<style>
		ul li
		{
			font-size:16px;
			font-family:"Times New Roman", Times, serif;
			line-height:30px;
		}
		</style>
		<title>About Us</title>
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
					
						<a href="index.php">Home</a> > About Us
						<br />
			<h2 style="font-family:Arial, Helvetica, sans-serif;">About Us</h2>
			<hr style="width:100%; border-width:3px; margin-top:-10px;" align="left">
				<ul style="list-style-type:disc">		
					<li>The Procure-to-Pay is a process in which an organization purchases the raw materials and services which are required to do business.</li> 

<li>It is the process of requisitioning, purchasing, receiving, paying and accounting for goods and services.</li>

<li>It involves the number of sequential stages, ranging from need identification to invoice approvals and vendor payment.</li>

<li>Employees can create requisitions according to the requirement by the items list. List contains item ID, item name, price, quantity, UOM.</li>

<li>Only Procurement Manager can approve/reject requisitions, goods receipts and invoices.</li>

<li>Procurement Manager can also create purchase orders (containing requisition information, shipping address and vendor�s information like vendor�s ID, name and location) for the approved purchase requisitions.</li>

<li>Rejected Requisition will update the status as rejected and show notification to the Employee.</li>

<li>It is mandatory to specify the valid reason to rejecting a document.</li>

<li>If vendor does not have sufficient items specified in purchase order, then they have to reject it.</li>

<li>Approved purchase order will create Goods Receipt (containing Receipt ID, issued by and issued date) for the delivered items.</li>

<li>Manager will inspect goods and approve/reject goods receipt.</li>

<li>Approved goods receipt will leads to create invoice bill which contains Invoice ID, Net amount, Total discount, Issued by, Issued date.</li> 

<li>A three-way match between the purchase order, the vendor invoice, and the goods receipt is performed by the Manager to approve invoice.</li>

<li>Finance Department will make payment for the approved invoices.</li>

<li>Ones the rejection takes place, whole process will stop.</li>
</ul>
<br>
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
<?php
include("common2.php");
?>
</body>
</html>