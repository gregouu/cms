<?php
$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>The best CMS 4 ever</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>
      <?php
        if(isset($_GET['token'])){
          echo '<li class="nav-item"><a class="nav-link" href="location.php">Admin</a></li>';
        }
       
      ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
	  	  <?php 

      if(isset($_GET['token'])){
        $token_recup = $_GET['token'];
      }

	 
	  	$resulteuh = $pdo->query("SELECT * FROM hetic_publication");
	  	while($result_greg = $resulteuh->fetch(PDO::FETCH_ASSOC)){ ?>
      <?php 
      if(isset($_GET['token'])){
        echo "<a href='publi.php?id=".$result_greg["id"]."&token=".$token_recup."'>";
      }
      else{
        echo "<a href='publi.php?id=".$result_greg["id"]."'>";
      }
      ?>
      <div>
      <img src="images/<?php echo $result_greg['nom']; ?>" alt="<?php echo $result_greg['nom']; ?>">
      <br>
			<?php echo $result_greg['titre']; ?>
			<br>
			<?php echo $result_greg['contenu'];?>
			<br>
			<?php echo 'Auteur: '.$result_greg['auteur'];?>
			<br>
			<?php echo $result_greg['date'];
      echo '</div>';
	    echo '</a>';
    }?>
	     
	   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>