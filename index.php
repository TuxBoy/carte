<!DOCTYPE>
<html>
  <head>
    <script type='text/javascript' src='http://maps.google.com/maps/api/js'></script>
        <meta charset="utf-8">
    <script type='text/javascript' src='carte.js'></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  </head>
<?php 
function __autoload($class_name) {
  include_once ('./class/'.$class_name.'.class.php');
}
define ('DEBUG','ON');

include_once './config/db.inc.php';
// Connexion a la base de donnees
try {
	$dbh = new PDO('mysql:host='.$sql['server'].';dbname='.$sql['database'], $sql['login'], $sql['pass']);
}
catch (PDOException $e) {
	echo '<p class="error">Impossible de se connecter à la base de données, veuillez réessayer.</p>';
	exit;
}

$Commerces = new Commerces($dbh);

$ListCommerces = $Commerces->GetListCommerce();

$adresses_lat = '';
$adresses_lng = '';
$identify_customer='';
for($i=0;$i<count($ListCommerces)-1;$i++){
  $adresses_lat .= "'".$ListCommerces[$i]['lat']."', ";
  $adresses_lng .= "'".$ListCommerces[$i]['lng']."', ";
  $identify_customer .= '"'.$ListCommerces[$i]['nom'].'", ';
}

$adresses_lat = "[".substr($adresses_lat,0,-2)."]";
$adresses_lng = "[".substr($adresses_lng,0,-2)."]";
$identify_customer = "[".substr($identify_customer,0,-2)."]";
?>
<!-  --------------------- FIN DU PHP ---------------------------------  --> 

	<body>

	<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    <!-- ###########################################  FOOTER HAUT ##################################################### -->
    <div class="fl_left">
      <ul class="nospace inline pushright">
        <li><i class="fa fa-phone"></i>06 41 93 56 75</li>
        <li><i class="fa fa-envelope-o"></i> mr.metayer.enzo@gmail.com</li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="nospace inline pushright">
        <li><i class="fa fa-sign-in"></i> <a href="#">Connexion</a></li>
        <!-- <li><i class="fa fa-user"></i> <a href="#">S'inscrire</a></li> -->
      </ul>
    </div>
  </div>
</div> 
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 

    <div id="logo" class="fl_left">
      <h1><a href="index.php">Drazozo</a></h1>
    </div>
    <div id="search" class="fl_right">
      <form class="clear" method="post" action="#">
        <fieldset>
          <legend>Search:</legend>
          <input type="search" value="" placeholder="Votre recherche&hellip;">
          <button class="fa fa-search" type="submit" title="Search"><em>Search</em></button>
        </fieldset>
      </form>
    </div>
  </header>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="mainav" class="hoc clear"> 
    <ul class="clear">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a class="drop" href="#">Dropdown</a>
        <ul>
          <li><a href="#">Level 2</a></li>
          <li><a class="drop" href="#">Level 2 + Drop</a>
            <ul>
              <li><a href="#">Level 3</a></li>
              <li><a href="#">Level 3</a></li>
              <li><a href="#">Level 3</a></li>
            </ul>
          </li>
          <li><a href="#">Level 2</a></li>
        </ul>
      </li>
      <li><a href="#">Link Text</a></li>
      <li><a href="#">Link Text</a></li>
      <li><a href="#">Link Text</a></li>
      <li><a href="#">Long Link Text</a></li>
    </ul>
  </nav>
