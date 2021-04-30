<!DOCTYPE html>
<html lang="en">
<head>
<title>Fix Order</title>
 
  <meta name="description" content="SP Cinema website" />
  <meta name="keywords" content="Movies, Ticket,ShowTime" />
  <meta name="author" content="Sunwit Petchoo"  />
  <meta charset ="utf-8"/>
  <link href="styles/style.css" rel="stylesheet" />
  <script src="scripts/part2.js"></script>
  <script src="scripts/enhancements.js"></script>
  
</head>

<body>
	<!-- Heading and menu -->
  <article>
   <?php
			include_once("php_Header.inc");
			include_once("php_Menu.inc");		
	?>
   <section id="fixSection">
   <?php
		//get data from process_order.php
	    if(isset($_GET["firstName"]))
		{
		$firstname = $_GET["firstName"];
		$lastname = $_GET["lastName"];
		$email = $_GET["email"];
		$stAddress = $_GET["stAddress"];
		$subTown = $_GET["subTown"];
		$state = $_GET["state"];
		$postCode = $_GET["postCode"];
		$phoneNumber = $_GET["phoneNumber"];
		$genre = $_GET["genre"];
		$seatType = $_GET["seatType"];
		$totalSeat = $_GET["totalSeat"];
		$pContact = $_GET["pContact"];
		}else
		{
			header ("location: enquire.php");
		}
   ?>
   <form action="process_order.php" method="post" novalidate="novalidate">
	
	
		<p><label for="firstName">First Name: </label> 
			<input type="text" id="firstName" name= "firstName" size="30" maxlength="25" value="<?php echo $firstname ?>" />
		</p>
		<p><label for="lastName">Last Name: </label> 
			<input type="text" name= "lastName" id="lastName" size="30" maxlength="25" value="<?php echo $lastname ?>"/>
		</p>
		<p><label for="email">Email Address: </label> 
			<input type="email" name= "email" id="email" size="35" value="<?php echo $email ?>" />
		</p>
		<fieldset id="fixAddress">
		<legend>Address</legend>
		<p>
		<label for="stAddress">Street Address: </label><input type="text" id="stAddress" name="stAddress" maxlength="40" value="<?php echo $stAddress ?>"/>
		</p>
		<p>
		<label for="subTown">Suburb/town: </label><input type="text" id="subTown" name="subTown" maxlength="20" value="<?php echo $subTown ?>" />
		</p>
		<p>
			<label for="state">State: </label>
			<select name="state" id="state">
				<option value="">Please Select State</option>			
				<option value="VIC"<?php if($state=='VIC')echo ' selected="selected"';?>>VIC</option>
				<option value="NSW"<?php if($state=='NSW')echo ' selected="selected"';?>>NSW</option>
				<option value="QLD"<?php if($state=='QLD')echo ' selected="selected"';?>>QLD</option>
				<option value="NT"<?php if($state=='NT')echo ' selected="selected"';?>>NT</option>
				<option value="WA"<?php if($state=='WA')echo ' selected="selected"';?>>WA</option>
				<option value="SA"<?php if($state=='SA')echo ' selected="selected"';?>>SA</option>
				<option value="TAS"<?php if($state=='TAS')echo ' selected="selected"';?>>TAS</option>
				<option value="ACT"<?php if($state=='ACT')echo ' selected="selected"';?>>ACT</option>
			</select>
		</p>
		<p><label for="postCode">Postcode: </label> 
			<input type="text" name= "postCode" id="postCode"  size="10" value="<?php echo $postCode ?>"/>
		</p>
		</fieldset>
		<p>
		<label for="phoneNumber">Phone number: </label><input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber ?>"/>
		</p>
		<p>Preferred contact: </p>
		<p><label><input type="radio" id="email2" name="pContact" value="email" <?php if($pContact=='email')echo ' checked';?>/>Email</label> 
			   <label><input type="radio" id="post" name="pContact" value="post" <?php if($pContact=='post')echo ' checked';?>/>Post</label> 
			   <label><input type="radio" id="phone" name="pContact" value="phone" <?php if($pContact=='phone')echo ' checked';?>/>Phone</label>
		</p>
		<p>
			<label for="genre">Movie genres: </label>
			<select name="genre" id="genre" required="required">
				<option value="">Please Select Genres</option>			
				<option value="Action"<?php if($genre=='Action')echo ' selected="selected"';?>>Action</option>
				<option value="Adventure"<?php if($genre=='Adventure')echo ' selected="selected"';?>>Adventure</option>
				<option value="Comedy"<?php if($genre=='Comedy')echo ' selected="selected"';?>>Comedy</option>
				<option value="Crime"<?php if($genre=='Crime')echo ' selected="selected"';?>>Crime</option>
				<option value="Drama"<?php if($genre=='Drama')echo ' selected="selected"';?>>Drama</option>
				<option value="Fantasy"<?php if($genre=='Fantasy')echo ' selected="selected"';?>>Fantasy</option>
				<option value="Horror"<?php if($genre=='Horror')echo ' selected="selected"';?>>Horror</option>
				<option value="Science fiction"<?php if($genre=='Science fiction')echo ' selected="selected"';?>>Science fiction</option>
			</select>
		</p>
		<fieldset id="fixTicket">
		<legend>Ticket Details</legend>
		<p>
			<label for="seatType">Ticket: </label>
			<select name="seatType" id="seatType">
				<option value="none" <?php if($seatType=='none')echo ' selected="selected"';?>>Please select your seat</option>			
				<option value="Regular" <?php if($seatType=='Regular')echo ' selected="selected"';?>>Regular Seat</option>
				<option value="VIP"<?php if($seatType=='VIP')echo ' selected="selected"';?>>VIP Seat</option>
				<option value="Honeymoon"<?php if($seatType=='Honeymoon')echo ' selected="selected"';?>>Honeymoon Seat</option>
			</select>
		</p>
		<p>
		<label for="totalSeat">Number of people:</label><input type="text" name="totalSeat" id="totalSeat" maxlength="10" size="10" value="<?php echo $totalSeat ?>" />
		</p>	 
		</fieldset>
		<fieldset id="paymentDetails">
		<legend>Payment Details</legend>
		<p>
			<label for="visa">Visa</label><input type="radio"  name="cardType" id="visa" value="V"/>
			<label for="masterCard">Mastercard</label><input type="radio"  name="cardType" id="masterCard" value="M"/> 	
			<label for="aExpress">American Express</label><input type="radio"  name="cardType" id="aExpress" value="A"/> 			
		</p>
		<p>
			<label for="cardName">Name: </label><input type="text"  name="cardName" id="cardName" maxlength="40" size="40" value=""/>
		</p>
		<p>
			<label for="cardNo">Card Number: </label><input type="text"  name="cardNo" id="cardNo" value=""/>
		</p>
		<p>
			<label for="exDate">Expiry Date: </label><input type="text"  name="exDate" id="exDate" value="" placeholder="mm-yy"/>
		</p>
		<p>
			<label for="cvv">CVV: </label><input type="text"  name="cvv" id="cvv" value=""/>
		</p>
		</fieldset>
		<input type="submit" id="checkOut" value="Check Out" />
		
</form>
</section>
	<aside id="fixAside">
			
			<h2>Error: Please re-input then check out again</h2>
			<?php
			$errMsgArray = unserialize($_GET["errArray"]);
			for($i=0;$i<count($errMsgArray);$i++)
			{
				echo "<p>- $errMsgArray[$i]</p>";
			}			
			?>
			
   </aside>
   </article>
    <?php
			include_once("php_footer.inc");		
	?>	
</body>

</html>