<?php
include "includes/header.php";
?>
<script>
if ( dw_scrollObj.isSupported() ) {
    //dw_writeStyleSheet('css/scroll.css');
    dw_Event.add( window, 'load', init_dw_Scroll);
}
document.title = "Jesus Made This - Admin";
</script>
<script>
	function getfullrecord(image_name)
	{
		var d = new Date();
		document.all.datafrm.src="data.php?action=getfullrecord&image_name=" + image_name + "&" + d.getTime();
	}
</script>
<div id="scrollLinks">
<table border=0>
	<tr>
		<td width=17></td>
		<td colspan=3>
<div style="HEIGHT: 100px; WIDTH: 750px; OVERFLOW-x: scroll">
				    <table id="t1" border="0" cellpadding="0" cellspacing="6" width=500>
				        <tr>
<?php
	$sql = "select * from jesus_images order by category, sortorder";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		if (file_exists(substr($row['image_name'], 0, strlen($row['image_name']) - 4) . "thumbnail.jpg"))
			echo "<td valign=top><a href=\"javascript:getfullrecord('" . $row['image_name'] . "');\"><img src=\"" . substr($row['image_name'], 0, strlen($row['image_name']) - 4) . "thumbnail.jpg" . "\" width=\"100\" height=\"67\" alt=\"" . $row['caption'] . "\" /></a></td>";
		else
			echo "<td valign=top><a href=\"javascript:getfullrecord('" . $row['image_name'] . "');\"><img src=\"" . $row['image_name'] . "\" width=\"100\" height=\"67\" alt=\"" . $row['caption'] . "\" /></a></td>";
	}
?>
				        </tr>
				    </table>
			</div>  
		</td>
	</tr>
<!--
	<tr>
		<td width=17></td>
		<td>
			<a class="mouseover_left" href="#"><img src="images/left_arrow.gif" alt="" border="0" style="border-style: solid; border-width: 0;" /></a>
		</td>
		<td>
			<div id="wn">
			    <div id="lyr1">
				    <table id="t1" border="0" cellpadding="0" cellspacing="6" width=500>
				        <tr>
<?php
	$sql = "select * from jesus_images order by category, sortorder";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		if (file_exists(substr($row['image_name'], 0, strlen($row['image_name']) - 4) . "thumbnail.jpg"))
			echo "<td valign=top><a href=\"javascript:getfullrecord('" . $row['image_name'] . "');\"><img src=\"" . substr($row['image_name'], 0, strlen($row['image_name']) - 4) . "thumbnail.jpg" . "\" width=\"100\" height=\"67\" alt=\"" . $row['caption'] . "\" /></a></td>";
		else
			echo "<td valign=top><a href=\"javascript:getfullrecord('" . $row['image_name'] . "');\"><img src=\"" . $row['image_name'] . "\" width=\"100\" height=\"67\" alt=\"" . $row['caption'] . "\" /></a></td>";
	}
?>
				        </tr>
				    </table>
			    </div>
			</div>  
		</td>
		<td>
			<a class="mouseover_right" href="#"><img src="images/right_arrow.gif" alt="" border="0" style="border-style: solid; border-width: 0;" alt="Hover to Scroll" /></a>
		</td>
	</tr>
-->
</table>
</div>
<br> 
<table><tr><td width=75></td><td>
<iframe src="data.php" id=datafrm frameborder="0" border="0" cellspacing="0" width="700" marginwidth="0" marginheight="0" height="310">
</td></tr></table>
<?php
include "includes/footer.php";
?>
