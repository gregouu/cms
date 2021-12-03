<?php include ('partials/head.php')?>
<?php include ('partials/header.php')?>

	  	  <?php 

      $token_recup = $_GET['token'];
	 
	  	$resulteuh = $pdo->query("SELECT * FROM hetic_publication");
	  	while($result_greg = $resulteuh->fetch(PDO::FETCH_ASSOC)){ ?>
      <?php echo "<a href='publi.php?id=".$result_greg["id"]."&token=".$token_recup."'>";?>
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