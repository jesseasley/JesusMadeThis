<?php
include "includes/header.php";
?>
<script>
if ( dw_scrollObj.isSupported() ) {
    //dw_writeStyleSheet('css/scroll.css');
    dw_Event.add( window, 'load', init_dw_Scroll);
}
document.title = "Jesus Made This - Stamped Concrete";
</script>
<div id="scrollLinks">
<table border=0>
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
	$sql = "select * from jesus_images where category = 'Stamped' and active=1 order by sortorder";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$filename = substr($row['image_name'], 7,100);
		$filename = substr($filename, 0, strlen($filename) - 4) . substr($filename, strlen($filename) - 3, 3);
		echo "<input type=\"hidden\" name=\"" . $filename . "filename\" value=\"" . $row['image_name'] . "\">\n";
		echo "<input type=\"hidden\" name=\"" . $filename . "caption\" value=\"" . $row['caption'] . "\">\n";
		echo "<input type=\"hidden\" name=\"" . $filename . "description\" value=\"" . $row['description'] . "\">\n";
		if (file_exists(substr($row['image_name'], 0, strlen($row['image_name']) - 4) . "thumbnail.jpg"))
			echo "<td valign=top><a href=\"javascript:loadpic('" . $row['image_name'] . "');\"><img src=\"" . substr($row['image_name'], 0, strlen($row['image_name']) - 4) . "thumbnail.jpg" . "\" width=\"100\" height=\"67\" alt=\"" . $row['caption'] . "\" /></a></td>\n";
		else
			echo "<td valign=top><a href=\"javascript:loadpic('" . $row['image_name'] . "');\"><img src=\"" . $row['image_name'] . "\" width=\"100\" height=\"67\" alt=\"" . $row['caption'] . "\" /></a></td>\n";
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
</table>
</div>
<br> 
<table><tr><td width=75></td><td>
<div id=bigpic name=bigpic></div>
</td></tr></table>
<?php
include "includes/footer.php";
?>