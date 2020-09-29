<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>
	<body>
		<header>
			<h1>Base de données du heavy metal</h1>
			<nav class="nav">
				<p><a href="index.php" >Accueil</a></p>
				<p><a href="groupes.php" >Groupes</a></p>
				<p><a href="artistes.php" >Artistes</a></p>
				<p><a href="albums.php" >Albums</a></p>
				<p><a href="concerts.php" >Concerts</a></p>
				<p><a href="festivals.php" >Festivals</a></p>
                <p><a href="inscription.php" >Inscription</a></p>
                <p><a href="Connexion.php" >Connexion</a></p>
                <p><a href="Profil.php" >Profil</a></p>
                <p><a href="Billeterie.php" >Billeterie</a></p>
		   </nav>
			<p>Bienvenue sur la base de données du heavy metal où vous pouvez voir les fiches des groupes, artistes, albums, concerts
			et festivals tournant autour de ce style de musique.</p>
			<p>Si vous avez une question, vous trouverez les coordonnées des administrateurs du site en bas de page.</p>
			<form method="GET" action="search.php">
                <form action="search.php" method="GET">
                    <label for="query">Rechercher par nom d'artiste:</label>
                    <input type="text" name="query" />
                    <input type="submit" value="Rechercher" />
			</form>
		</header>
        <?php
			include "./include/util.inc.php";
		?>
		<hr>
        <p>Recherche d'un groupe par recherche avancée : </p>
        <form method="POST" action="group_advanced.php">
            <label>Nom</label> : <input type="text" name="nom"/>
            <label>Genre</label> : <input type="text" name="genre" />
            <label>Origine</label> : <input type="text" name="origine" />
            <input type="submit" value="Envoyer" />
        </form>
        <?php
             $d = pg_connect('host=127.0.0.1 user=postgres password=root dbname=postgres connect_timeout=5');
             $nom = $_POST['nom'];
             $genre = $_POST['genre'];
             $origine = $_POST['origine'];
             $nom = htmlspecialchars($nom);
             $genre = htmlspecialchars($genre);
             $origine = htmlspecialchars($origine);
             //$nom = pg_escape_string($nom);
            // $prenom = pg_escape_string($prenom);
             //$role = pg_escape_string($role);
            // $genre = pg_escape_string($genre);
             //$groupe = pg_escape_string($groupe);
             
              $raw_results = pg_query($d, "SELECT * FROM groupe
              WHERE (nom LIKE '%".$nom."%') AND (genre LIKE '%".$genre."%') AND (origin_a LIKE '%".$origine."%')") or die(pg_last_error());
              if(pg_num_rows($raw_results) > 0){ // if one or more rows are returned do following
                    while($results = pg_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                    
                        echo '<section>';
                        echo "<h2> Voici : </h2>";
                        echo "<p> Nom : ".$results['nom_g']."</p>";
                        echo "<p> Genre : ".$results['genre']."</p>";
                        echo "<p> Date de création : ".$results['date_creat']."</p>";
                        echo "<p> Site Web : ".$results['weblink']."</p>";
                        echo "<p> Pays d'origine : ".$results['origin_g']."</p>";
                        
                    
                // posts results gotten from database(title and text) you can also show id ($results['id'])
                }
             
                }
                else{ // if there is no matching rows do following
                    echo "Aucun résultat ne correspond à votre recherche.";
                }
            
         
        ?>
        <footer>
			<p>Site créé par Virginie CAZE et Dewi DELBE dans le cadre du projet de Base de Données en L3.</p>
			<p>Pour toutes demande d'informations, veuillez envoyer un mail à andromede97@gmail.com ou à dewi.delbe@hotmail.fr.</p>
			<?php
			echo '<p style ="margin-left : 1px;">';
				echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
			echo '</p>';
			echo '<p style ="margin-left : 1px;">';
				echo date_jour();
			echo '</p>';
			?>
		</footer>
		
	</body>
</html>