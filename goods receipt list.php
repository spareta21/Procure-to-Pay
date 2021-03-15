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
	<title>Goods Receipt List</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <h3>Goods Receipt List</h3>
					 
					 <?php
					 $query="select ReceiptID,IssuedDate,PONumber,RequisitionID,Username from inventory where VendorID=$vendorID and Status='Approved' and InvoiceStatus='No'";
					 $result=$conn->query($query);
					 if(!$result)
					 	die('could not get data');
						if(mysqli_num_rows($result)>0)
						{
						echo "<table width='60%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
						echo "<tr align='center'><th>Receipt ID</th><th>Issued Date</th><th>PO Number</th><th>Requisition ID</th><th>Username</th><th>Action</th></tr>";
						while($rw=$result->fetch_assoc())
						{
							echo "<tr align='center'>";
							$receiptID=$rw['ReceiptID'];
							$issuedDate=$rw['IssuedDate'];
							$POid=$rw['PONumber'];
							$reqID=$rw['RequisitionID'];
							$uname=$rw['Username'];
							echo "<td>".$receiptID."</td>";
							echo "<td>".$issuedDate."</td>";
							echo "<td>".$POid."</td>";
							echo "<td>".$reqID."</td>";
							echo "<td>".$uname."</td>";
							echo "<form method='post'>";
							echo "<input type='hidden' value='".$receiptID."' name='id'>";
							echo "<td><input type='submit' value='View Details' name='view'></td>";
							
							echo "</tr></form>";
							
						}
						echo "</table>";
						}
						else
							echo "No pending receipts found";
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
			header("location:goods receipt page.php");
		}
		?>