<?php
$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$token_recup = $_GET['token'];
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
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
	  
	  
	  <br>
	  <?php 

      $id = $_GET['id'];
	 
	  	$resulteuh = $pdo->query('SELECT * FROM hetic_publication WHERE id="'.$id.'"');
	  	while($result_greg = $resulteuh->fetch(PDO::FETCH_ASSOC)){ ?>
      <img src="images/<?php echo $result_greg['nom'];?>" alt="<?php echo $result_greg['nom'];?>">
      <br>
			<?php echo $result_greg['titre'];?>
			<br>
			<?php echo $result_greg['contenu'];?>
			<br>
			<?php echo 'Auteur: '.$result_greg['auteur'];?>
			<br>
			<?php echo $result_greg['date'];
	  
		}?>

        <h3>COMMENTAIRES</h3>

        <?php 

        $affichage_commentaires = $pdo->query('SELECT * FROM commentaires WHERE id_com="'.$id.'"');
        while($result_commentaires = $affichage_commentaires->fetch(PDO::FETCH_ASSOC)){?>
            <?php echo $result_commentaires['titre_com'];?><br>
            <?php echo $result_commentaires['contenu_com'];?><br>
            <?php echo $result_commentaires['auteur_com'];?><br>
            <?php echo $result_commentaires['date_com'].'<br><br><br>';
        
        }?>


<br>



        <?php
            $recup_nom_token = $pdo->query('SELECT * FROM hetic_inscription WHERE token="'.$token_recup.'"');
            $essai_recup_token = $recup_nom_token->fetch(PDO::FETCH_ASSOC);
            
            $test = $essai_recup_token['nom'].' '.$essai_recup_token['prenom'];
        
            $resulteuh2 = $pdo->query('SELECT * FROM hetic_publication WHERE id="'.$id.'"');
            $titre_com = $resulteuh2->fetch(PDO::FETCH_ASSOC);
            echo $titre_com['titre'];
        ?>
        <form action="" method="POST">
            <input type="text" placeholder="<?php echo $test;?>" disabled='disabled'><br>
            <input type="text" name="titre_com" placeholder="Titre du commentaire"><br>
            <textarea name="contenu_com" cols="30" rows="10" placeholder="Contenu du commentaire"></textarea><br>
            <input type="submit">
        </form>

        <?php


            $date = date('d-m-Y');
            if($_POST){
                $requete_insert_com = $pdo->prepare("INSERT INTO commentaires (auteur_com, titre_com, contenu_com, date_com, id_com) VALUES (:auteur_com, :titre_com, :contenu_com, :date_com, :id_com)");

                $requete_insert_com->execute(array(
                    'auteur_com'   => $test,
                    'titre_com'    => $_POST['titre_com'],
                    'contenu_com'  => $_POST['contenu_com'],
                    'date_com'     => $date,
                    'id_com'       => $id
                ));
            }

        ?>








	     
	   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>