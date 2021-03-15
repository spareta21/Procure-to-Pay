<?php
include("employee common.php");
include("connectivity.php");
session_start();
$u=$_SESSION['username'];
$sql="select Name from registration where Username='$u'";
$retval=$conn->query($sql);
if(!$retval)
	die('could not get data'.mysql_error());
while($row=$retval->fetch_assoc())
{
	$name=$row['Name'];
}
$sql1="select Category from items group by Category";
$retval1=$conn->query($sql1);
if(!$retval1)
	die('could not get data'.mysql_error());
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
		input[type="text"],select,input[type="date"]
		{
			width:90%;
			border:2px solid #aaa;
			border-radius:4px;
			margin:8px 0px;
			outline:none;
			padding:8px;
			box-sizing:border-box;
			transition:1s;
		}
		input[type="text"]:focus,select:focus,input[type="date"]:focus
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
					 <form method="post">
					
					Category: <font color="#FF0000">*</font><br />
		<select name="category" style="width:30%;">
			<?php
				while($row1=$retval1->fetch_assoc())
				{
					echo "<option value='". $row1['Category'] ."'>" .$row1['Category'] ."</option>";  // displaying data in option menu
				}
			?>
		</select>
		<input type="submit" name="get" value="Get List" id="click"><br><br>
		<?php
		if(isset($_POST['get']))
		{
			$category=$_POST['category'];
			$sql1="select * from items where category='$category'";
			$retval1=$conn->query($sql1);
			if(!$retval1)
				die('could not get data'.mysql_error());
			echo "<table border=1 style='border-collapse:collapse;' cellpadding=4px>";
			echo "<tr align=center><th>Item ID</th><th>Item Name</th><th>Item Price(each)</th><th>Quantity</th><th>Tick to <br> Select Items</th></tr>";	
			
			while($row1=$retval1->fetch_assoc())
			{
				echo "<tr align=center>";
				$itemno=$row1['ItemID'];
				$itemname=$row1['ItemName'];
				$itemprice=$row1['Price'];
				echo "<td>$itemno</td>";
				echo "<td>$itemname</td>";
				echo "<td>$itemprice</td>";
				
				
  				echo "<td><input type='text' name='qty[]'></td>";
  echo "<td><input type='checkbox' name='check[]' value=$itemno></td>";
				
				echo "</tr>";
				
			}
			echo "</table>";
		?>
		<br><br>
		Need By: <font color="#FF0000">*</font><br />
		<input type="date" name="date" placeholder="Enter estimate date" style="width:30%">
		<br><br>
		
		<input type="submit" name="submit" value="Create Requisition"id="click" style="width:25%">
		<br><br>
		
		</form>
		<?php 
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
if(isset($_POST['submit']))
{	
	$all_id=$_POST['check'];
	$all_qty=$_POST['qty'];
	$date=$_POST['date'];
	$query3="select Category from items where ItemID=$all_id[0]";
	$result3=$conn->query($query3);
	if(!$result3)
		die('could not get data');
	while($row3=$result3->fetch_assoc())
	{
		$cat=$row3['Category'];
	}
	//$seperate_id=implode(" ",$all_id)."<br>";
	//$seperate_qty=implode(" ",$all_qty)."<br>";
	$query1="select max(RequisitionID) from requisition";
	$result1=$conn->query($query1);
	if(!$result1)
		die('could not get data');
	while($row=$result1->fetch_assoc())
	{
		$reqID=$row['max(RequisitionID)'];
	}
	$reqID=$reqID+1;
	for($i=0;$i<count($all_id);$i++)
	{
		$query="insert into requisition (RequisitionID,Category,ItemID,Username,Quantity,NeedBy) values ($reqID,'$cat',$all_id[$i],'$u',$all_qty[$i],'$date')";
		$result=$conn->query($query);
		if(!$result)
		{
			die('could not insert');
		}
		else
			echo "success";
	}
	echo "<script>alert('Requisition Created Successfully')</script>";
	
}
?>