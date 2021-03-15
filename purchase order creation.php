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
	<title>Purchase Order Creation</title>
	<style>
	#click
		{
			width:15%;
			background:rgba(60,60,60,0.3);
			border: 2px solid #003366;
			color:003366;
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
				 <a href="requisition list.php">Requisition List</a> >  <a href="requisition page.php">Requisition Page</a> > Purchase Order Creation<br><br>	
				<form method="post">
				Shipping Address: <br>
				<textarea cols="40" rows="3" name="addr" required></textarea>
					<br><br>
					 <?php
					 $sql1="select * from vendor";
					 $ret=$conn->query($sql1);
					 echo "<table border='1' cellpadding='10px' style='border-collapse:collapse;'>";
					 echo "<tr align='center'><th>Vendor ID</th><th>Vendor Name</th><th>Location</th><th>Action</th></tr>";
					 while($row1=$ret->fetch_assoc())
					 {
					 	echo "<tr align='center'>";
						$vendorID=$row1['VendorID'];
						$vendorName=$row1['VendorName'];
						$location=$row1['Location'];
						echo "<td>$vendorID</td>";
						echo "<td>$vendorName</td>";
						echo "<td>$location</td>";
						echo "<td><input type='radio' name='id' value='$vendorID'></td>";
						echo "<tr>";
					 }
					  echo "</table>";
					 
					 
					 $req=$_SESSION['reqID'];
					 $query="select Username, Category, NeedBy  from requisition where RequisitionID=$req";
					 $result=$conn->query($query);
					 if(!$result)
					 	die('could not get data');
					 while($rw=$result->fetch_assoc())
					 {
						$uname=$rw['Username'];
						$cat=$rw['Category'];
						$date=$rw['NeedBy'];
					 }
					 ?>
					 <br>
					 <b>Requisition ID: </b> <?php echo $req; ?><br><br>
					 <b>Username: </b> <?php echo $uname; ?><br><br>
					 <b>Category: </b> <?php echo $cat; ?><br><br>
					 <b>Need By: </b> <?php echo $date; ?><br><br>
					 <?php
					 $query1="SELECT items.ItemID, items.ItemName, items.Price, requisition.Quantity
FROM requisition, items
WHERE RequisitionID =$req
AND items.ItemID = requisition.ItemID";
					 $result1=$conn->query($query1);
					 if(!$result1)
					 	die('could not get data');
					 echo "<table border='1' cellpadding='10px' style='border-collapse:collapse;'>";
					 echo "<tr align='center'><th>Item ID</th><th>Item Name</th><th>Price Per Item</th><th>Quantity</th></tr>";
					 while($rw1=$result1->fetch_assoc())
					 {
					 	echo "<tr align='center'>";
					 	echo "<td>".$rw1['ItemID']."</td>";
						echo "<td>".$rw1['ItemName']."</td>";
						echo "<td>".$rw1['Price']."</td>";
						echo "<td>".$rw1['Quantity']."</td>";
						echo "<tr>";
					 }
					 echo "</table>";
					 ?>
					 <br>
					 <input type="submit" name="submit" value="Create" id="click">
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
			$id=$_POST['id'];
			$addr=$_POST['addr'];
			$stmt="insert into purchaseorder (RequisitionID,Username,ShippingAddress,VendorID) values ($req,'$u','$addr',$id)";
			$r=$conn->query($stmt);
			if(!$r)
				die('could not get data');
			else
				{
				echo "<script>alert('Purchase Order Created Successfully')</script>";
				header("location:requisition list.php");
				}
				
		}
		?>