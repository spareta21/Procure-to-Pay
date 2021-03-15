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


?>
<html>
<head>
	<title>Purchase Order List</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <a href="POList.php">Purchase Order List</a> > Purchase Order Page
					 <br><br>
					 <?php
					 $POid=$_SESSION['POid'];
					 $vendorID=$_SESSION['vendorID'];
$query="SELECT RequisitionID, purchaseorder.Username, ShippingAddress,VendorName FROM purchaseorder, vendor WHERE purchaseorder.VendorID = vendor.VendorID AND purchaseorder.VendorID =$vendorID;";
$result=$conn->query($query);
if(!$result)
	die('could not get data');
while($row1=$result->fetch_assoc())
{
	$reqID=$row1['RequisitionID'];
	$uname=$row1['Username'];
	$addr=$row1['ShippingAddress'];
	$vendorName=$row1['VendorName'];
}
	?>
					 <b>Purchase Order Number: </b><?php echo $POid; ?><br><br>
					 <b>Requisition ID: </b><?php echo $reqID; ?><br><br>
					 <b>Username: </b><?php echo $uname; ?><br><br>
					 <b>Shipping Address: </b><?php echo $addr; ?><br><br>
					 <b>Vendor ID: </b><?php echo $vendorID; ?><br><br>
					 <b>Vendor Name: </b><?php echo $vendorName; ?><br><br>
					 
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
					 <form action="" method="post">
					 	<input type="radio" value="approve" name="status">Approve Purchase Order <br><br>
						<input type="radio" value="reject" name="status">Reject Purchase Order<br><br>
						<input type="submit" name="submit" value="Continue.." style="width:18%; border-radius:8px; font-size:14px;" >
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
				$sql1="update purchaseorder set Status='Approved' where PONumber=$POid";
				$retval1=$conn->query($sql1);
				if(!$retval1)
					die('could not get data');
				else
				{
					echo "<script>alert('Approved $POid purchase order number successfully')</script>";
					header("location:goods receipt.php");
				}
					
			}
			else if(strcmp($status,'reject')==0)
			{
				$sql1="update purchaseorder set Status='Rejected' where PONumber=$POid";
				$retval1=$conn->query($sql1);
				if(!$retval1)
					die('could not get data');
				else
				{
					echo "<script>alert('Rejected $POid purchase order number successfully')</script>";
					header("location:POList.php");
				}
			}	
		}
		?>