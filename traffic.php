<script>
document.title = "Jesus Made This - Traffic";
</script>
<?php
include "includes/header.php";
echo "<table><tr><td width=75></td><td>";
if (isset($_REQUEST['year']))
	if (isset($_REQUEST['month']))
	{
		if (isset($_REQUEST['day']))
		{
			$sql = "select count(timestamp) count, item from jesus_web_hits where year(timestamp) = " . $_REQUEST['year'] . " and month(timestamp) = " . $_REQUEST['month'] . " and day(timestamp) = " . $_REQUEST['day'] . " group by item order by count(timestamp) desc, item";
			$result = mysql_query($sql);
			echo "<table cellspacing=0 cellpadding=0 border=1>";
			echo "<tr><td colspan=2 align=center class=bodytext width=500>Views for ";
			switch (date("I", mktime(0, 0, 0, $_REQUEST['month'], $_REQUEST['day'], $_REQUEST['year'])))
			{
				case 1: echo "Monday, ";break;
				case 2: echo "Tuesday, ";break;
				case 3: echo "Wednesday, ";break;
				case 4: echo "Thursday, ";break;
				case 5: echo "Friday, ";break;
				case 6: echo "Saturday, ";break;
				case 7: echo "Sunday, ";break;
			}
			echo "<a href=\"traffic.php?year=" . $_REQUEST['year'] . "&month=" . $_REQUEST['month'] . "\">";
			echo date("M", mktime(0, 0, 0, $_REQUEST['month'], 1, $_REQUEST['year'])) . "</a>";
			echo " " . $_REQUEST['day'] . ", ";
			echo "<a href=\"traffic.php?year=" . $_REQUEST['year'] . "\">" . $_REQUEST['year'] . "</a>";
			echo "</td></tr>";
			echo "<tr><td class=bodytext align=center>File</td><td class=bodytext align=center>Hits</td></tr>";
//			echo $sql;
			while($row = mysql_fetch_array($result))
			{
				echo "<tr>";
					echo "<td class=privacy align=center>";
					echo $row['item'];
					echo "</td>";
					echo "<td class=privacy align=center>" . $row['count'] . "</td>";
				echo "</tr>";
				
			}
			echo "</table>";
		}
		else
		{
			$sql = "select day(timestamp) day, count(*) count from jesus_web_hits where year(timestamp) = " . $_REQUEST['year'] . " and month(timestamp) = " . $_REQUEST['month'] . " group by day(timestamp) order by day(timestamp) desc";
			$result = mysql_query($sql);
			echo "<table cellspacing=0 cellpadding=0 border=1>";
			echo "<tr><td colspan=2 align=center class=bodytext width=500>Grouped by Day (for " . date("M", mktime(0, 0, 0, $_REQUEST['month'], 1, $_REQUEST['year'])) . ", ";
			echo "<a href=\"traffic.php?year=" . $_REQUEST['year'] . "\">" . $_REQUEST['year'] . "</a>";
			echo ")</td></tr>";
			echo "<tr><td class=bodytext align=center>Day of Month</td><td class=bodytext align=center>Hits</td></tr>";
			while($row = mysql_fetch_array($result))
			{
				echo "<tr>";
					echo "<td class=privacy align=center>";
						echo "<a href=\"traffic.php?year=" . $_REQUEST['year'] . "&month=" . $_REQUEST['month'] . "&day=" . $row['day'] . "\">";
						switch (date("I", mktime(0, 0, 0, $_REQUEST['month'], $row['day'], $_REQUEST['year'])))
						{
							case 1: echo "Monday";break;
							case 2: echo "Tuesday";break;
							case 3: echo "Wednesday";break;
							case 4: echo "Thursday";break;
							case 5: echo "Friday";break;
							case 6: echo "Saturday";break;
							case 7: echo "Sunday";break;
						}
						echo " (" . $row['day'] . ")</a>";
					echo "</td>";
					echo "<td class=privacy align=center>" . $row['count'] . "</td>";
				echo "</tr>";
				
			}
			echo "</table>";
		}
	}
	else
	{
		$sql = "select month(timestamp) month, count(*) count from jesus_web_hits where year(timestamp) = " . $_REQUEST['year'] . " group by month(timestamp) order by month(timestamp) desc";
		$result = mysql_query($sql);
		echo "<table cellspacing=0 cellpadding=0 border=1>";
		echo "<tr><td colspan=2 align=center class=bodytext width=500>";
		echo "<a href=\"traffic.php\">Grouped by Month (for " . $_REQUEST['year'] . ")</a>";
		echo "<tr><td class=bodytext align=center>Month</td><td class=bodytext align=center>Hits</td></tr>";
		while($row = mysql_fetch_array($result))
		{
			echo "<tr>";
				echo "<td class=privacy align=center>";
					echo "<a href=\"traffic.php?year=" . $_REQUEST['year'] . "&month=" . $row['month'] . "\">";
					echo date("M", mktime(0, 0, 0, $row['month'], 1, 2005)) . "</a>";
				echo "</td>";
				echo "<td class=privacy align=center>" . $row['count'] . "</td>";
			echo "</tr>";
			
		}
		echo "</table>";
	}
else
{
	//show year
	$sql = "select year(timestamp) year, count(*) count from jesus_web_hits group by year(timestamp) order by year(timestamp) desc";
	$result = mysql_query($sql);
	echo "<table cellspacing=0 cellpadding=0 border=1>";
	echo "<tr><td colspan=2 align=center class=bodytext width=500>Grouped by Year</td></tr>";
	echo "<tr><td class=bodytext align=center>Year</td><td class=bodytext align=center>Hits</td></tr>";
	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
			echo "<td class=privacy align=center>";
				echo "<a href=\"traffic.php?year=" . $row['year'] . "\">" . $row['year'] . "</a>";
			echo "</td>";
			echo "<td class=privacy align=center>" . $row['count'] . "</td>";
		echo "</tr>";
		
	}
	echo "</table>";
}
echo "</td></tr></table>";
include "includes/footer.php";
?>