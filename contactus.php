<?php
include "includes/header.php";
if (isset($_REQUEST['submit']))
{
	$body = "<b>Name</b><br>";
	$body .= "First Name: " . $_REQUEST['firstname'] . "<br>";
	$body .= "Last Name: " . $_REQUEST['lastname'] . "<br><br>";
	$body .= "<b>Address</b><br>";
	$body .= "Street Address: " . $_REQUEST['street'] . "<br>";
	$body .= "City: " . $_REQUEST['city'] . "<br>";
	$body .= "State: " . $_REQUEST['state'] . "<br>";
	$body .= "Zip: " . $_REQUEST['zip'] . "<br><br>";
	$body .= "<b>Contact</b><br>";
	$body .= "Phone Number: " . $_REQUEST['phone'] . "<br>";
	$body .= "Alternate Phone Number: " . $_REQUEST['phone2'] . "<br>";
	$body .= "E-Mail: " . $_REQUEST['email'] . "<br><br>";
	$body .= "<b>Need</b><br>";
	$body .= "Square Feet: " . $_REQUEST['sqft'] . "<br>";
	$body .= "Interest: " . $_REQUEST['interest'] . "<br>";
	$body .= "Notes: " . $_REQUEST['notes'] . "<br><br>";
	$body .= "<b>Privacy Policy</b><br>";
	$body .= "Privacy Policy: " . $_REQUEST['over18'] . "<br>";
	$subject = "Note from the Web Site";
	$headers = "MIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1";
	$headers .= "From: web_user@jesusmadethis.com>\r\n"; 
	$headers .= "Bcc: Jess Easley <jess@jesseasley.com>\r\n";
	$headers .= "To: Michelle De La Cruz <mdlc68-i@att.net>\r\n"; 

	$send_to = "";
	$mail_sent = mail($send_to, $subject, $body, $headers);
	if ($mail_sent)
		echo "<table><tr><td width=10></td><td class=\"privacy\">Thanks for contacting us.  Someone will get back to you ASAP.</td></tr></table>";
	else
		echo "Mail not sent, encountered error.";
	?>
	<script>
	document.title = "Jesus Made This - Contact Us";
	</script>
	<?php
}
else
{
	?>
	<script>
	document.title = "Jesus Made This - Contact Us";
	</script>
	<form method=post>
	<table><tr><td width=10></td><td class="privacy">
	
	<fieldset style="border:3px outset #C0C0C0; padding:2px; "><legend>Name</legend>
	<table><tr><td width=310 class="privacy">First Name:</td><td class="privacy">
	<input class="privacy" type="text" name="firstname" size="50"></td></tr>
	<tr><td class="privacy">Last Name:</td><td class="privacy">
	<input class="privacy" type="text" name="lastname" size="50"></td></tr></table>
	</fieldset>
	
	<fieldset style="border:3px outset #C0C0C0; padding:2px; "><legend>Address</legend>
	<table><tr><td width=310 class="privacy">Street Address:</td><td class="privacy">
	<input class="privacy" type="text" name="street" size="50"></td></tr>
	<tr><td class="privacy">City:</td><td class="privacy">
	<input class="privacy" type="text" name="city" size="50"></td></tr>
	<tr><td class="privacy">State:</td><td class="privacy">
	<input class="privacy" type="text" name="state" size="2"></td></tr>
	<tr><td class="privacy">Zip Code:</td><td class="privacy">
	<input class="privacy" type="text" name="zip" size="10"></td></tr></table>
	</fieldset>
	
	<fieldset style="border:3px outset #C0C0C0; padding:2px; "><legend>Contact</legend>
	<table><tr><td width=310 class="privacy">Phone Number:</td><td class="privacy">
	<input class="privacy" type="text" name="phone" size="50"></td></tr>
	<tr><td class="privacy">Alternate Phone Number:</td><td class="privacy">
	<input class="privacy" type="text" name="phone2" size="50"></td></tr>
	<tr><td class="privacy">Email Address:</td><td class="privacy">
	<input class="privacy" type="text" name="email" size="50"></td></tr></table>
	</fieldset>
	
	<fieldset style="border:3px outset #C0C0C0; padding:2px; "><legend>Need</legend>
	<table>
	<tr><td width=310 class="privacy">Approximate square footage of project area:</td>
	<td class="privacy"><input class="privacy" type="text" name="sqft" size="50"></td></tr>
	<tr><td class="privacy">Interested in:</td><td>
	<select name="interest" width=50 class="privacy">
	<option value="Stained Concrete">Stained Concrete</option>
	<option value="Overlay">Overlay</option>
	<option value="Pool Features">Pool Features</option>
	<option value="Waterfall">Waterfall</option>
	<option value="Retaining Wall">Retaining Wall</option>
	<option value="Stamp">Stamp</option>
	</select></td></tr>
	<tr><td valign=top class="privacy">Notes:</td><td class="privacy">
	<textarea  class="privacy" name="notes" cols="50" rows="3"></textarea></td></tr></table>
	</fieldset>
	
	<fieldset style="border:3px outset #C0C0C0; padding:2px; "><legend>Privacy Policy</legend>
	<input type="radio" name="over18" value"checked">Click here if you have read and
	agree to the terms of our <a href="privacy.php">Privacy Policy</a>. <br>Jesus will call you for an appointment, as he will need to see the location, and discuss in detail what services you would like. 
	</fieldset>
	<p align="center"><input type="submit" class="bodytext" name=submit value="Contact Me"></p>
	
	</td></tr></table>
	</form>
	<?php
}

include "includes/footer.php";
?>