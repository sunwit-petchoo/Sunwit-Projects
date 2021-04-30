<!DOCTYPE html>
<html lang="en">
<head>
<title>Product</title>
  
  <meta name="description" content="SP Cinema website" />
  <meta name="keywords" content="Movies, Ticket,ShowTime" />
  <meta name="author" content="Sunwit Petchoo"  />
  <meta charset ="utf-8"/>
  <link href="styles/style.css" rel="stylesheet" />
</head>

<body>
   <article>
   <?php
			include_once("php_HnMenu.inc");		
	?>
   <!--graphic and advertisement-->
   
   <section id="section1">
   <h3>Hot deals</h3>
   <table id="hotDeals">
   <thead>
   <tr>
   <th>Condition</th>
   <th>Price/person</th>
   </tr>
   </thead>
   <tbody>
   <tr>
   <td>Monday after 6 pm.</td>
   <td class="priceCenter">10$</td>
   </tr>
   <tr>
   <td>Tuesday  6 - 9 pm.</td>
   <td class="priceCenter">10$</td>
   </tr>
   <tr>
   <td>Wednesday Before 1 pm.</td>
   <td class="priceCenter">10$</td>
   </tr>
   <tr>
   <td>Thursday  9 - 11 am.</td>
   <td class="priceCenter">10$</td>
   </tr>
   <tr>
   <td>Friday 1 - 3 pm.</td>
   <td class="priceCenter">10$</td>
   </tr>
   <tr>
   <td>Saturday Buy 2 tickets</td>
   <td class="priceCenter">10$</td>
   </tr>
   <tr>
   <td>Sunday 3 - 6 pm.</td>
   <td class="priceCenter">10$</td>
   </tr>
   </tbody>
   </table>
   </section>
   <aside id = "asideProduct">
   <h2>Don't miss a chance to win the prize</h2> 
   <h3>2000$ every month</h3>
   <p>when you buy any tickets and register online</p>
   <p>Next time the winner maybe You</p>
   <hr/>
   <h3>How to enjoy your movies</h3>
   <ol>
   <li>Choose your movies</li>
   <li>But ticket online/at ticket counter</li>
   <li>Have some snacks</li>
   <li>Enjoy your favourite movies</li>
   </ol>
   <h3>Candy bar</h3>
   <ul>
   <li>Coke</li>
   <li>Jelly Bear</li>
   <li>Popcorn</li>
   <li>Candy</li>
   <li>Kitkat</li>
   <li>Cracker</li>
   </ul>
   </aside>
   <section id="section2">
   <!--Image from https://www.lovejoyflowershop.com/product/58a1b3f54875a/add-a-candy-bar -->
   <img src="images/candy.jpg" alt="candy" title="candy"/>
   </section>
   </article>
   <?php
			include_once("php_footer.inc");		
	?>
</body>

</html>