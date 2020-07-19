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

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="description" content="Jesus de la Cruz Made This ~ Decorative Concrete"  >
<meta name="keywords" content="jesus, dela cruz, de la Cruz, delaCruz, dallas, texas,concrete, decorative concrete, cement, cosmetic, construction "  >
<title>Jesus Made This</title>
<link rel="stylesheet" type="text/css" href="css/style.css">

<script src="js/dw_event.js" type="text/javascript"></script>
<script src="js/dw_scroll.js" type="text/javascript"></script>
<script src="js/scroll_controls.js" type="text/javascript"></script>

<script type="text/javascript">
function init_dw_Scroll() {
    var wndo = new dw_scrollObj('wn', 'lyr1', 't1');
    wndo.setUpScrollControls('scrollLinks');
}
function loadpic(pic)
{
	var d = new Date();
	var s = pic.substr(7, 100);
	s = s.substr(0, s.length - 4) + s.substr(s.length-3, 3);
//	alert(s);
	var html = "<table><tr><td class=bodytext>" + document.getElementById(s + "caption").value + "</td></tr>";
	html += "<tr><td class=privacy>" + document.getElementById(s + "description").value + "</td></tr>";
	html += "<tr><td>";
	html += "<img src=" + document.getElementById(s + "filename").value + "></td></tr></table>";
	document.all.bigpic.innerHTML=html;
	if (!(http))
		var http = new ActiveXObject("Microsoft.XMLHTTP");
	http.open("GET", "pagehit.php?path=" + pic + "&" + d.getTime(), true);
	http.send(null);	
}
function editpic(pic)
{
	document.all.postpic.value=pic;
	http = new ActiveXObject("Microsoft.XMLHTTP");
	http.open("GET", "http://localhost/clients/jesusmadethis/getrecord.php?action=get&image=" + pic, true);
	http.send(null);
	while (!(http.readyState == 4))
	{;}
	
}
</script>

</head>

<body background="images/concrete3.jpg">
<center>
<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2" height="104">
		<p align="center"><a href="default.php"><img src="images/logo.jpg" width=800 height=67/></a>&nbsp;<br>
&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" valign="top">
		<table><tr><td>
		<table border="0" width="101%" cellspacing="2" cellpadding=2 bgcolor="#C2A569">
			<tr>
				<td height=3></td>
			</tr>
			<tr>
				<td><a href="default.php" title="See Jesus' Bio" id="menus">About Jesus</a></td>
			</tr>
			<tr>
				<td><a href="stain.php" id="menus" title="See Examples of Stained Concrete">Stained Concrete</a></td>
			</tr>
			<tr>
				<td><a href="overlay.php" id="menus" title="See Examples of Overlays">Overlay</a></td>
			</tr>
			<tr>
				<td><a href="pool.php" id="menus" title="See Examples of Pool Features & Waterfalls">Pool Features & Waterfalls</a></td>
			</tr>
			<tr>
				<td><a href="wall.php" id="menus" title="See Examples of Retaining Walls">Retaining Wall</a></td>
			</tr>
			<tr>
				<td><a href="stamp.php" id="menus" title="See Examples of Stamped Concrete">Stamped Concrete</a></td>
			</tr>
			<tr>
				<td><a href="faq.php" id="menus" title="See the FAQ">FAQ</a></td>
			</tr>
			<tr>
				<td><a href="contactus.php" id="menus" title="Send Us A Note">Contact Us</a></td>
			</tr>
			<tr>
				<td><a href="privacy.php" id="menus" title="See Our Privacy Policy">Privacy Policy</a></td>
			</tr>
			<tr>
				<td height=3></td>
			</tr>
		</table>
		</td></tr>
		<tr><td align=center class=signature>Designed by <a title="North Texas Website Design" href="http://www.ntwebdes.com" target=_empty><br>North Texas Website Design</a></td></tr>
<!--
			<tr>
				<td align=center>
					<br>
					<a href="mailto:kimchatelain@hotmail.com"> 
						<img src="images/email.gif" 
							 alt="Email the Webmaster" 
							 style="border-style: solid; border-width: 0"/>
					</a>
				</td>
			</tr>
-->
		</table>
		</td>
		<td width="85%" align="left" valign="top">
		<table border="0" width="97%" cellspacing="0" cellpadding="0">
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr>
				<td class="bodytext" width=8>
					&nbsp;</td>
				<td class="bodytext">

