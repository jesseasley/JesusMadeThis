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
	//settings for jesseasley.com
	$server_name = "jesusmadethis.db.6019076.hostedresource.com";
	$user_name = "jesusmadethis";
	$password = "Jesus12";
	$db_name = "jesusmadethis";

}
$con = mysql_connect($server_name, $user_name, $password);
mysql_select_db($db_name, $con);
$sql = "select * from jesus_images order by category, sortorder";
$result = mysql_query($sql);
echo "<table cellspacing=0 cellpading=0 border=1>";
echo "<tr><td><b>Image Name</td><td><b>Category</td><td><b>Sort Order</td><td><b>Caption</td><td><b>Description</td><td><b>Active</td></tr>";
while($row = mysql_fetch_array($result))
{
	echo "<tr><td>" . $row['image_name'] . "&nbsp;</td><td>" . $row['category'] . "&nbsp;</td><td>" . $row['sortorder'] . "&nbsp;</td><td>" . $row['caption'] . "&nbsp;</td><td>" . $row['description'] . "&nbsp;</td><td>" . $row['active'] . "&nbsp;</td></tr>";
}
echo "</table><br>";

$sql = "select * from jesus_web_hits order by timestamp desc";
$result = mysql_query($sql);
echo "<table cellspacing=0 cellpading=0 border=1>";
echo "<tr><td><b>Timestamp</td><td><b>Item</td></tr>";
while($row = mysql_fetch_array($result))
{
	echo "<tr><td>" . $row['timestamp'] . "&nbsp;</td><td>" . $row['item'] . "&nbsp;</td></tr>";
}
echo "</table>";
?>