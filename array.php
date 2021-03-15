<?php
/*if(isset($_POST['submit']))
{*/
$data=array(
'username'=>'shraddha',
'password'=>'pareta'
);
foreach($data as $key => $value)
{
	$k[]=$key;
	$v[]="'".$value."'";
}
print_r($v);
//$k=implode(",",$k);
//$v=implode(",",$v);
//print_r($v);
//$conn=mysqli_connect("localhost","root","","sample");
//$sql="insert into login ($k) values ($v)";
//$exe=mysqli_query($conn,$sql);
//}
?>

<!--<form method="post">
	uname:<input type="text" name="uname"><br>
	upass:<input type="text" name="upass"><br>
	<input type="submit" name="submit">
</form>-->