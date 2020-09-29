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
            $query = $_GET['query']; 
    
     
            $min_length = 3;
    // you can set minimum length of the query if you want
     
            if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
                $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
                $query = pg_escape_string($query);
        // makes sure nobody uses SQL injection
         
                $raw_results = pg_query($d, "SELECT * FROM artiste
                WHERE (nom LIKE '%".$query."%') OR (prenom LIKE '%".$query."%')") or die(pg_last_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
                if(pg_num_rows($raw_results) > 0){ // if one or more rows are returned do following
                    while($results = pg_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                    
                        echo '<section>';
                        echo "<h2> Voici : </h2>";
                        echo "<p> Nom : ".$results['nom']."</p>";
                        echo "<p> Prénom : ".$results['prenom']."</p>";
                        echo "<p> Role de prédilection : ".$results['role']."</p>";
                        echo "<p> Genre de prédilection : ".$results['genre_pred']."</p>";
                        echo "<p> Status : ".$results['status']."</p>";
                        echo "<p> Pays d'origine : ".$results['origin_a']."</p>";
                        echo "<p> Groupe d'origine :  ".$results['groupe_a']."</p>";
                    
                // posts results gotten from database(title and text) you can also show id ($results['id'])
                }
             
                }
                else{ // if there is no matching rows do following
                    echo "Aucun résultat ne correspond à votre recherche.";
                }
         
                }
                else{ // if query length is less than minimum
                    echo "La taille minimum de votre recherche doit être de  ".$min_length;
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
