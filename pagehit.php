<?php
if ($_SERVER['HTTP_HOST'] == "localhost")
{
	$server_name = "localhost:3307";
	$user_name = "jess";
	$password = "jess";
	$db_name = "jess";
}
else
{
	//settings for TexasExpressRealty.com
	$server_name = "jesusmadethis.db.6019076.hostedresource.com";
	$user_name = "jesusmadethis";
	$password = "Jesus12";
	$db_name = "jesusmadethis";

}
$con = mysql_connect($server_name, $user_name, $password);
mysql_select_db($db_name, $con);
$sql = "insert into jesus_web_hits (item , timestamp) values ('" . $_REQUEST['path'] . "', '" . date("Y-m-d H:i:s",time()) . "')";
mysql_query($sql, $con);
?>