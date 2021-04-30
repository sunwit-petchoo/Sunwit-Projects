<!DOCTYPE html>
<html lang="en">
<head>
<title>Enhancement2</title>
  <!--<meta charset="utf-8" > -->
  <meta name="description" content="SP Cinema website" />
  <meta name="keywords" content="Movies, Ticket,ShowTime" />
  <meta name="author" content="Sunwit Petchoo"  />
  <meta charset ="utf-8"/>
  <link href="styles/style.css" rel="stylesheet" />

</head>

<body>
	<article>
	<?php
			include_once("php_Header.inc");
			include_once("php_Menu.inc");		
	?>
	<fieldset class="enhancement">
		<legend>Disable/enable booking option </legend>
		<p>Description: When user select ticket on "enquire.html" booking panel will display 
		and only enable seat based on option selected. When user change to new option script will enable new option and disable the rest.
		Disable/enable categorise by color setting 
		</p>
		<p>Link:<a href="https://mercury.swin.edu.au/cos60004/s101318759/assign2/enquire.html">https://mercury.swin.edu.au/cos60004/s101318759/assign2/enquire.html</a></p>
		<p>References: - </p>
	
    </fieldset>
	<fieldset class="enhancement">
		<legend>Booking panel </legend>
		<p>Description: User can select the seat for booking. After select the seat will be changed to yellow color.User cannot booking over number of people 
		Users will input total seat and then they will choose the seat. User can clear all booking seat. Also, user need to book the seat equal to number of people. Otherwise,
		form cannot be submitted.		
		</p>
		<p>Link:<a href="https://mercury.swin.edu.au/cos60004/s101318759/assign2/enquire.html">https://mercury.swin.edu.au/cos60004/s101318759/assign2/enquire.html</a></p>
		<p>References: <a href="https://www.w3schools.com/js/js_let.asp" target="_blank">let key word</a>  https://www.w3schools.com/js/js_let.asp</p>
	
    </fieldset>
	<fieldset class="enhancement">
		<legend>Session timeout </legend>
		<p>Description: set time for user to do check out. Time is counting down and display to let them know. 
		Also, counter will change color for each period and when time's up. It will be redirected to previous page.		
		</p>
		<p>Link:<a href="https://mercury.swin.edu.au/cos60004/s101318759/assign2/payment.html">https://mercury.swin.edu.au/cos60004/s101318759/assign2/payment.html</a></p> 
		<p>References: <a href="https://www.w3schools.com/jsref/met_win_settimeout.asp" target="_blank">Set Timeout</a>   https://www.w3schools.com/jsref/met_win_settimeout.asp </p>
	
    </fieldset>
	</article>
   <footer>
   <hr/>
   <p>Sunwit Petchoo</p>
   <hr/>
   </footer>
</body>

</html>