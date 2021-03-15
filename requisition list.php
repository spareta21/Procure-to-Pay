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
	<title>Requisition List</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 Requisition List<br>
					 <h3>Pending Requisition List</h3>
					 <?php
					 $query="select RequisitionID, Username, Category, NeedBy from requisition where Status='Not Approved' group by RequisitionID";
					 $result=$conn->query($query);
					 if(!$result)
					 	die('could not get data');
					 if(mysqli_num_rows($result)>0)
					 {
					 echo "<table border='1' style='border-collapse:collapse;' cellpadding=10px>";
					
					 echo "<tr width=20%><th>RequisitionID</th><th>Username</th><th>Category</th><th>Need By</th><th>Action</th></tr>";
					 while($rw=$result->fetch_assoc())
					 {
					 	$reqID=$rw['RequisitionID'];
						$uname=$rw['Username'];
						$cat=$rw['Category'];
						$date=$rw['NeedBy'];
						echo "<form method='post'>";
						echo "<tr>";
						echo "<td width=20%>".$reqID."</td>";
						echo "<td>".$uname."</td>";
						echo "<td>".$cat."</td>";
						echo "<td>".$date."</td>";
						echo "<input type='hidden' value='".$reqID."' name='id'>";
						echo "<td><input type='submit' style='font-size:14px; border-radius:5px;' name='view' value='View Details'></td>";
						echo "</tr>";
						echo "</form>";
					 }	
					 echo "</table>";
					 }
					 else
					 {
					 	echo "No requisitions pending";
					 }
					 ?>
					 
					 <h3>Approved Requisition List</h3>
					 <?php
					 $query="select RequisitionID, Username, Category, NeedBy from requisition where Status='Approved' group by RequisitionID";
					 $result=$conn->query($query);
					 if(!$result)
					 	die('could not get data');
					 if(mysqli_num_rows($result)>0)
					 {
					 echo "<table border='1' style='border-collapse:collapse;' cellpadding=10px>";
					
					 echo "<tr width=20%><th>RequisitionID</th><th>Username</th><th>Category</th><th>Need By</th></tr>";
					 while($rw=$result->fetch_assoc())
					 {
					 	$reqID=$rw['RequisitionID'];
						$uname=$rw['Username'];
						$cat=$rw['Category'];
						$date=$rw['NeedBy'];
						echo "<tr>";
						echo "<td width=20%>".$reqID."</td>";
						echo "<td>".$uname."</td>";
						echo "<td>".$cat."</td>";
						echo "<td>".$date."</td>";
						echo "</tr>";
					 }	
					 echo "</table>";
					 }
					 else
					 {
					 	echo "No approve requisitions found";
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
		if(isset($_POST['view']))
		{
			$_SESSION['reqID']=$_POST['id'];
			header("location:requisition page.php");
		}
		?>