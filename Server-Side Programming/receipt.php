<!DOCTYPE html>
<html lang="en">
<head>
<title>Receipt</title>
 
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
  <header>
	<h1>SP Cinema Movies - Order Receipt</h1>
  </header>
   <?php
			include_once("php_Menu.inc");		
	?>
	<section>
	<?php
		if(isset($_GET["orderId"])){	
		require_once ("setting.php");
		$conn = @mysqli_connect($host,
		$user,
		$pwd,
		$sql_db
		);
		if(!$conn)
		{
			echo "<p> Database connection failure</p>";
		}else
		{
			$orderId = $_GET["orderId"];
			$sql_table = "orders";
			$ast = "****";
			$query = "Select * from orders where order_id = $orderId";
			
			$result = mysqli_query($conn, $query);
			
			if(!$result)
			{
				echo "<p>Something is worng with ",$query, "</p>";
			}else
			{
				echo "<table id='receipt' border=\"1\">\n";
				echo "<tr>\n "
				."<th scope=\"col\">First Name</th>\n "
				."<th scope=\"col\">Last Name</th>\n "
				."<th scope=\"col\">Email</th>\n "
				."<th scope=\"col\">Street Address</th>\n "
				."<th scope=\"col\">Suburb</th>\n "
				."<th scope=\"col\">State</th>\n "
				."<th scope=\"col\">Postcode</th>\n "
				."<th scope=\"col\">Phone Number</th>\n "
				."<th scope=\"col\">Prefer Contact</th>\n "
				."<th scope=\"col\">Genre</th>\n "
				."<th scope=\"col\">Seat Type</th>\n "
				."<th scope=\"col\">Total Seat</th>\n "
				."<th scope=\"col\">Order Id</th>\n "
				."<th scope=\"col\">Order Cost</th>\n "
				."<th scope=\"col\">Order Time</th>\n "
				."<th scope=\"col\">Order Status</th>\n "
				."<th scope=\"col\">Card Type</th>\n "
				."<th scope=\"col\">Card Name</th>\n "
				."<th scope=\"col\">Card No</th>\n "
				."<th scope=\"col\">Expiry Date</th>\n "
				."<th scope=\"col\">CVV</th>\n "
				."</tr>\n ";
				
				while ($row = mysqli_fetch_row($result))
				{
					echo "<tr>\n ";
					for($i=0;$i<21;$i++)    
					{
						if($i>15)
						echo "<td>",$ast,"</td>\n ";
						else
						echo "<td>",$row[$i],"</td>\n ";
					}	
					echo "</tr> \n";
				}
				echo "</table>\n ";
				mysqli_free_result($result);
			}
			mysqli_close($conn);
		}
		}else
		{
			header ("location: enquire.php");
		}
?>

	</section>
	</article>
	<footer>
	<h1>Thank you for ordering</h1>
	</footer>
</body>

</html>