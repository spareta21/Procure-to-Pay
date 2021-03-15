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
	<title>Invoice List</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 Invoice List
					 <br>
					 <h3>Pending Invoice List</h3>
					 <?php
					 	$query="select * from invoice where PaymentStatus='Pending'";
						$result=$conn->query($query);
						if(!$result)
							die('could not get data');
						if(mysqli_num_rows($result)>0)
						{
							echo "<table width='68%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
							echo "<tr align='center'><th>Invoice ID</th><th>Issued By</th><th>Issued Date</th><th>Vendor ID</th><th>Vendor Name</th><th>PO Number</th><th>Action</th></tr>";
							while($rw=$result->fetch_assoc())
							{
								echo "<tr align='center'>";
								$invoiceID=$rw['InvoiceID'];
								$issuedBy=$rw['InvoiceIssuedBy'];
								$issuedDate=$rw['InvoiceIssuedDate'];
								$vendorID=$rw['VendorID'];
								$POid=$rw['PONumber'];
								$vendorName=$rw['VendorName'];
								echo "<td>".$invoiceID."</td>";
								echo "<td>".$issuedBy."</td>";
								echo "<td>".$issuedDate."</td>";
								echo "<td>".$vendorID."</td>";
								echo "<td>".$vendorName."</td>";
								echo "<td>".$POid."</td>";
								
								echo "<form method='post'>";
								echo "<input type='hidden' value='".$invoiceID."' name='id'>";
								echo "<td><input type='submit' value='View Details' name='view'></td></form>";
								echo "</tr>";
							}
							echo "</table>";
						}
						else
							echo "No pending receipts found";
					 ?>
					 
					 
					 <h3>Forwarded Invoice List</h3>
					 <?php
					 $query="select * from invoice where PaymentStatus='Forwarded'";
						$result=$conn->query($query);
						if(!$result)
							die('could not get data');
						if(mysqli_num_rows($result)>0)
						{
							echo "<table width='68%' border='1' cellpadding='10px' style='border-collapse:collapse;'>";
							echo "<tr align='center'><th>Invoice ID</th><th>Issued By</th><th>Issued Date</th><th>Vendor ID</th><th>Vendor Name</th><th>PO Number</th></tr>";
							while($rw=$result->fetch_assoc())
							{
								echo "<tr align='center'>";
								$invoiceID=$rw['InvoiceID'];
								$issuedBy=$rw['InvoiceIssuedBy'];
								$issuedDate=$rw['InvoiceIssuedDate'];
								$vendorID=$rw['VendorID'];
								$POid=$rw['PONumber'];
								$vendorName=$rw['VendorName'];
								echo "<td>".$invoiceID."</td>";
								echo "<td>".$issuedBy."</td>";
								echo "<td>".$issuedDate."</td>";
								echo "<td>".$vendorID."</td>";
								echo "<td>".$vendorName."</td>";
								echo "<td>".$POid."</td>";
								echo "</tr>";
							}
							echo "</table>";
						}
						else
							echo "No forwarded receipts found";
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
			echo $billID=$_POST['id'];
			$_SESSION['invoiceID']=$billID;
			header("location:invoice page.php");
		}
		?>