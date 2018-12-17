<?php

// Fonction connexionBD
    class Connexion {
        private $connexion;

        public function __construct() {
    // le chemin vers le serveur
        $PARAM_hote='localhost';
    // Le port de connexion à la base de donnée
        $PARAM_port='3306';
    // Le nom de la base de données
        $PARAM_nom_bd='minifacebook';
    // Le nom d'utilisateur pour se connecter
        $PARAM_utilisateur='adminminifacebook';
    // Le mot de passe de l'utilisateur pour se connecter
        $PARAM_mot_passe='minifacebook';

        try{
            $this->connexion = new PDO(
                'mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd,
                $PARAM_utilisateur,
                $PARAM_mot_passe);
        }
        catch(Exception $e) {
            echo 'Erreur : '.$e->getMessage().'<br/>';
            echo 'N° : '.$e->getCode();
        }
    }

// Fonction getConnexion
    public function getConnexion() {

        return $this->connexion;
    }

// Fonction insertHobby
    public function insertHobby($hobby) {

    try{

            // On prépare notre requète
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO Hobby (Type) 
                VALUES (:hobby)");
            
            $requete_prepare->execute(
                array( 'hobby' => $hobby));
    }
    catch(Exception $e) {
        echo 'Erreur : '.$e->getMessage().'<br/>';
        echo 'N° : '.$e->getCode();
        }
        return $hobby;    
    }       
   

// Fonction insertMusique
    public function insertMusique($style) {

        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Musique (Type) 
            VALUES (:style)");

        $requete_prepare->execute(
            array( 'style' => $style));

    return $style;
    }

// Fonction insertPersonne
    public function insertPersonne($nom, $prenom, $url_photo, $date_naissance, $statut_couple) {


        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Personne (Nom, Prenom, URL_photo, Date_naissance, Statut_couple)
            VALUES (:nom, :prenom, :url_photo, :date_naissance, :statut_couple)");
        
        $requete_prepare->execute(
            array ( 'nom' => $nom, 'prenom' => $prenom, 'url_photo' => $url_photo, 'date_naissance' => $date_naissance, 'statut_couple' => $statut_couple));
      
    }

    public function insertPersonneMusique($p_id, $m_id) {
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO RelationMusique (Personne_ID, Musique_ID) VALUES (:p_id, :m_id)");
        
        $requete_prepare->execute(
            array ( 'p_id' => $p_id, 'm_id' => $m_id));
    }


// Fonction selectAllHobbies
    public function selectAllHobbies2() {


    // on prépare notre requête select
        $requete_prepare=$this->connexion->prepare(
            "SELECT Type FROM Hobby");
        
    // on exécute la requête
        $requete_prepare->execute();
    
    // Met un tableau d'objet dans la variable
    // résultat. Le nom de chaque colonne correspond
    // à une propriété de l'objet
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
    
    return $resultat;
    }

// Fonction selectAllMusics
    public function selectAllMusique2() {

        $requete_prepare=$this->connexion->prepare(
            "SELECT * FROM Musique");

        $requete_prepare->execute();

        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
    }

// Fonction selectPersonneByID
    public function selectPersonneByID ($personneId) {


        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM Personne WHERE Id=:id");
        
        $requete_prepare->execute(array("id"=>$personneId));

        $resultat=$requete_prepare->Fetch(PDO::FETCH_OBJ);

        return $resultat;
    }


// Fonction selectPersonnebyNomPrenomLike
    public function selectPersonneByNomPrenomLike($pattern) {
        
        $requete_prepare=$this->connexion->prepare (
            "SELECT * FROM Personne WHERE Nom LIKE :nom OR Prenom LIKE :prenom");
        
        $requete_prepare->execute(
            array("nom"=>"%$pattern%",
            "prenom"=>"%$pattern%")
        );
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);

        return $resultat;
    }

// FONCTION getPersonneHobby | Je me connecte à la BD
    public function getPersonneHobby($personneId) {
        
        // Je prépare ma requête SQL
        $requete_prepare = $this->connexion->prepare(
            "SELECT h.Type FROM Hobby h
            INNER JOIN RelationHobby rh ON rh.Hobby_ID = h.ID
            WHERE rh.Personne_ID = :id");

        // J'execute la requête en passant la valeur
        $requete_prepare->execute(
            array("id" => $personneId));

        // Je récupère le résultat de la requête
        $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

        // Je retourne/renvoie la liste de hobby
        return $hobbies;
        
    }

// FONCTION getPersonneMusique | Je me connecte à la BD
    public function getPersonneMusique($personneId) {
        
        // Je prépare ma requête SQL
        $requete_prepare = $this->connexion->prepare(
            "SELECT m.Type FROM Musique m
            INNER JOIN RelationMusique rm ON rm.Musique_ID = m.ID
            WHERE rm.Personne_ID = :id");

        // J'execute la requête en passant la valeur
        $requete_prepare->execute(
            array("id" => $personneId));

        // Je récupère le résultat de la requête
        $musiques = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

        // Je retourne/renvoie la liste de hobby
        return $musiques;
        
    }

// FONCTION getRelationPersonne
    public function getRelationPersonne($personneId) {
        
        $requete_prepare = $this->connexion->prepare(
            "SELECT rp.Type p.Nom FROM RelationPersonne rp
            INNER JOIN Personne p ON rp.Relation_ID = p.ID
            WHERE rp.Personne_ID = :id");
        
        $requete_prepare->execute(
            array("id" => $personneId));
        
        $relation = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

        return $relation;
    }

}

?>