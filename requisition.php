<?php
include("employee common.php");
include("connectivity.php");
session_start();
$u=$_SESSION['username'];
$query="select Name from registration where username='$u';";
$result=$conn->query($query);
if(!$result)
	die('could not get data'.$conn->connect_error());
while($row=$result->fetch_assoc())
{
	$name=$row['Name'];
}
$query1="select Category from items group by Category";
$result1=$conn->query($query1);
if(!$result1)
	die('could not get data'.$conn->connect_error());
?>
<html>
<head>
	<title>Purchase Requisition Page</title>			
<style>
		#option td
		{
			width:20%;	
		}
		#option td a
		{
			font-weight:bold;
			color:#FFFFFF;
			text-decoration:none;
		}
		#option td:hover
		{
			background-color:#003333;
			color:#FFFFFF;	
			cursor:pointer;	
			border-radius:13px;
		}
		input,select,input
		{
			width:25%;
			border:2px solid #aaa;
			border-radius:4px;
			margin:8px 0px;
			outline:none;
			padding:8px;
			box-sizing:border-box;
			transition:1s;
		}
		input:focus,select:focus
		{
			border-color:dodgerBlue;
			box-shadow:0 0 8px 0 dodgerBlue;
		}
		#click
		{
			width:10%;
			background:#CCCCCC;
			border: 2px solid #003366;
			color:#000000;
			padding:5px;
			font-size:14px;
			cursor:pointer;
			margin:12px 0;	
			border-radius:5px;
		}
</style>
</head>
<br>
		<table border="0" align="center" width="80%" height="100%" bgcolor="white" cellpadding="40px">
			<tr>
				<td width="70%" valign="top">
					 <?php echo "<h1>Hello, $name </h1>"; ?>
					<form action="" method="post">
					Select Category: <br />
		<select name="category">
		<option value="select">--Select--</option>
		<?php
			while($row1 = $result1->fetch_assoc())
        {
            echo "<option value='". $row1['Category'] ."'>" .$row1['Category'] ."</option>";  // displaying data in option menu
        }
		
		?>
		</select>
		
		&nbsp;<input type="submit" value="Get" name="get" style="width:10%; border-radius:10px;"><br><br>
		
		<?php
			if(isset($_POST['get']) || isset($_POST['add']))
			{
				
				$c=$_POST['category'];
				$sql="select * from items where Category='$c'";
				$retval=$conn->query($sql);
				if(!$retval)
				die('could not get data');
				echo "Item Names:<br />";
				echo "<select name='itemID' required>";
				while($row2=$retval->fetch_assoc())
				{
					
					echo "<option value='". $row2['Item ID'] ."'>" .$row2['Item ID']."-".$row2['Item Name'] ."</option>"; 
				}
				echo "</select>";
				
				
				echo'<br><br>';
				echo 'Quantity:';
				echo'<br>';
				echo'<input type=text required name=qty>';
				echo'<br><br>';
				echo'<input type="submit" name="add" value="Add Item" id="click">';
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
$q="select max(RequisitionID) from requisition";
$r=$conn->query($q);
if(!$r)
die('could not get data');
while($rw=$r->fetch_assoc())
{
	$reqID=$rw['max(RequisitionID)'];
}
$reqID=$reqID+1;
if(isset($_POST['add']))
{
	$id=$_POST['itemID'];
	$qty=$_POST['qty'];
	$sql1="insert into requisition (RequisitionID, ItemID, Username, Quantity) values ($reqID,$id,'$u',$qty)";
	$exe=$conn->query($sql1);
	if(!$exe)
		die('could not get data');
	else
		echo "<script>alert('Item added successfully')</script>";
}
?>
