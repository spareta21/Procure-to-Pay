<?php
include("index common.php");
include("connectivity.php");
?>
<br>
<html>
	<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign In</title>
	<style>
	@import "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
	#bg 
	{
		margin:0;
		padding:0;
		font-family:"Times New Roman", Times, serif;
		background:url(img/photo.jpeg) no-repeat;
		background-size: cover;	
	}
	.login-box
	{
		width:280px;
		position:absolute;
		top:10%;
		left:70%;
		transform:translate(-50%,50%);
		color:#EFEFEF;
		box-shadow:10px 10px 5px 5px black;
		padding:40px;
		background-color:rgba(60,60,60,0.4);
		border-radius:25px;
	}
	.login-box h1
	{
		float:left;
		font-size:40px;
		border-bottom:4px solid #003366;
		margin-bottom:50px;
		padding:13px 0;
		width:100%;
	}
	.textbox
	{
		width:100%;
		overflow:hidden;
		font-size:20px;
		padding:8px 0;
		margin:8px 0;
		border-bottom:1px solid #003366;	
	}
	.textbox i
	{
		width:26px;
		float:left;
		text-align:center;
		
	}
	.textbox input
	{
		border:none;
		outline:none;
		background:none;
		color:#CCCCCC;;
		font-size:18px;
		width:80%;
		float:left;
		margin:0 10px;
		
	}
	.textbox input::placeholder
	{
		color:#CCCCCC;	
	}
	.container
	{
		text-align:center;
	}
	.container input
	{
		background-color:#EFEFEF;	
	}
	.btn
	{
		border:1px solid #000033;
		background:none;
		padding:10px 20px;
		font-size:20px;
		font-family:"montserrat";
		cursor:pointer;
		margin:10px;
		transition:0.8s;	
		position:relative;
		overflow:hidden;
		border-radius:10px;
	}
	.btn1
	{
		color:#666666;	
	}
	.btn1:hover
	{
		color:#000033;
	}
	.btn::before
	{
		content:"";
		position:absolute;
		left:0;
		width:100%;
		height:0%;
		background:#3498db;
		z-index:-1;
		transition:0.8s;
	}
	.btn1::before
	{
		top:0;
		border-radius:0 0 50% 50%;	
	}
	.btn1:hover::before
	{
		height:180%;
			
	}
	</style>
	</head>
	<body>
		<table border="0" width="80%" height="100%" align="center" bgcolor="#FFFFFF">
			<tr>
				<td id="bg" rowspan="2" width="70%" valign="top">					
				<form action="" method="post">
					<div class="login-box">					
						<h1>Log-In</h1>
						<div class="textbox">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input type="text" placeholder="Username" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>" required>
						</div>
						<div class="textbox">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input type="password" placeholder="Password" name="upass" value="" required>
						</div>
						<div class="container">
							<input class="btn btn1" type="submit" name="submit" value="Sign In">
						</div>
							<br>
							
						
					</div>
				</form>
				
		</td>
	</tr>
</table>
<?php
include("common2.php");
?>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
	$u=$_POST['uname'];
	$p=$_POST['upass'];
	$sql="select Username,Password,UserType from registration where Username='$u'";
	$result = $conn->query($sql);
		while($row=$result->fetch_assoc())
		{
			$uname=$row['Username'];
			$pass=$row['Password'];
			$type=$row['UserType'];
		}
	if(strcmp($u,$uname)==0 && strcmp($p,$pass)==0 && strcmp($type,'Admin')==0)
	{
		session_start();
		$_SESSION['username']=$u;
		header("location:admin home.php");
	}
	else if(strcmp($u,$uname)==0 && strcmp($p,$pass)==0 && strcmp($type,'Employee')==0)
	{
		session_start();
		$_SESSION['username']=$u;
		header("location:employee home.php");
	}
	else if(strcmp($u,$uname)==0 && strcmp($p,$pass)==0 && strcmp($type,'Manager')==0)
	{
		session_start();
		$_SESSION['username']=$u;
		header("location:manager home.php");
	}
	else if(strcmp($u,$uname)==0 && strcmp($p,$pass)==0 && strcmp($type,'Vendor')==0)
	{
		session_start();
		$_SESSION['username']=$u;
		header("location:vendor home.php");
	}
	else
	{
		echo "<script>alert('Wrong Credentials.. Please try again. !!')</script>";
	}
	
}
?>