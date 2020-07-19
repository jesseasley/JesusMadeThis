<link rel="stylesheet" type="text/css" href="http://jesseasley.com/tandemincludes/css/style.css">

<script src="http://jesseasley.com/tandemincludes/js/dw_event.js" type="text/javascript"></script>
<script src="http://jesseasley.com/tandemincludes/js/dw_scroll.js" type="text/javascript"></script>
<script src="http://jesseasley.com/tandemincludes/js/scroll_controls.js" type="text/javascript"></script>

<script type="text/javascript">
function init_dw_Scroll() {
    var wndo = new dw_scrollObj('wn', 'lyr1', 't1');
    wndo.setUpScrollControls('scrollLinks');
}
function loadpic(pic)
{
	var html = "<img src=" + pic + "></td></tr></table>";
	document.all.bigpic.innerHTML=html;
}
</script>

</head>

<body bgcolor="#F1F2F3">

<script>
if ( dw_scrollObj.isSupported() ) {
    //dw_writeStyleSheet('css/scroll.css');
    dw_Event.add( window, 'load', init_dw_Scroll);
}

<%
function getFileList(path)
	Dim objFSO, objFile, objFolder, filelist
	
	Set objFSO = Server.CreateObject("Scripting.FileSystemObject")
	Set objFolder = objFSO.GetFolder(Server.MapPath(path))
	
	For Each objFile in objFolder.Files
		if lcase(right(objFile.Name, 4)) = ".jpg" then
			filelist = filelist & left(objFile.Name, len(objFile.Name) - 4) & ","
		end if
	Next
	Set objFolder = Nothing
	Set objFSO = Nothing
	filelist = left(filelist, len(filelist) - 1)
	getFileList = filelist
end function

function sortFileList(filelist)
	files = split(filelist, ",")
	for x=0 to ubound(files,1) -1
		for y=x + 1 to ubound(files,1)
			if files(y) < files(x) then
				t = files(y)
				files(y) = files(x)
				files(x) = t
			end if
		next
	next
	filelist = ""
	for x=0 to ubound(files,1)
		filelist = filelist & files(x) & ","
	next
	filelist = left(filelist, len(filelist) - 1)
	sortFileList = filelist
end function

sub fillImageList(path)
	filelist = sortFileList(getFileList(path))
	
	html = ""
	files = split(filelist, ",")
	for x=0 to ubound(files,1)
		html = html & "<input type=""hidden"" name=""a"" value=""" & path & files(x) + ".jpg"">"
		html = html & "<input type=""hidden"" name=""a"" value=""Pool 1"">"
		html = html & "<input type=""hidden"" name=""a"" value="""">"
		html = html & "<td valign=top><a href=""javascript:loadpic('" & path & files(x) + ".jpg');"">"
		html = html & "<img src=""" & path & files(x) + ".jpg"" width=""100"" height=""67"" alt="""" /></a></td>"
	next
	response.write html
	'<iframe src="http://tandemserver.net/default.aspx"/> 
end sub
%>
</script>
<div id="scrollLinks">
<center>
<table border=0>
	<tr>
		<td width=17></td>
		<td>
			<a class="mouseover_left" href="#"><img src="http://jesseasley.com/tandemincludes/images/left_arrow.gif" alt="" border="0" style="border-style: solid; border-width: 0;" /></a>
		</td>
		<td>
			<div id="wn">
			    <div id="lyr1">
				    <table id="t1" border="0" cellpadding="0" cellspacing="6" width=500>
				        <tr height=67>
							<% 
							'fillImageList("/jesus/images/")
							'fillImageList("/hereliesthecity/Files/Image/") 
							'http://localhost/tandemincludes/picturebrowser.asp?path=/hereliesthecity/Files/Image/
							if request("path") > "" then
								fillImageList(request("path")) 
							end if
							%>
				        </tr>
				    </table>
			    </div>
			</div>  
		</td>
		<td>
			<a class="mouseover_right" href="#"><img src="http://jesseasley.com/tandemincludes/images/right_arrow.gif" alt="" border="0" style="border-style: solid; border-width: 0;" alt="Hover to Scroll" /></a>
		</td>
	</tr>
</table>
</div>
<div id=bigpic name=bigpic></div>
</center>
</body>

</html>