</div>
<!-- ################################################   CARTE   ################################################ -->
		<script>
			window.onload = function() {
				InitTab(8);
				var maCarte = new Carte(10, 48, 2, 'ROADMAP');

				var adresses_lat = <?php echo $adresses_lat; ?>;
	            var adresses_lng = <?php echo $adresses_lng; ?>;
	            var identify_customer = <?php echo $identify_customer; ?>;
	            for (var i = 0; i < adresses_lat.length; i++) {
	            	maCarte.addMarker('<b>'+identify_customer[i]+'</b>', identify_customer[i], 'http://labs.google.com/ridefinder/images/mm_20_green.png', adresses_lat[i], adresses_lng[i], 1, i, true);
	            }


				}
		</script>

		</form>
		<br/>
		<div id='map' class='map' style='width:100%; height:70%' >
		</div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>

    <!-- ################################################################################################ -->		
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="center btmspace-50">
      <h2 class="heading">Les différentes catégories</h2>
      <p>Retrouve les principals catégories en image en dessous.</p>
    </div>
    <article class="one_third first btmspace-50">
      <h3 class="font-x1 btmspace-30"> <img src="icon/automobile.png" height="20" width="10" >  </i> <a href="#">Automobile</a></h3>
      <p>Bibendum et vestibulum condimentum rutrum arcu sed posuere sem in eu lectus sit amet dolor ultrices suscipit aliquam vestibulum sollicitudin dapibus&hellip;</p>
    </article>
    <article class="one_third btmspace-50">
      <h3 class="font-x1 btmspace-30">  <img src="icon/docteur.png" height="20" width="10" >  <a href="#">Santé & médecine</a></h3>
      <p>Nunc enim sapien elementum ac aliquam in tempus a tortor vivamus at arcu ut tellus fermentum rutrum a eu orci vestibulum ante ipsum primis in faucibus&hellip;</p>
    </article>
    <article class="one_third btmspace-50">
      <h3 class="font-x1 btmspace-30">  <img src="icon/education.png" height="20" width="10" >   <a href="#">Education</a></h3>
      <p>Ultrices posuere cubilia curae nam placerat neque eu elit eleifend gravida ut efficitur lacus et ex ullamcorper eget molestie massa lacinia donec euismod&hellip;</p>
    </article>

        <article class="one_third first btmspace-50">
      <h3 class="font-x1 btmspace-30"> <img src="icon/food.png" height="20" width="10" >  </i> <a href="#">Restaurant & fast food </a></h3>
      <p>Bibendum et vestibulum condimentum rutrum arcu sed posuere sem in eu lectus sit amet dolor ultrices suscipit aliquam vestibulum sollicitudin dapibus&hellip;</p>
    </article>
    <article class="one_third btmspace-50">
      <h3 class="font-x1 btmspace-30">  <img src="icon/muse.png" height="20" width="10" >  <a href="#">Musée</a></h3>
      <p>Nunc enim sapien elementum ac aliquam in tempus a tortor vivamus at arcu ut tellus fermentum rutrum a eu orci vestibulum ante ipsum primis in faucibus&hellip;</p>
    </article>
    <article class="one_third btmspace-50">
      <h3 class="font-x1 btmspace-30">  <img src="icon/ordinateur.png" height="20" width="10" >   <a href="#">Gravida nec non</a></h3>
      <p>Ultrices posuere cubilia curae nam placerat neque eu elit eleifend gravida ut efficitur lacus et ex ullamcorper eget molestie massa lacinia donec euismod&hellip;</p>
    </article>


    <article class="one_third first btmspace-50">
      <h3 class="font-x1 btmspace-30"> <img src="icon/shop.png" height="20" width="10" >  </i> <a href="#">Magasin</a></h3>
      <p>Bibendum et vestibulum condimentum rutrum arcu sed posuere sem in eu lectus sit amet dolor ultrices suscipit aliquam vestibulum sollicitudin dapibus&hellip;</p>
    </article>
    <article class="one_third btmspace-50">
      <h3 class="font-x1 btmspace-30">  <img src="icon/sport.png" height="20" width="10" >  <a href="#">Sport & sortie</a></h3>
      <p>Nunc enim sapien elementum ac aliquam in tempus a tortor vivamus at arcu ut tellus fermentum rutrum a eu orci vestibulum ante ipsum primis in faucibus&hellip;</p>
    </article>
    <article class="one_third btmspace-50">
      <h3 class="font-x1 btmspace-30">  <img src="icon/transport.png" height="20" width="10" >   <a href="#">Voyage & transport</a></h3>
      <p>Ultrices posuere cubilia curae nam placerat neque eu elit eleifend gravida ut efficitur lacus et ex ullamcorper eget molestie massa lacinia donec euismod&hellip;</p>
    </article>




  


    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay">
  <div class="hoc container clear"> 
    <article class="center">
      <h2 class="font-x3 uppercase">Lacus ligula malesuada</h2>
      <p class="btmspace-50">Ac egestas at justo quisque lobortis ipsum sapien sed lacinia libero</p>
      <footer>
        <ul class="nospace inline pushright">
          <li><a class="btn inverse" href="#">Convallis</a></li>
          <li><a class="btn" href="#">Vestibulum</a></li>
        </ul>
      </footer>
    </article>
   
  </div>
</div>


