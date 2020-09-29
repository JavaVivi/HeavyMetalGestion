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
			<p><a href="recherche_avancee.php" >Recherche avancée</a></p>
		</header>
        <?php
			include "./include/util.inc.php";
		?>
		<hr>
         <?php
            $d = pg_connect('host=localhost user=postgres password=root dbname=postgres connect_timeout=5');
            $query = 'SELECT * FROM groupe ORDER BY origin_g';
            $data = pg_query($d, $query) or die(pg_last_error());
            if(pg_num_rows($data) > 0){
                 while($results = pg_fetch_array($data)){
                     echo "<p>".$results['nom_g']." ".$results['origin_g']."</p>";
                 }
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