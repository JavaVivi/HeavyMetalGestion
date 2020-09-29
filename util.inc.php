<?php

			define("DEFAULT_LANG", "fr");
		/**
			*Renvoit la date du jour, en français par défaut.
			*@param $lang la langue (français par défaut)
		*/
		
		function date_jour($lang = DEFAULT_LANG) {
			//Si la variable lang n'est pas en, soit vide soit autre valeur, on affiche la date du jour en français. Le cas échéant, la date est affichée en anglais.
			if($lang != "en"){
				$lang = DEFAULT_LANG;
				date_default_timezone_set('Europe/Paris');
				setlocale(LC_TIME, 'fr_FR.utf8','fra');
				echo "Date du jour : ", strftime("%A %d %B %Y");
			}
			else{
				echo "Date of the day : ", strftime("%A %d %B %Y");
			
			}
		}
                






















?>