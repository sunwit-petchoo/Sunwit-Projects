<!DOCTYPE html>
<html lang="en">
<head>
<title>SP Cinema HomePage</title>
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
   <section class="mainCenter">
   <!-- Image from http://www.lescheminsdelamemoire.com/new-movies-coming-soon-best-of-2017/ -->
   <img id="mainPic" src="images/best2017.jpg" alt="SP movies banner" title="SP movies banner"/>
   </section>
   <aside>
	<h2>Movies news</h2>
	<p>Here is the best movies of 2017 which has been voted from many people around the world. Also, many website recommend all of these movies
	with high rate such as rotten tomato,IMDB 
	</p>
	<p>Here is the top 3</p>
	<ul>
	<li>Guardians of the Galaxy Vol. 2</li>
	<li>Wonder women</li>
	<li>Batman v Superman: Dawn of Justice</li>
	</ul>
    </aside>
	
	</article>
   <?php
			include_once("php_footer.inc");		
	?>
</body>

</html>