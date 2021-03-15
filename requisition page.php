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
	<title>Requisition Page</title>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
						<a href="requisition list.php">Requisition List</a> >  Requisition Page<br><br>					 
					 <?php
					 $req=$_SESSION['reqID'];
					 $query="select RequisitionID, Username, Category, NeedBy  from requisition where RequisitionID=$req";
					 $result=$conn->query($query);
					 if(!$result)
					 	die('could not get data');
					 while($rw=$result->fetch_assoc())
					 {
					 	$reqID=$rw['RequisitionID'];
						$uname=$rw['Username'];
						$cat=$rw['Category'];
						$date=$rw['NeedBy'];
					 }
					 ?>
					 <br>
					 <b>Requisition ID: </b> <?php echo $reqID; ?><br><br>
					 <b>Username: </b> <?php echo $uname; ?><br><br>
					 <b>Category: </b> <?php echo $cat; ?><br><br>
					 <b>Need By: </b> <?php echo $date; ?><br><br>
					 <?php
					 $query1="SELECT items.ItemID, items.ItemName, items.Price, requisition.Quantity
FROM requisition, items
WHERE RequisitionID =$reqID
AND items.ItemID = requisition.ItemID";
					 $result1=$conn->query($query1);
					 if(!$result1)
					 	die('could not get data');
					 echo "<table border='1' cellpadding='10px' style='border-collapse:collapse;'>";
					 echo "<tr align='center'><th>Item ID</th><th>Item Name</th><th>Price Per Item</th><th>Quantity</th></tr>";
					 while($rw1=$result1->fetch_assoc())
					 {
					 	echo "<tr align='center'>";
					 	echo "<td>".$reqID=$rw1['ItemID']."</td>";
						echo "<td>".$uname=$rw1['ItemName']."</td>";
						echo "<td>".$cat=$rw1['Price']."</td>";
						echo "<td>".$date=$rw1['Quantity']."</td>";
						echo "<tr>";
					 }
					 echo "</table>";
					 ?>
					 <br>
					 <form method="post">
					 <input type="radio" name="status" value="approve">Approve Requisition<br><br>
					 <input type="radio" name="status" value="reject">Reject Requisition<br><br>
					 <input type="submit" name="submit" value="Continue.." style="background-color:#006699; color:#FFFFFF; border-radius:7px; width:10%; height:13%; font-size:15px;">
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
			$rb=$_POST['status'];
			if(strcmp($rb,'approve')==0)
			{
				$sql="update requisition set Status='Approved' where RequisitionID=$req";
				$retval=$conn->query($sql);
				if(!$retval)
					die('could not get data');
				else
					header("location:purchase order creation.php");
			}
			else if(strcmp($rb,'reject')==0)
			{
				$sql="update requisition set Status='Rejected' where RequisitionID=$req";
				$retval=$conn->query($sql);
				if(!$retval)
					die('could not get data');
				else
					header("location:requisition list.php");
			}
			
		}
		?>