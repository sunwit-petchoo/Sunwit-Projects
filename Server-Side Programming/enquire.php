<!DOCTYPE html>
<html lang="en">
<head>
<title>Enquery</title>
 
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
   <section id="enquireForm">
   <form  id="enquireForm2" action="payment.php" novalidate="novalidate">
	
	
		<p><label for="firstName">First Name: </label> 
			<input type="text" name= "firstName" id="firstName" maxlength="25" size="30" required="required" pattern="^[a-zA-Z ]+$" />
		</p>
		<p><label for="lastName">Last Name: </label> 
			<input type="text" name= "lastName" id="lastName" maxlength="25" size="30" required="required" pattern="[A-Za-z ]+"/>
		</p>
		<p><label for="email">Email Address: </label> 
			<input type="email" name= "email" id="email"  size="35" required="required"/>
		</p>
		<fieldset>
		<legend>Address</legend>
		<p>
		<label for="stAddress">Street Address: </label><input type="text" id="stAddress" name="stAddress" maxlength="40" required="required"/>
		</p>
		<p>
		<label for="subTown">Suburb/town: </label><input type="text" id="subTown" name="subTown" maxlength="20" required="required"/>
		</p>
		<p>
			<label for="state">State: </label>
			<select name="state" id="state" required="required">
				<option value="">Please Select State</option>			
				<option value="VIC">VIC</option>
				<option value="NSW">NSW</option>
				<option value="QLD">QLD</option>
				<option value="NT">NT</option>
				<option value="WA">WA</option>
				<option value="SA">SA</option>
				<option value="TAS">TAS</option>
				<option value="ACT">ACT</option>
			</select>
		</p>
		<p><label for="postCode">Postcode: </label> 
			<input type="text" name= "postCode" id="postCode" maxlength="20" size="10" required="required" pattern="\d{4}"/>
		</p>
		</fieldset>
		<p>
		<label for="phoneNumber">Phone number: </label><input type="tel" id="phoneNumber" name="phoneNumber" maxlength="10" pattern="\d{10}" placeholder="‎0xxxxxxxxx " required="required"/>
		</p>
		<p>Preferred contact: </p>
		<p><label><input type="radio" id="email2" name="pContact" value="email"/>Email</label> 
			   <label><input type="radio" id="post" name="pContact" value="post" />Post</label> 
			   <label><input type="radio" id="phone" name="pContact" value="phone" />Phone</label>
		</p>
		<p>
			<label for="genre">Movie genres: </label>
			<select name="genre" id="genre" required="required">
				<option value="">Please Select Genres</option>			
				<option value="Action">Action</option>
				<option value="Adventure">Adventure</option>
				<option value="Comedy">Comedy</option>
				<option value="Crime">Crime</option>
				<option value="Drama">Drama</option>
				<option value="Fantasy">Fantasy</option>
				<option value="Horror">Horror</option>
				<option value="Science fiction">Science fiction</option>
			</select>
		</p>
		<p>
		<label for="nShow">Now Showing</label><input type="checkbox" id="nShow" name="category[]" value="now showing" checked="checked"/>
		<label for="cSoon">Coming Soon</label><input type="checkbox" id="cSoon" name="category[]" value="Coming Soon"/>
		<label for="_3D">3D</label><input type="checkbox" id="_3D" name="category[]" value="3D"/>
		<label for="mFest">Moives festival</label><input type="checkbox" id="mFest" name="category[]" value="Moives festival"/>
		</p>
		<fieldset id="ticket">
		<legend>Ticket Details</legend>
		<p>
			<label for="seatType">Ticket: </label>
			<select name="seatType" id="seatType">
				<option value="none">Please select your seat</option>			
				<option value="Regular">Regular Seat</option>
				<option value="VIP">VIP Seat</option>
				<option value="Honeymoon">Honeymoon Seat</option>
			</select>
			<label id ="price">___</label><label>/Person</label>
		</p>
		<p>
		<label for="totalSeat">Number of people:</label><input type="text" name="totalSeat" id="totalSeat" maxlength="10" size="10" />
		</p>	 
		<p>
		<label for="seat">Seat:</label><input type="text" name= "seat" id="seat" maxlength="40" size="40" readonly="readonly"/>
		<input type="button" id="bookSeat" value="Clear" />
		</p>
		</fieldset>
		<p>
		<input type="checkbox" id="chkAddress" /><label>Billing Address different from Delivery Address</label>
		</p>
		<fieldset id="billAddress">
		<legend>Address</legend>
		<p>
		<label for="stAddress2">Street Address: </label><input type="text" id="stAddress2" name="stAddress2" maxlength="40" />
		</p>
		<p>
		<label for="subTown2">Suburb/town: </label><input type="text" id="subTown2" name="subTown2" maxlength="20" />
		</p>
		<p>
			<label for="state2">State: </label>
			<select name="state2" id="state2">
				<option value="">Please Select State</option>			
				<option value="VIC">VIC</option>
				<option value="NSW">NSW</option>
				<option value="QLD">QLD</option>
				<option value="NT">NT</option>
				<option value="WA">WA</option>
				<option value="SA">SA</option>
				<option value="TAS">TAS</option>
				<option value="ACT">ACT</option>
			</select>
		</p>
		<p><label for="postCode2">Postcode: </label> 
			<input type="text" name= "postCode2" id="postCode2" maxlength="20" size="10"/>
		</p>
		</fieldset>
		<label for="Comments">Comments</label>
		<p>
		<textarea id="Comments" name="Comments" rows="4" cols="40" placeholder="Write your comments here..."></textarea>
		</p>
	
	<input class="formButton" type= "submit" value="Pay Now"/>
	<input class="formButton" type= "reset" value="Clear"/>
	<input class="formButton" id="debugFlag" type= "button" value="debug"/>
	<label id="currentFlag"></label>
