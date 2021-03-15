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
	<title>Receipt Page</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <a href="inventory list.php">Inventory Receipt List</a> > Receipt Page
					 <br><br>
					 <?php
					 $inventoryID=$_SESSION['inventoryID'];
					 $query="select ReceiptID,VendorID,PONumber,RequisitionID,IssuedBy,IssuedDate,Username,ShippingAddress,VendorName from inventory where ReceiptID=$inventoryID";
						$result=$conn->query($query);
						if(!$result)
							die('could not get data');
						
							while($rw=$result->fetch_assoc())
							{
								$receiptID=$rw['ReceiptID'];
								$vendorID=$rw['VendorID'];
								$POid=$rw['PONumber'];
								$reqID=$rw['RequisitionID'];
								$issuedBy=$rw['IssuedBy'];
								$issuedDate=$rw['IssuedDate'];	
								$uname=$rw['Username'];
								$addr=$rw['ShippingAddress'];
								$vendorName=$rw['VendorName'];
							}
					 ?>
					 <b>Receipt ID: </b><?php echo $receiptID; ?><br><br>
					 <b>Vendor ID: </b><?php echo $vendorID; ?><br><br>
					 <b>Purchase Order Number: </b><?php echo $POid; ?><br><br>
					 <b>Requisition ID: </b><?php echo $reqID; ?><br><br>
					 <b>Issued By: </b><?php echo $issuedBy; ?><br><br>
					 <b>Issued Date: </b><?php echo $issuedDate; ?><br><br>
					 <b>Manager's Username: </b><?php echo $uname; ?><br><br>
					 <b>Shipping Address: </b><?php echo $receiptID; ?><br><br>
					 <b>Vendor's Name: </b><?php echo $vendorName; ?><br><br>
					
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
					 <br>
					 <form method="post">
					 <input type="radio" name="status" value="approve" >Approve Goods Receipt<br><br>
					 <input type="radio" name="status" value="reject" >Reject Goods Receipt<br><br>
					 <input type="submit" name="submit" value="Continue..">
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
			$status=$_POST['status'];
			if(strcmp($status,'approve')==0)
			{
				$sql1="update inventory set Status='Approved' where ReceiptID=$inventoryID";
				$retval1=$conn->query($sql1);
				if(!$retval1)
					die('could not update data');
				else
					echo "<script>alert('Approved $inventoryID Inventory ID successfully')</script>";
			}
			else if(strcmp($status,'reject')==0)
			{	
				$sql1="update inventory set Status='Rejected' where ReceiptID=$inventoryID";
				$retval1=$conn->query($sql1);
				if(!$retval1)
					die('could not update data');
				else
					echo "<script>alert('Rejected $inventoryID Inventory ID successfully')</script>";
			}
			header("location:inventory list.php");
		}
		?>