<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$conn=mysql_connect($dbhost,$dbuser,$dbpass);
if(!$conn)
{
die('Could not connect'.mysql_error());
}
$data=array(
'actor_no'=>'5',
'actor_name'=>'Shradha Kapoor'
);
foreach($data as $key => $value)
{
	$k[]=$key;
	$v[]="'".$value."'";
}
$k=implode(",",$k);
$v=implode(",",$v);
$sql="insert into actor ($k) values ($v)";
mysql_select_db("sample");
$retval=mysql_query($sql,$conn);
if(!$retval)
	die('could not get data'.mysql_error());
else
	echo "success";
?>