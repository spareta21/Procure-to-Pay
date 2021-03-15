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
	<title>Goods Receipt Creation</title>
			<style>
		input
		{
			width:30%;
			border:2px solid #aaa;
			border-radius:4px;
			margin:8px 0px;
			outline:none;
			padding:8px;
			box-sizing:border-box;
			transition:1s;
		}
		input:focus
		{
			border-color:dodgerBlue;
			box-shadow:0 0 8px 0 dodgerBlue;
		}
		#click
		{
			width:15%;
			background:#006699;
			border: 2px solid #003366;
			color:#FFFFFF;
			padding:5px;
			font-size:14px;
			cursor:pointer;
			margin:12px 0;	
			border-radius:8px;
		}
		
		</style>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <a href="POList.php">Purchase Order List</a> > <a href="PO page.php">Purchase Order Page</a> > Goods Receipt Creation
				
					 <br><br>
					 <form action="" method="post">
		Issued By: <font color="#FF0000">*</font><br />
		<input type="text" name="issuedBy" placeholder="Your Name" required /><br /><br />
		Issued Date: <font color="#FF0000">*</font><br />
		<input type="date" name="issuedDate" placeholder="Today's Date" required /><br />
		
					 
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
					 <input type="submit" name="submit" value="Create Receipt" id="click">
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
			$issuedBy=$_POST['issuedBy'];
			$issuedDate=$_POST['issuedDate'];
			$sql1="insert into inventory (IssuedBy,IssuedDate,PONumber,RequisitionID,Username,ShippingAddress,VendorID,VendorName) values ('$issuedBy','$issuedDate',$POid,$reqID,'$uname','$addr',$vendorID,'$vendorName')";
			$retval1=$conn->query($sql1);
			if(!$retval1)
				die('could not get data');
			else
			{
				echo "<script>alert('Goods Receipt Created Successfully for $POid number')</script>";
				header("location:POList.php");
			}
		}
		?>