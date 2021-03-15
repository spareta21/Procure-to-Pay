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

$vendorID=$_SESSION['vendorID'];

	
?>
<html>
<head>
	<title>Goods Receipt Page</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <a href="goods receipt list.php">Goods Receipt List</a> > Goods Receipt Page
					 <br><br>
					 <?php
					 $query="select * from inventory where VendorID=$vendorID";
					 $result=$conn->query($query);
					 if(!$result)
					 	die('could not get data');
						
						while($rw=$result->fetch_assoc())
						{
							$receiptID=$rw['ReceiptID'];
							$issuedBy=$rw['IssuedBy'];
							$issuedDate=$rw['IssuedDate'];
							$POid=$rw['PONumber'];
							$reqID=$rw['RequisitionID'];
							$uname=$rw['Username'];
							$addr=$rw['ShippingAddress'];
							$vendorName=$rw['VendorName'];
							$status=$rw['Status'];
						}
					 ?>
					 <table style="border-collapse:collapse;" cellpadding="5px">
					 <tr><td><b>Receipt ID:</b></td><td><?php echo $receiptID; ?></td></tr>
					 <tr><td><b>Issued By:</b></td><td><?php echo $issuedBy; ?></td></tr>
					 <tr><td><b>Issued Date:</b></td><td><?php echo $issuedDate; ?></td></tr>
					 <tr><td><b>PO Number:</b></td><td><?php echo $POid; ?></td></tr>
					 <tr><td><b>Requisition ID:</b></td><td><?php echo $reqID; ?></td></tr>
					 <tr><td><b>Username :</b></td><td><?php echo $uname; ?></td></tr>
					 <tr><td><b>Shipping Address:</b></td><td><?php echo $addr; ?></td></tr>
					 <tr><td><b>Vendor ID:</b></td><td><?php echo $vendorID; ?></td></tr>
					 <tr><td><b>Vendor Name:</b></td><td><?php echo $vendorName; ?></td></tr>
					 <tr><td><b>Status:</b></td><td><?php echo $status; ?></td></tr></table><br>
					 <?php
					 $query1="SELECT items.ItemID, ItemName, Price, Quantity
FROM items, requisition
WHERE items.ItemID = requisition.ItemID
AND RequisitionID =$reqID";
					 $result1=$conn->query($query1);
					 if(!$result1)
					 	die('could not get data');
					 echo "<table border='1' cellpadding='10px' style='border-collapse:collapse;'>";
					 echo "<tr><th>Item ID</th><th>Item Name</th><th>Price</th><th>Quantity</th></tr>";
					 while($row2=$result1->fetch_assoc())
					 {
					 	$itemID=$row2['ItemID'];
						$itemName=$row2['ItemName'];
						$price=$row2['Price'];
						$qty=$row2['Quantity'];
					 	echo "<tr>";
						echo "<td>".$itemID."</td>";
						echo "<td>".$itemName."</td>";
						echo "<td>".$price."</td>";
						echo "<td>".$qty."</td>";
						echo "<tr>";
					 }
					 echo "</table>";
					 ?>
					 <br><br>
					 <form method="post">
					 <input type="submit" name="submit" value="Continue to create Invoice" style="font-size:14px; font-family:monospace, cursive; border-radius:5px;">
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
			header("location:create invoice.php");
		}
		?>