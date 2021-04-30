<!DOCTYPE html>
<html lang="en">
<head>
<title>Payment</title>
  <!--<meta charset="utf-8" > -->
  <meta name="description" content="SP Cinema website" />
  <meta name="keywords" content="Movies, Ticket,ShowTime" />
  <meta name="author" content="Sunwit Petchoo"  />
  <meta charset ="utf-8"/>
  <link href="styles/style.css" rel="stylesheet" />
  <script src="scripts/part2.js"></script>
   <script src="scripts/enhancements.js"></script>
</head>

<body>
	<article>
   <?php
			include_once("php_Header.inc");
			include_once("php_Menu.inc");		
	?>
   <!--form for storing data from enquire when submitted -->
   <form id="paymentForm" method="post" action="process_order.php" novalidate="novalidate">
	<fieldset>
		<legend>Your Purchase Details</legend>
		<p>Your Name: <span id="payment_name"></span></p>
		<p>Email Address: <span id="payment_email"></span></p>
		<p>Street Address: <span id="payment_stAddress"></span></p>
		<p>Suburb/town: <span  id="payment_subTown"></span></p>
		<p>State: <span  id="payment_state"></span></p>
		<p>Postcode: <span  id="payment_postCode"></span></p>
		<p>Phone number: <span  id="payment_phoneNumber"></span></p>
		<p>Preferred contact: <span  id="payment_pContact"></span></p>
		<p>Movie genres: <span  id="payment_genre"></span></p>
		<p>Category: <span  id="payment_category"></span></p>
		<p>Ticket: <span  id="payment_seatType"></span> Seat</p>
		<p>Number of people: <span  id="payment_totalSeat"></span></p>
		<p>Seat: <span  id="payment_seat"></span></p>
		<fieldset id="billingAddress_P">
		<legend>Billing Address</legend>
		<p>Street Address: <span  id="payment_stAddress2"></span></p>
		<p>Suburb/town: <span  id="payment_subTown2"></span></p>
		<p>State: <span  id="payment_state2"></span></p>
		<p>Postcode: <span  id="payment_postCode2"></span></p>
		 </fieldset>
		<p>Comments: <span  id="payment_Comments"></span></p>
		<p>Total price: <span  id="payment_cost"></span></p>
		 <!--Create hidden input to store data  -->
		<input type="hidden" name="firstName" id="firstName" />
		<input type="hidden" name="lastName" id="lastName" />
		<input type="hidden" name="email" id="email" />
		<input type="hidden" name="stAddress" id="stAddress" />
		<input type="hidden" name="subTown" id="subTown" />
		<input type="hidden" name="state" id="state" />
		<input type="hidden" name="postCode" id="postCode" />
		<input type="hidden" name="phoneNumber" id="phoneNumber" />
		<input type="hidden" name="pContact" id="pContact" />
		<input type="hidden" name="genre" id="genre" />
		<input type="hidden" name="category" id="category" />
		<input type="hidden" name="seatType" id="seatType" />
		<input type="hidden" name="seat" id="seat" />
		<input type="hidden" name="totalSeat" id="totalSeat" />
		<input type="hidden" name="stAddress2" id="stAddress2" />
		<input type="hidden" name="subTown2" id="subTown2" />
		<input type="hidden" name="state2" id="state2" />
		<input type="hidden" name="cost" id="cost" />
		<input type="hidden" name="postCode2" id="postCode2" />
		<input type="hidden" name="Comments" id="Comments" />
		<fieldset id="paymentDetails">
		<legend><h2>Please check out before session timed out!!</h2></legend>
		<p>Time left: <span id="counter"></span> Sec.</p>
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
		<button type="button" id="cancelButton">Cancel Order</button>
		<input class="formButton" id="debugFlag" type= "button" value="debug"/>
		<label id="currentFlag"></label>
    </fieldset>
</form>
	</article>
    <?php
			include_once("php_footer.inc");		
	?>
</body>

</html>