<!-- ################################################################################################ -->
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="center btmspace-50">
      <h2 class="heading">Pretium nec nunc tincidunt</h2>
      <p>Neque nisl id dictum nisi lacinia vel proin at dolor elit morbi sagittis turpis dolor.</p>
    </div>
    <ul class="nospace group">
      <li class="one_third first">
        <article class="element">
          <figure><img src="" alt="">
            <figcaption><a href="#"><i class="fa fa-eye"></i></a></figcaption>
          </figure>
          <div class="excerpt">
            <h6 class="heading">Congue dolor venenatis</h6>
            <time datetime="2045-04-05">5<sup>th</sup> April 2045</time>
            <p>Id donec feugiat placerat enim facilisis maximus leo pellentesque vitae&hellip;</p>
            <footer><a href="#">Read More &raquo;</a></footer>
          </div>
        </article>
      </li>
      <li class="one_third">
        <article class="element">
          <figure><img src="" alt="">
            <figcaption><a href="#"><i class="fa fa-eye"></i></a></figcaption>
          </figure>
          <div class="excerpt">
            <h6 class="heading">Tincidunt lectus ex</h6>
            <time datetime="2045-04-05">5<sup>th</sup> April 2045</time>
            <p>Vel sagittis dui gravida sit amet morbi porttitor sed neque a porta&hellip;</p>
            <footer><a href="#">Read More &raquo;</a></footer>
          </div>
        </article>
      </li>
      <li class="one_third">
        <article class="element">
          <figure><img src="" alt="">
            <figcaption><a href="#"><i class="fa fa-eye"></i></a></figcaption>
          </figure>
          <div class="excerpt">
            <h6 class="heading">Convallis venenatis</h6>
            <time datetime="2045-04-05">5<sup>th</sup> April 2045</time>
            <p>Ut pellentesque lacus vel dapibus fermentum odio commodo&hellip;</p>
            <footer><a href="#">Read More &raquo;</a></footer>
          </div>
        </article>
      </li>
    </ul>
  </section>
</div>

<!-- ################################################################################################ -->

<div class="wrapper row4 bgded overlay">
  <footer id="footer" class="hoc clear"> <br>
    <div class="group">
      <div class="one_quarter first">
        <h6 class="title">Diam cras vel magna</h6>
        <p>Dapibus sit amet erat eu pellentesque praesent nec cursus arcu in leo velit pulvinar et est nec bibendum maximus justo maecenas.</p>
        <p>Volutpat arcu cursus lobortis nunc felis neque rhoncus sit amet ex non facilisis facilisis libero vestibulum.</p>
      </div>
      <div class="one_quarter">
        <h6 class="title">Vulputate pulvinar</h6>
        <ul class="nospace linklist">
          <li><a href="#">Vulputate finibus quam ut</a></li>
          <li><a href="#">Sed dolor et augue semper</a></li>
          <li><a href="#">Luctus quisque malesuada</a></li>
          <li><a href="#">Vehicula nunc id fermentum</a></li>
          <li><a href="#">Morbi ultrices velit ac</a></li>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="title">Aliquet eleifend</h6>
        <ul class="nospace linklist">
          <li><a href="#">Pharetra pellentesque feugiat</a></li>
          <li><a href="#">Nunc ut bibendum porttitor</a></li>
          <li><a href="#">Nam at sollicitudin sapien</a></li>
          <li><a href="#">A auctor ligula nullam tincidunt</a></li>
          <li><a href="#">Arcu commodo condimentum</a></li>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="title">Aliquam tristique</h6>
        <ul class="nospace linklist">
          <li>
            <article>
              <h2 class="nospace font-x1"><a href="#">Sit amet elit pharetra</a></h2>
              <time class="font-xs block btmspace-10" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
              <p class="nospace">Cursus phasellus cursus ipsum sed neque pellentesque&hellip;</p>
            </article>
          </li>
          <li>
            <article>
              <h2 class="nospace font-x1"><a href="#">Condimentum vulputate</a></h2>
              <time class="font-xs block btmspace-10" datetime="2045-04-05">Thursday, 5<sup>th</sup> April 2045</time>
              <p class="nospace">Dui nunc lacinia arcu vitae porta quam quam vitae&hellip;</p>
            </article>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</div>

<!-- ################################################################################################ -->

<div class="wrapper row5">
  <div id="social" class="hoc clear"> 
    <div class="one_half first">
      <h6 class="title">Social Media</h6>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="https://www.facebook.com/drazozoyt/"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-google-plus" href="https://plus.google.com/u/0/114329288585913193997"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-youtube" href="https://www.youtube.com/drazozo"><i class="fa fa-youtube"></i></a></li>
      </ul>
    </div>
    <div class="one_half">
      <h6 class="title">Newsletter</h6>
      <form class="clear" method="post" action="#">
        <fieldset>
          <legend>Newsletter:</legend>
          <input type="text" value="" placeholder="Type Email Here&hellip;">
          <button class="fa fa-share" type="submit" title="Submit"><em>Submit</em></button>
        </fieldset>
      </form>
    </div>
  </div>
</div>

<!-- ################################################################################################ -->

<div class="wrapper row6">
  <div id="copyright" class="hoc clear"> 

    <p class="fl_left">Copyright &copy; 2017 - Tous droits réservé</p>
    <p class="fl_right">Enzo<a target="_blank" href="#" title="Free Website Templates">Métayer</a></p>

  </div>
</div>
