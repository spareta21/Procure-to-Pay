
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
	<title>Manager Home</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <h3>Purchase Order List</h3>
					 <?php
					 $query="select * from purchaseorder where Username='$u'";
					 $result=$conn->query($query);
					 if(!$result)
					 {
					 	die('could not get data');
					 }
					 if(mysqli_num_rows($result)>0)
					 {
					 echo "<table border=1 cellpadding=10px style='border-collapse:collapse;' width='60%'>";
					 echo "<tr><th>PO Number</th><th>Requisition ID</th><th>Shipping Address</th><th>Vendor ID</th><th>Status</th></tr>";
					 while($rw=$result->fetch_assoc())
					 {
					 	echo "<tr>";
					 	echo "<td>".$POid=$rw['PONumber']."</td>";
						echo "<td>".$reqID=$rw['RequisitionID']."</td>";
						echo "<td>".$addr=$rw['ShippingAddress']."</td>";
						echo "<td>".$vendorID=$rw['VendorID']."</td>";
						echo "<td>".$status=$rw['Status']."</td>";
					 	echo "</tr>";
					 }
					 echo "</table>";
					 }
					 else
					 {
					 	echo "No data found";
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