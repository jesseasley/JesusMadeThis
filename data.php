<link rel="stylesheet" type="text/css" href="css/style.css">
<body background="images/concrete3inner.jpg">
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

if (isset($_REQUEST['action']))
{
	if ($_REQUEST['action'] == "getfullrecord")
	{
		$sql = "select count(timestamp) count from jesus_web_hits where item = '" . $_REQUEST['image_name'] . "'";
		$result = mysql_query($sql, $con);
		$row = mysql_fetch_array($result);
		$hits = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(" . $row['count'] . " total hits)";

		$sql = "select * from jesus_images where image_name='" . $_REQUEST['image_name'] . "'";
		$result = mysql_query($sql, $con);
		$row = mysql_fetch_array($result);

		$sql = "select count(*) count from jesus_images where category='" . $row['category'] . "'";
		$result = mysql_query($sql, $con);
		$sort = mysql_fetch_array($result);

		echo "<form method=post action=\"data.php\">";
		echo "<table>";
		echo "<tr><td class=bodytext >Image Name:</td><td class=privacy>";
		echo $row['image_name'] . $hits;
		echo "<input type=hidden name=image_name value=\"";
		echo $row['image_name'] . "\"></td></tr>";
		echo "<tr><td valign=top class=bodytext >Active:</td><td><input type=checkbox class=privacy name=active value=on ";
		if ($row['active'] == "1")
			echo "checked";
		echo "></td></tr>";
		echo "<tr><td class=bodytext >Category:</td><td>";
		echo "<select name=category class=privacy>";
		echo "	<option ";
		if ($row['category'] == "Overlays")
			echo "selected";
		echo " value=Overlays>Overlays</option>";
		echo "	<option ";
		if ($row['category'] == "Pools")
			echo "selected";
		echo " value=Pools>Pools</option>";
		echo "	<option ";
		if ($row['category'] == "Stained")
			echo "selected";
		echo " value=Stained>Stained</option>";
		echo "	<option ";
		if ($row['category'] == "Stamped")
			echo "selected";
		echo " value=Stamped>Stamped</option>";
		echo "	<option ";
		if ($row['category'] == "Walls")
			echo "selected";
		echo " value=Walls>Walls</option>";
		echo "</select></tr>";

		echo "<tr><td class=bodytext >Sort Order:</td><td>";
		echo "<select name=sortorder class=privacy>";
		for ($i=1;$i<$sort['count']+1;$i+=1)
		{
			echo "	<option ";
			if ($row['sortorder'] == $i)
				echo " selected ";
			echo " value=" . $i . ">" . $i . "</option>";
		}
		echo "</select></tr>";
		
		echo "<tr><td class=bodytext >Caption:</td><td><input size=80 class=privacy type=text name=caption value=\"";
		echo $row['caption'] . "\"></td></tr>";
		echo "<tr><td valign=top class=bodytext>Description:</td><td><textarea cols=80 rows=5 class=privacy name=description>";
		
		if ($row['description'])
			echo $row['description'];

		echo "</textarea></td></tr>";
		echo "<tr>";
		echo "<td colspan=2 align=right><input type=submit name=deleterecord value=Delete>";
		echo "<input type=submit name=saverecord value=Save></td></tr>";
		echo "</table>";
		echo "</form>";
		echo "<br><form><input type=submit name=uploadnewimage value=\"Upload New Picture\"></form>";
	}
}
elseif (isset($_REQUEST['uploadfile']))
{
	$target_path = "images/";
	$target_path = $target_path . basename($_FILES['uploadedfile']['name']); 
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
	{
		$sql = "select count(*) count from jesus_images where image_name = '" . $target_path . "'";
		$result = mysql_query($sql, $con);
		$row = mysql_fetch_array($result);
		if ($row['count'] == 0)
		{
			$sql = "insert into jesus_images (image_name, category, caption, description, active) values ('" . $target_path . "', '', '', '', 1)";
			mysql_query($sql, $con);
		}
		echo "The file was uploaded successfully.<br><br>";
		echo "<a href=\"data.php?action=getfullrecord&image_name=" . $target_path . "\">Click here</a> to edit to file properties.";
	} 
	else
	{
	    echo "There was an error uploading the file, please try again!<br>";
	}
}
elseif (isset($_REQUEST['uploadnewimage']))
{
	echo "<table><tr><td width=75></td><td>";
	echo "<form enctype=\"multipart/form-data\" method=\"POST\" action=data.php?" . time() . ">\n";
	echo "<input type=hidden name=MAX_FILE_SIZE value=100000 />\n";
	echo "<span class=bodytext>Choose the image file you want to upload</span><br>";
	echo "<input size=60 class=privacy name=\"uploadedfile\" type=\"file\" /><br />\n";
	echo "<input class=bodytext type=\"submit\" name=\"uploadfile\" value=\"Upload File\" />\n";
	echo "</form>\n";
	echo "<br><br><span class=privacy>There is a 100KB limitation on the file size.</span>";
	echo "</td></tr></table>";
}
elseif (isset($_REQUEST['saverecord']))
{
	$sql = "select sortorder from jesus_images where image_name= '" . $_REQUEST['image_name'] . "'";
	$result = mysql_query($sql, $con);
	$row = mysql_fetch_array($result);
	$oldorder = $row['sortorder'];
	$sql = "select count(*) count from jesus_images where category = '" . $_REQUEST['category'] . "'";
	$result = mysql_query($sql, $con);
	$row = mysql_fetch_array($result);
	$max = $row['count'];
	
	if ($_REQUEST['sortorder'] > $oldorder)
	{
		$sql = "update jesus_images set ";
		$sql .= "sortorder=sortorder-1 ";
		$sql .= "where sortorder between " . $oldorder . " and " . $_REQUEST['sortorder'];
		mysql_query($sql, $con);

//		range	12345678
//		old		  3
//		new		      7
//		case 4->3 5->4 6->5 7->6 new->7
	}
	elseif ($_REQUEST['sortorder'] < $oldorder)
	{
		$sql = "update jesus_images set ";
		$sql .= "sortorder=sortorder+1 ";
		$sql .= "where sortorder between " . $_REQUEST['sortorder'] . " and " . $oldorder;
		mysql_query($sql, $con);

//		range	12345678
//		old		     6
//		new		 2
//		case 5->6 4->5 3->4 2->3 new->2
	}
	
	$sql = "update jesus_images set ";
	if (isset($_REQUEST['active']))
		$sql .= "active=1, ";
	else
		$sql .= "active=0, ";
	$sql .= "category='" . $_REQUEST['category'] . "', ";
	$sql .= "caption='" .$_REQUEST['caption'] . "', ";
	$sql .= "description='" . $_REQUEST['description'] . "',	 ";
	$sql .= "sortorder=" . $_REQUEST['sortorder'] . " ";
	$sql .= "where image_name='" . $_REQUEST['image_name'] . "'";
	if (mysql_query($sql, $con))
		echo "Record Updated";
	else
		echo "Record Update Failed";
	echo "<br><form><input type=submit name=uploadnewimage value=\"Upload New Picture\"></form>";
}
elseif (isset($_REQUEST['deleterecord']))
{
	$sql = "delete from jesus_images where image_name='" . $_REQUEST['image_name'] . "'";
	if (mysql_query($sql, $con))
	{
		unlink($_REQUEST['image_name']);
		echo "Record Deleted<br><br>";
		echo "<script>parent.location.reload();</script>";
	}
	else
		echo "Record Deletion Failed";
}
else
{
	echo "<table border=0><tr><td width=75></td><td width=100%>";
	echo "<br><form><input type=submit name=uploadnewimage value=\"Upload New Picture\"></form>";
	echo "</td></tr></table>";
}
?>
