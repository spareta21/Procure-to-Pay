<?php
include("employee common.php");
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
	<title>Employee Home</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 <h3>Requisition List</h3>
					 <?php
					 	$query="select RequisitionID,Category,ItemID,Quantity,NeedBy,Status from requisition where Username='$u'";
						
						$result=$conn->query($query);
						
						if(!$result)
							die('could not get data');
						if(mysqli_num_rows($result)>0)
						{
						echo "<table border='1' cellpadding=10px style='border-collapse:collapse;'>";
						echo "<tr><th>Requisition ID</th><th>Category</th><th>Item ID</th><th>Quantity</th><th>Need By</th><th>Status</th></tr>";
						while($rw=$result->fetch_assoc())
						{
							echo "<tr>";
							echo "<td>".$rw['RequisitionID']."</td>";
							echo "<td>".$rw['Category']."</td>";
							echo "<td>".$rw['ItemID']."</td>";
							echo "<td>".$rw['Quantity']."</td>";
							echo "<td>".$rw['NeedBy']."</td>";
							echo "<td>".$rw['Status']."</td>";
							echo "</tr>";
						}
						echo "</table>";
						}
						else
							echo "No data found";
						
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