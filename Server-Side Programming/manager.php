<!DOCTYPE html>
<html lang="en">
<head>
<title>Manager</title>
 
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
	<h1>SP Cinema Movies - Manager</h1>
  </header>
   <?php
			include_once("php_Menu.inc");		
	?>
	<section>
	<form id="searchOrder" action="manager.php" method="post" novalidate="novalidate">
		<fieldset id="fixTicket">
		<legend>Searh</legend>
		<p><label for="firstName">Customer First Name: </label> 
			<input type="text" id="firstName" name="firstName" size="30" maxlength="25" value="" />
		</p>
		<p><label for="lastName">Customer Last Name: </label> 
			<input type="text" name="lastName" id="lastName" size="30" maxlength="25" value="" />
		</p>
		<p>
			<label for="seatType">Seat Type: </label>
			<select name="seatType" id="seatType">
				<option value="">Select Seat Type</option>			
				<option value="Regular">Regular Seat</option>
				<option value="VIP">VIP Seat</option>
				<option value="Honeymoon">Honeymoon Seat</option>
			</select>
		</p>
		<p>
			<label for="orderStatus">Order Status: </label>
			<select name="orderStatus" id="orderStatus">
				<option value="">Select Order Status</option>	
				<option value="ALL">All Order</option>			
				<option value="PENDING">PENDING</option>
				<option value="FULFILLED">FULFILLED</option>
				<option value="PAID">PAID</option>
				<option value="ARCHIVED">ARCHIVED</option>
			</select>
		</p>
		<p>
			<label for="totalCostSort">Sorted by Total cost : </label>
			<select name="totalCostSort" id="totalCostSort">
				<option value="DESC">Descending Order</option>			
				<option value="ASC">Ascending Order</option>
				
			</select>
		</p>
		</fieldset>
		<input type="submit" value="Search" />
	</form>
	<form id="updateOrder" action="manager.php" method="post" novalidate="novalidate">
		<fieldset id="fixTicketU">
		<legend>Update Order Status</legend>
		<?php
		
		if(isset($_GET["orderId"]))
		{
		if($_GET["flag"] == "edit"){	
		$orderId = $_GET["orderId"];
		echo "<p>Update - Order number  ",$orderId,"</p>";
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
			
			$query = "Select order_id,order_time,genre,seat_type,total_seat,order_cost,first_name,last_name,order_status from orders where order_id = $orderId";
			$result = mysqli_query($conn, $query);
			
			if(!$result)
			{
				echo "<p>Something is worng with ",$query, "</p>";
			}else
			{
				echo "<table id='updateStatusTable' border=\"1\">\n";
				echo "<tr>\n "
				."<th scope=\"col\">Order Number</th>\n "
				."<th scope=\"col\">Order Date</th>\n "
				."<th scope=\"col\">Genre</th>\n "
				."<th scope=\"col\">Seat Type</th>\n "
				."<th scope=\"col\">Total Seat</th>\n "
				."<th scope=\"col\">Order Cost</th>\n "
				."<th scope=\"col\">First Name</th>\n "
				."<th scope=\"col\">Last Name</th>\n "
				."<th scope=\"col\">Order Status</th>\n "
				."</tr>\n ";
				
				while ($row = mysqli_fetch_row($result))
				{
					echo "<tr>\n ";
					for($i=0;$i<9;$i++)    
					{
						echo "<td>",$row[$i],"</td>\n ";
					}	
					echo "</tr> \n";
				}
				echo "</table>\n ";
				mysqli_free_result($result);
			}
			mysqli_close($conn);
		}
		echo "<input type='hidden' name='updateId' value='",$orderId,"'>";
		}
		}
		?>
		<p>
			<label for="orderStatusN">New Order Status: </label>
			<select name="orderStatusN" id="orderStatusN">				
				<option value="PENDING">PENDING</option>
				<option value="FULFILLED">FULFILLED</option>
				<option value="PAID">PAID</option>
				<option value="ARCHIVED">ARCHIVED</option>
			</select>
		</p>
		
		</fieldset>
		<input type="submit" value="Update" />
	</form>
	<?php 
	if(isset($_GET["orderId"]))
		{
			if($_GET["flag"] == "delete")
			{
				$orderId = $_GET["orderId"];
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
			
			$query = "DELETE FROM orders WHERE order_id = $orderId";
			$result = mysqli_query($conn, $query);
			
			if(!$result)
			{
				echo "<p>Something is worng with ",$query, "</p>";
			}else
			{
				echo "<p class='msgSuccess'>Successfully Cancelled " .mysqli_affected_rows($conn)." record(s).</p>";
			}
			mysqli_close($conn);
		}
			}
		}
	?>
	<?php 
	if(isset($_POST["orderStatusN"]))
	{
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
			
				$updateId = $_POST["updateId"];
				$orderStatus = $_POST["orderStatusN"];
				$query = "UPDATE orders SET order_status='$orderStatus' where order_id=$updateId";
				
				$result = mysqli_query($conn, $query);
			
			if(!$result)
			{
				echo "<p>Something is worng with ",$query, "</p>";
			}else
			{
				echo "<p class='msgSuccess'>Successfully updated " .mysqli_affected_rows($conn)." record(s).</p>";
			}
			mysqli_close($conn);
		}
	}
	?>
	
	<?php 
	if(isset($_POST["firstName"]))
	{
		
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
			$orderStatus = $_POST["orderStatus"];
			$lastName = $_POST["lastName"];
			$firstName = $_POST["firstName"];
			$seatType = $_POST["seatType"];
			$totalCostSort = $_POST["totalCostSort"];
			
			if($orderStatus == "ALL")
			{
				$query = "Select order_id,order_time,genre,seat_type,total_seat,order_cost,first_name,last_name,order_status from orders order by order_cost $totalCostSort";
			}else
			{
				$query = "Select order_id,order_time,genre,seat_type,total_seat,order_cost,first_name,last_name,order_status from orders 
				where first_name like '%$firstName%' and last_name like '%$lastName%' and seat_type like '%$seatType%' and order_status like '%$orderStatus%' 
				order by order_cost $totalCostSort";
			}
			
			
			$result = mysqli_query($conn, $query);
			
			if(!$result)
			{
				echo "<p>Something is worng with ",$query, "</p>";
			}else
			{
				echo "<table id='result' border=\"1\">\n";
				echo "<tr>\n "
				."<th scope=\"col\">Order Number</th>\n "
				."<th scope=\"col\">Order Date</th>\n "
				."<th scope=\"col\">Genre</th>\n "
				."<th scope=\"col\">Seat Type</th>\n "
				."<th scope=\"col\">Total Seat</th>\n "
				."<th scope=\"col\">Order Cost</th>\n "
				."<th scope=\"col\">First Name</th>\n "
				."<th scope=\"col\">Last Name</th>\n "
				."<th scope=\"col\">Order Status</th>\n "
				."<th scope=\"col\"></th>\n "
				."<th scope=\"col\"></th>\n "
				."</tr>\n ";
				
				while ($row = mysqli_fetch_row($result))
				{
					echo "<tr>\n ";
					for($i=0;$i<9;$i++)    
					{
						echo "<td>",$row[$i],"</td>\n ";
					}	
						//echo "<td>",$row[0],"</td>\n ";
						echo " <td><a href=\"manager.php?orderId=$row[0]&flag=edit\">edit</a></td>";
						
						if($row[8] == "PENDING")
						{
						echo " <td><a href=\"manager.php?orderId=$row[0]&flag=delete\">cancel</a></td>";
						}else
						{
							echo "<td></td>";
						}
					echo "</tr> \n";
				}
				echo "</table>\n ";
				mysqli_free_result($result);
			}
			mysqli_close($conn);
		}
	}
?>
</section>
 </article>
</body>
</html>