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
	<title>Invoice Creation</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <a href="goods receipt list.php">Goods Receipt List</a> > <a href="goods receipt page.php">Goods Receipt Page</a> > Invoice Creation
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
					 <table style="border-collapse:collapse; float:left;" cellpadding="5px">
					 <tr><td><b>Receipt ID:</b></td><td><?php echo $receiptID; ?></td></tr>
					 <tr><td><b>Issued By:</b></td><td><?php echo $issuedBy; ?></td></tr>
					 <tr><td><b>Issued Date:</b></td><td><?php echo $issuedDate; ?></td></tr>
					 <tr><td><b>PO Number:</b></td><td><?php echo $POid; ?></td></tr>
					 <tr><td><b>Requisition ID:</b></td><td><?php echo $reqID; ?></td></tr>
					 <tr><td><b>Requested Username :</b></td><td><?php echo $uname; ?></td></tr>
					 <tr><td><b>Shipping Address:</b></td><td><?php echo $addr; ?></td></tr>
					 <tr><td><b>Vendor ID:</b></td><td><?php echo $vendorID; ?></td></tr>
					 <tr><td><b>Vendor Name:</b></td><td><?php echo $vendorName; ?></td></tr>
					 <tr><td><b>Receipt Status:</b></td><td><?php echo $status; ?></td></tr></table>
					 <form action="" method="post">
					 <table border="0" cellpadding="5px" style="border-collapse:collapse;">
					 <tr align="left"><th>Invoice Issued By</th><td><?php echo $issuedBy ?></td></tr>
					 <tr align="left"><th>Invoice Issued Date</th><td><?php echo $date=date("d.m.Y") ?></td></tr>
					 </table>
					 </form>
					 <br><br><br><br><br><br><br><br><br><br><br><br>
					 <?php
					 $query1="SELECT items.ItemID, ItemName, Price, Quantity
FROM items, requisition
WHERE items.ItemID = requisition.ItemID
AND RequisitionID =$reqID";
					$total=0;
					 $result1=$conn->query($query1);
					 if(!$result1)
					 	die('could not get data');
					 echo "<table border='1' cellpadding='8px' style='border-collapse:collapse;'>";
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
						$total=$total+($price*$qty);
						echo "<tr>";
					 }
					 if($total>=5000)
							$dis=($total*0.05);
					else if($total>=10000)
							$dis=($total*0.1);
						else
							$dis=0;
							
					$netAmt=$total-$dis;
					 echo "<tr><th colspan=2>Net Amount</th><td colspan=2 align='center'>$netAmt</td></tr>";
					echo "<tr><th colspan=2>Discount Allowed</th><td align='center' colspan=2>$dis</td></tr>"; 
					 echo "</table>";
					 ?><br>
					 <font color="red">Note:Total Amount above 5000 Rs allows 5% discount and above 10000 Rs allows 10% discount </font>
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
			$sql1="insert into invoice(InvoiceIssuedBy,InvoiceIssuedDate,NetAmount,DisAllowed,ReceiptID,PONumber,RequisitionID,ReqUsername,ShippingAddress,VendorID,VendorName) values ('$issuedBy','$date',$netAmt,$dis,$receiptID,$POid,$reqID,'$uname','$addr',$vendorID,'$vendorName')";
			$sql2="update inventory set InvoiceStatus='Yes' where ReceiptID=$receiptID";
			
			if($conn->query($sql1)===True && $conn->query($sql2)===True)
			{
				echo "<script>alert('Invoice Created Successfully')</script>";
				header("location:goods receipt list.php");
			}
			else
				die('could not insert data');
		}
		?>