</form>
	
	
</section>
  
   <aside id="ads">
   <h2>Don't miss a chance to win the prize</h2> 
   <h3>2000$ every month</h3>
   <p>when you buy any tickets and register online</p>
   <p>Next time the winner maybe You</p>
   <!--Image from http://cureletcoe.paspartout.com/pages/new-post -->
   <p><img src="images/prize.jpg" alt="win" title="Winner"/></p>
   </aside>
   <aside id="seatBooking">
   <div id="screen">
   <p id="centerLb">Screen</p>
   </div>
   <div id="seatField">
  <table id="cinemaSeat">
	<tr>
		<th class="thCinema">Regular</th>
		<td id="Regular1"></td>
		<td id="Regular2"></td>
		<td id="Regular3"></td>
		<td id="Regular4"></td>
		<td id="Regular5"></td>
		<td id="Regular6"></td>
		<td id="Regular7"></td>
		<td id="Regular8"></td>
		<td id="Regular9"></td>
		<td id="Regular10"></td>
	</tr>
	<tr>
		<th class="thCinema">VIP</th>
		<td id="VIP1"></td>
		<td id="VIP2"></td>
		<td id="VIP3"></td>
		<td id="VIP4"></td>
		<td id="VIP5"></td>
		<td id="VIP6"></td>
		<td id="VIP7"></td>
		<td id="VIP8"></td>
		<td id="VIP9"></td>
		<td id="VIP10"></td>
  </tr>
  <tr>
		<th class="thCinema">Honeymoon</th>
		<td id="Honeymoon1"></td>
		<td id="Honeymoon2"></td>
		<td id="Honeymoon3"></td>
		<td id="Honeymoon4"></td>
		<td id="Honeymoon5"></td>
		<td id="Honeymoon6"></td>
		<td id="Honeymoon7"></td>
		<td id="Honeymoon8"></td>
		<td id="Honeymoon9"></td>
		<td id="Honeymoon10"></td>
  </tr>
</table>
   </div>
   </aside>
   </article>
    <?php
			include_once("php_footer.inc");		
	?>	
</body>

</html>