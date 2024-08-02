<?php 

// class Securite pour éviter les injections SQL
	class Securite
	{
		// Données entrantes
		public static function bdd($string,$bdd2)
		{
			// On regarde si le type de string est un nombre entier (int)
			if(ctype_digit($string))
			{
				$string=intval($string);
			}
			// Pour tous les autres types
			else
			{
				$string=mysqli_real_escape_string($bdd2,$string);
				$string=addcslashes($string, '%_');
			}
				
			return $string;

		}
		// Données sortantes
		public static function html($string)
		{
			return htmlentities($string);
		}
	}

 ?>