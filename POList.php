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
	<title>Purchase Order List</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <h3>Purchase Order List</h3>
					 <form action="" method="post">
					 <?php
					 	$query="Select PONumber,RequisitionID,Username,ShippingAddress from purchaseorder where VendorID=$vendorID && Status='Not Approved'";
						$result=$conn->query($query);
						if(mysqli_num_rows($result)>0)
						{
						echo "<table width='60%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
						echo "<tr align='center'><th>Purchase Order Number</th><th>Requisition ID</th><th>Username</th><th>Shipping Address</th><th>Action</th></tr>";
						while($rw=$result->fetch_assoc())
						{
							echo "<tr align='center'>";
							$POid=$rw['PONumber'];
							$reqID=$rw['RequisitionID'];
							$uname=$rw['Username'];
							$addr=$rw['ShippingAddress'];
							echo "<td>".$POid."</td>";
							echo "<td>".$reqID."</td>";
							echo "<td>".$uname."</td>";
							echo "<td>".$addr."</td>";
							echo "<input type='hidden' value='".$POid."' name='id'>";
							echo "<td><input type='submit' value='View Details' name='view'></td>";
							
							echo "</tr>";
						}	
						echo "</table>";
						}
						else
						{
							echo "No new purchase orders found";
						}
					 ?>
					 </form>
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
			$id=$_POST['id'];
			$_SESSION['POid']=$id;
			header("location:PO Page.php");
		}
		?>