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

if (mysql_connect($server_name, $user_name, $password)) 
{
	$con = mysql_connect($server_name, $user_name, $password);
	echo "connected to server<br>";
}
else
	echo "could not connect to server<br>";
	
if (mysql_select_db($db_name, $con))
	echo "connected to db<br>";
else
	echo "could not connect to db<br>";

if (mysql_query("DROP TABLE jesus_images", $con))
	echo "dropped table jesus_images<br>";
else
	echo "failed to drop table jesus_images<br>";
mysql_query("DROP TABLE jesus_web_hits", $con);
$sql = "CREATE TABLE ";
$sql .=    "jesus_web_hits ";
$sql .= "(";
$sql .=    "item varchar(200), ";
$sql .=    "timestamp datetime";
$sql .= ")";
if (mysql_query($sql, $con))
	echo "created web hits<br>";
else
	echo "web hits not created<br>";
$sql = "CREATE TABLE ";
$sql .=    "jesus_images ";
$sql .= "(";
$sql .=    "image_name varchar(200), ";
$sql .=    "category varchar(200), ";
$sql .=    "caption varchar(200), ";
$sql .=    "description varchar(2000), ";
$sql .=    "active int,";
$sql .=    "sortorder int";
$sql .= ")";

if(mysql_query($sql, $con))
{
	echo "Successfully created table<br>";

	//add overlays 8 cnt
	for ($i=1;$i<9;$i++)
	{
		if ($i < 10) $o = "0"; else $o = "";
		$sql = "insert into jesus_images (image_name, category, caption, description, active, sortorder) values ('images/overlay" . $o . $i . ".jpg', 'Overlays', 'Overlay " . $i . "', '', 1, " . $i . ")";
		if (mysql_query($sql, $con))
			echo "wrote record<br>";
		else
			echo "failed to write record<br>";
	}
	//add pool 23 cnt
	for ($i=1;$i<24;$i++)
	{
		if ($i < 10) $o = "0"; else $o = "";
		$sql = "insert into jesus_images (image_name, category, caption, description, active, sortorder) values ('images/pool" . $o . $i . ".jpg', 'Pools', 'Pool " . $i . "', '', 1, " . $i . ")";
		if (mysql_query($sql, $con))
			echo "wrote record<br>";
		else
			echo "failed to write record<br>";
	}
	//add stained 18 cnt
	for ($i=1;$i<19;$i++)
	{
		if ($i < 10) $o = "0"; else $o = "";
		$sql = "insert into jesus_images (image_name, category, caption, description, active, sortorder) values ('images/stained" . $o . $i . ".jpg', 'Stained', 'Stained " . $i . "', '', 1, " . $i . ")";
		if (mysql_query($sql, $con))
			echo "wrote record<br>";
		else
			echo "failed to write record<br>";
	}
	//add stamped 20 cnt
	for ($i=1;$i<21;$i++)
	{
		if ($i < 10) $o = "0"; else $o = "";
		$sql = "insert into jesus_images (image_name, category, caption, description, active, sortorder) values ('images/stamped" . $o . $i . ".jpg', 'Stamped', 'Stamped " . $i . "', '', 1, " . $i . ")";
		if (mysql_query($sql, $con))
			echo "wrote record<br>";
		else
			echo "failed to write record<br>";
	}
	//add walls 25 cnt
	for ($i=1;$i<21;$i++)
	{
		if ($i < 10) $o = "0"; else $o = "";
		$sql = "insert into jesus_images (image_name, category, caption, description, active, sortorder) values ('images/walls" . $o . $i . ".jpg', 'Walls', 'Wall " . $i . "', '', 1, " . $i . ")";
		if (mysql_query($sql, $con))
			echo "wrote record<br>";
		else
			echo "failed to write record<br>";
	}
}	
else
	echo "Error creating table: " . mysql_error() . "<br>";

mysql_close($con);

function update_listing($image_name, $caption, $description, $active)
{

	$sql = "update listings	";
	$sql .=    "set ";
	$sql .=       "address = '" . $address . "', ";
	$sql .=       "city = '" . $city . "', ";
	$sql .=       "virtualTourLink = '" . $virtualTourLink . "', ";
	$sql .=       "realtorComLink = '" . $realtorComLink . "', ";
	$sql .=       "listingCaption = '" . $listingCaption . "', ";
	$sql .=       "listingDescription = '" . $listingDescription . "', ";
	$sql .=       "sortOrder = " . $sortOrder . ", ";
	$sql .=       "active = " . $active . " ";
	$sql .= "where ";
	$sql .=    "id = " . $id;

	mysql_query($sql, $con);
//	echo $sql . "<br><br>";
//	echo mysql_error() . "<br><br>";

}

function update_image($id, $imageLocation, $con, $db_name)
{
	mysql_select_db($db_name, $con);

	$sql = "update listings	";
	$sql .=       "set imageLocation = '" . $imageLocation . "' ";
	$sql .= "where ";
	$sql .=    "id = " . $id;

	mysql_query($sql, $con);
}

