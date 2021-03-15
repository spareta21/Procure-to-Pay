<?php
include("vendor common.php");
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

$sql1="select VendorID from vendor where Username='$u'";
$retval1=$conn->query($sql1);
if($conn->query($sql1)===False)
	die('could not get data');
else
{
	while($row1=$retval1->fetch_assoc())
	{
		$vendorID=$row1['VendorID'];
	}
}
$_SESSION['vendorID']=$vendorID;
?>
<html>
<head>
	<title>Vendor Home</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <h3>Total Goods Receipt Created:</h3>
					 <?php
					 $query="select inventory.ReceiptID,inventory.PONumber,registration.Name,inventory.Status,inventory.InvoiceStatus from inventory,registration where inventory.VendorID=$vendorID and inventory.Username=registration.Username";
					 $result=$conn->query($query);
					 if(!$result)
					 	die('could not get data');
					if(mysqli_num_rows($result)>0)
					{
						echo "<table width='60%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
						echo "<tr align='center'><th>Receipt ID</th><th>PO Number</th><th>Buyer's Name</th><th>Status</th><th>Invoice Status</th></tr>";
						while($rw=$result->fetch_assoc())
						{
							echo "<tr>";
							echo "<td>".$rw['ReceiptID']."</td>";
							echo "<td>".$rw['PONumber']."</td>";
							echo "<td>".$rw['Name']."</td>";
							echo "<td>".$rw['Status']."</td>";
							echo "<td>".$rw['InvoiceStatus']."</td>";
							echo "</tr>";
						}
						echo "</table>";
					 }
					 else
					 {
					 	echo "No goods receipts created yet";
					 }
					 ?>
					 <h3>Total Invoice Created:</h3>
					 <?php
					 $query1="select InvoiceID,NetAmount,DisAllowed,PaymentStatus,PONumber from invoice where VendorID=$vendorID";
					 $result1=$conn->query($query1);
					 if(!$result1)
					 	die('could not get data');
					if(mysqli_num_rows($result1)>0)
					{
						echo "<table width='60%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
						echo "<tr align='center'><th>Invoice ID</th><th>PO Number</th><th>Net Amount</th><th>Disount Allowed</th><th>Payment Status</th></tr>";
						while($rw1=$result1->fetch_assoc())
						{
							echo "<tr>";
							echo "<td>".$rw1['InvoiceID']."</td>";
							echo "<td>".$rw1['PONumber']."</td>";
							echo "<td>".$rw1['NetAmount']."</td>";
							echo "<td>".$rw1['DisAllowed']."</td>";
							echo "<td>".$rw1['PaymentStatus']."</td>";
							echo "</tr>";
						}
						echo "</table>";
					 }
					 else
					 {
					 	echo "No invoice created yet";
					 }
					 ?>
				</td>
			</tr>
		</table>
		
		</body>
		</html>
		<?php
		include("common2.php");
		include("admin profile common.php");
		?>