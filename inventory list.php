<?php
include("manager common.php");
include("connectivity.php");

session_start();
$u=$_SESSION['username'];
$sql="select Name,Email,ContactNo,Image from registration where Username='$u'";
$retval=$conn->query($sql);
if(!$retval)
	die('could not get data'.mysql_error());
while($row=$retval->fetch_assoc())
{
	$name=$row['Name'];
	$email=$row['Email'];
	$contact=$row['ContactNo'];
	$image=$row['Image'];
}
$_SESSION['name']=$name;
$_SESSION['email']=$email;
$_SESSION['contact']=$contact;
$_SESSION['image']=$image;


	
?>
<html>
<head>
	<title>Inventory Receipt List</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 Inventory Receipt List
					 <br>
					 <h3>Pending Goods Receipt List</h3>
					 <?php
					 	$query="select ReceiptID,VendorID,PONumber,RequisitionID,IssuedBy,IssuedDate from inventory where status='Not Approved'";
						$result=$conn->query($query);
						if(!$result)
							die('could not get data');
						if(mysqli_num_rows($result)>0)
						{
							echo "<table width='68%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
							echo "<tr align='center'><th>Receipt ID</th><th>Vendor ID</th><th>Purchase Order Number</th><th>Requisition ID</th><th>Issued By</th><th>Issued Date</th><th>Action</th></tr>";
							while($rw=$result->fetch_assoc())
							{
								echo "<tr align='center'>";
								$receiptID=$rw['ReceiptID'];
								$vendorID=$rw['VendorID'];
								$POid=$rw['PONumber'];
								$reqID=$rw['RequisitionID'];
								$issuedBy=$rw['IssuedBy'];
								$issuedDate=$rw['IssuedDate'];
								echo "<td>".$receiptID."</td>";
								echo "<td>".$vendorID."</td>";
								echo "<td>".$POid."</td>";
								echo "<td>".$reqID."</td>";
								echo "<td>".$issuedBy."</td>";
								echo "<td>".$issuedDate."</td>";
								echo "<form method='post'>";
								echo "<input type='hidden' value='".$receiptID."' name='id'>";
								echo "<td><input type='submit' value='View Details' name='view'></td></form>";
								echo "</tr>";
							}
							echo "</table>";
						}
						else
							echo "No pending receipts found";
					 ?>
					 
					 <h3>Approved Goods Receipt List</h3>
					 <?php
					 	$query="select ReceiptID,VendorID,PONumber,RequisitionID,IssuedBy,IssuedDate from inventory where status='Approved'";
						$result=$conn->query($query);
						if(!$result)
							die('could not get data');
						if(mysqli_num_rows($result)>0)
						{
							echo "<table width='68%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
							echo "<tr align='center'><th>Receipt ID</th><th>Vendor ID</th><th>Purchase Order Number</th><th>Requisition ID</th><th>Issued By</th><th>Issued Date</th></tr>";
							while($rw=$result->fetch_assoc())
							{
								echo "<tr align='center'>";
								$receiptID=$rw['ReceiptID'];
								$vendorID=$rw['VendorID'];
								$POid=$rw['PONumber'];
								$reqID=$rw['RequisitionID'];
								$issuedBy=$rw['IssuedBy'];
								$issuedDate=$rw['IssuedDate'];
								echo "<td>".$receiptID."</td>";
								echo "<td>".$vendorID."</td>";
								echo "<td>".$POid."</td>";
								echo "<td>".$reqID."</td>";
								echo "<td>".$issuedBy."</td>";
								echo "<td>".$issuedDate."</td>";
								echo "</tr>";
							}
							echo "</table>";
						}
						else
							echo "No approved receipts found";
					 ?>
					 
				</td>
			</tr>
		</table>
		
		</body>
		</html>
		<?php
		include("common2.php");
		include("admin profile common.php");
		if(isset($_POST['view']))
		{
			echo $inventoryID=$_POST['id'];
			$_SESSION['inventoryID']=$inventoryID;
			header("location:receipt page.php");
		}
		?>