function get_listing($id, $con, $db_name)
{
	mysql_select_db($db_name, $con);

	$sql = "select * from listings where id = " . $id;
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		echo "address:            " . $row['address'] . "<br>";
		echo "city:               " . $row['city'] . "<br>";
		echo "virtualTourLink:    " . $row['virtualTourLink'] . "<br>";
		echo "imageLocation:      " . $row['imageLocation'] . "<br>";
		echo "realtorComLink:     " . $row['realtorComLink'] . "<br>";
		echo "listingCaption:     " . $row['listingCaption'] . "<br>";
		echo "listingDescription: " . $row['listingDescription'] . "<br>";
		echo "sortOrder:          " . $row['sortOrder'] . "<br>";
		echo "active:             " . $row['active'] . "<br>";
	}
}

function get_listings_record_count($con, $db_name)
{
	mysql_select_db($db_name, $con);

	$sql = "select count(*) as count from listings";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
  	return $row["count"];
}

function get_max_id($con, $db_name)
{
	mysql_select_db($db_name, $con);

	$sql = "select max(id) as maxid from listings";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
  	return $row["maxid"];
}

function insert_listing($address, $city, $virtualTourLink, $imageLocation, $realtorComLink, $listingCaption, $listingDescription, $sortOrder, $active, $con, $db_name)
{
	mysql_select_db($db_name, $con);

	$sql = "select max(id) as maxid from listings";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$sql = "insert into ";
	$sql .=    "listings	";
	$sql .=    "(";
	$sql .=       "id, ";
	$sql .=       "address, ";
	$sql .=       "city, ";
	$sql .=       "virtualTourLink, ";
	$sql .=       "imageLocation, ";
	$sql .=       "realtorComLink, ";
	$sql .=       "listingCaption, ";
	$sql .=       "listingDescription, ";
	$sql .=       "sortOrder, ";
	$sql .=       "active, ";
	$sql .=       "deleted";
	$sql .=    ") ";
	$sql .=    "values ";
	$sql .=    "(";
	$sql .=       $row["maxid"] + 1 . ", ";
	$sql .=       "'" . $address . "', ";
	$sql .=       "'" . $city . "', ";
	$sql .=       "'" . $virtualTourLink . "', ";
	$sql .=       "'" . $imageLocation . "', ";
	$sql .=       "'" . $realtorComLink . "', ";
	$sql .=       "'" . $listingCaption . "', ";
	$sql .=       "'" . $listingDescription . "', ";
	$sql .=       $sortOrder . ", ";
	$sql .=       $active . ", ";
	$sql .=       "0";
	$sql .=    ")";

	mysql_query($sql, $con);
//	echo "Error: " . mysql_error() . "<br>";
		
	return $row["maxid"] + 1;
}

function create_table($db_name, $con)
{
	mysql_select_db($db_name, $con);

	$sql = "CREATE TABLE ";
	$sql .=    "listings ";
	$sql .= "(";
	$sql .=    "id int, ";
	$sql .=    "address varchar(50), ";
	$sql .=    "city varchar(50), ";
	$sql .=    "virtualTourLink varchar(200), ";
	$sql .=    "imageLocation varchar(200), ";
	$sql .=    "realtorComLink varchar(200), ";
	$sql .=    "listingCaption varchar(200), ";
	$sql .=    "listingDescription varchar(2000), ";
	$sql .=    "sortOrder int, ";
	$sql .=    "active int,";
	$sql .=    "deleted int";
	$sql .= ")";

	if(mysql_query($sql, $con))
		echo "Successfully created table<br>";
	else
		echo "Error creating table: " . mysql_error() . "<br>";
}

function page_hit($pagename, $db_name, $con)
{
	mysql_select_db($db_name, $con);

	$sql = "select id, hitcount from pagecount where pagename = '" . $pagename . "'";

	if (mysql_num_rows(mysql_query($sql)))
	{
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$sql = "update pagecount ";
		$sql .= "set hitcount = ";
		$sql .=    $row['hitcount'] + 1 . " ";
		$sql .= "where ";
		$sql .=    "id = " . $row[id];
		
		mysql_query($sql);

	}
	else
	{
		$sql = "select max(id) as maxid from pagecount";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sql = "insert into ";
		$sql .=    "pagecount ";
		$sql .=       "(id, ";
		$sql .=       "pagename, ";
		$sql .=       "hitcount) ";
		$sql .=    "values (";
		$sql .=       $row['maxid'] + 1 . ", ";
		$sql .=       "'" . $pagename . "', ";
		$sql .=       "1)";

		mysql_query($sql);
	}
}

function drop_table($table_name, $db_name, $con)
{
	mysql_select_db($db_name, $con);

	if (mysql_query("DROP TABLE " . $table_name, $con))
		echo "Dropped table " . $table_name . " successfully<br>";
	else
		echo "Error dropping table: " . mysql_error() . "<br>";
}

function create_db($db_name, $con)
{
	if (mysql_query("CREATE DATABASE " . $db_name, $con))
		echo "Database " . $db_name . " created successfully<br>";
	else
		echo "Error creating database: " . mysql_error() . "<br>";
}

function drop_db($db_name, $con)
{
	if (mysql_query("DROP DATABASE " . $db_name, $con))
		echo "Dropped database " . $db_name . " successfully<br>";
	else
		echo "Error dropping database: " . mysql_error() . "<br>";
}

function connect_to_db($server_name, $user_name, $password)
{
	return mysql_connect($server_name, $user_name, $password);
}

function close_db_connection($con)
{
	mysql_close($con);
}

?>