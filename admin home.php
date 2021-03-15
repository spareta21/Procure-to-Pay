<?php
include("admin common.php");
include("connectivity.php");

session_start();
$u=$_SESSION['username'];
$sql="select Name,Email,ContactNo,Image from registration where Username='$u'";
mysql_select_db("procuretopay");
$result = $conn->query($sql);
while($row=$result->fetch_assoc())
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
	<title>Admin Home</title>

</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					 
					 <?php
					 $query="select Name,Username,UserType from registration where UserType!='Admin'; ";
					 $result1=$conn->query($query);
					 if(!$result1)
					 	die('could not get data');
					 if(mysqli_num_rows($result)>0)
					 {
						echo "<table border='1' cellpadding=12px style='border-collapse:collapse;float:left'>";
						echo "<tr><th align='left'>Full Name</th><th>Username</th><th>Role</th></tr>";
						while($rw=$result1->fetch_assoc())
						{
							echo "<tr>";
							echo "<td>".$rw['Name']."</td>";
							echo "<td>".$uname=$rw['Username']."</td>";
							echo "<form method='post'>";
							
							echo "<td>".$rw['UserType']."</td>";
							echo "</form>";
							echo "</tr>";				
						}
						echo "</table>";
					 }
					 else
					 	echo "No other users";
					 ?>
					 <h3 style="position:absolute; left:47%;">Total Registrations</h3><br><br><br><br>
					 <?php
					 $query1="select UserType,count(Username) from registration group by UserType";
					 $result=$conn->query($query1);
					 if(!$result)
					 	die('could not get data');
						echo "<table border='1' cellpadding=15px style='border-collapse:collapse; font-size:18px; position:absolute; left:47%;'>";
						$total=0;
						while($row1=$result->fetch_assoc())
						{
						echo "<tr align='left'>";
						echo "<th>".$row1['UserType'].":</th>";
						echo "<td>".$count=$row1['count(Username)']."</td>";
						$total=$total+$count;
						echo "</tr>";
						}			
						echo "<tr><th align='left'>Total:</th><th>$total</th></tr>";
						echo "</table>";		
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
			$uname=$_POST['id'];
			$_SESSION['uname']=$uname;
			header("location:update user.php");
		}
		?>