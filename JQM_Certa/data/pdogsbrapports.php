<?php
/**
 * Classe d'accès aux données.

 * Utilise les services de la classe PDO
 * pour l'application Gsb Rapport Mobile
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsbRapports qui contiendra l'unique instance de la classe
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsbRapports{
      	 /*--------------------Version locale---------------------------------------- */
      private static $serveur='mysql:host=localhost';
      private static $bdd='dbname=nom de la base de donnée';
      private static $user='login' ;
      private static $mdp='mot de passe' ;
      private static $monPdo;
      private static $monPdoGsbRapports = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	private function __construct(){
            self::$monPdo = new PDO(self::$serveur.';'.self::$bdd, self::$user, self::$mdp);
            self::$monPdo->query("SET CHARACTER SET utf8");
	}

	public function _destruct(){
            self::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe

 * Appel : $instancePdoGsbRapports = PdoGsbRapports::getPdo();

 * @return l'unique objet de la classe PdoGsbRapports
 */
	public  static function getPdo(){
		if(self::$monPdoGsbRapports == null){
			self::$monPdoGsbRapports = new PdoGsbRapports();
		}
		return self::$monPdoGsbRapports;
	}

  public function getLeVisiteur($login, $mdp){
  		$req = "select id, nom, prenom from visiteur where login = :login and mdp = :mdp";
                  $stm = self::$monPdo->prepare($req);
                  $stm->bindParam(':login', $login);
                  $stm->bindParam(':mdp', $mdp);
                  $stm->execute();
          	$laLigne = $stm->fetch();
                  if(count($laLigne)>1)
                     return $laLigne;
                  else
                      return NULL;
}
}   // fin classe
?>
