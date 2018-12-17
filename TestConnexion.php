<?php

    include ('connexion.php');

    // J'appelle la connexion BD
    $appliBD = new Connexion();

    // $appliBD->getHobbies();

    // Condition
    if($appliBD->getConnexion() !== null){
        echo "Connexion BD réussie";
    }else{
        echo "Connexion BD échouée";
    }

    $appliBD->insertPersonne($_POST["lastname"], $_POST["firstname"], $_POST["photo_URL"], $_POST["anniversaire"], $_POST["status"]);

   // $appliBD->insertPersonneMusique(1,1);

/*
    $appelHobby = insertHobby("Voyage");

        if($appelHobby !== null){
            echo "Ajout Hobby Test OK";
        }else{
            echo "Ajout Hobby Echec";
    }
*/

/*
    $appelMusique = insertMusique("Blues");

        if($appelMusique !== null) {
            echo "Ajout Musique Test OK";
        }else{
            echo "Ajout Musique Echec";
    }
*/

/*
    $appelPersonne = insertPersonne("Dupont", "Charles", "photoCharles", "1945-07-10", "Veuf");

        if($appelPersonne !== null) {
            echo "Ajout Personne Test OK";
        }else{
            echo "Ajout Personne Echec";
    }
*/

   /*  $resultat = $appliBD->selectAllHobbies();
        echo "<ul>";
    foreach($resultat as $hobby) {
        echo "<li>".$hobby->Type."</li>";
    }
        echo "</ul>";

    $resultat = $appliBD->selectAllMusics();
        echo "<ul>";
    foreach($resultat as $style) {
        echo "<li>".$style->Type."</li>";
    }
        echo "</ul>"; */

    /*$personne = $appliBD->selectPersonneByID(1);
    echo $personne->Nom;

    $personnes = $appliBD->selectPersonneByNomPrenomLike("Do");

    echo $personnes[0]->Nom;*/
    // var_dump($personnes);


   /*  $getPersonneHobby = $appliBD->getPersonneHobby(2);
        echo "<ul>";
    foreach($getPersonneHobby as $hobby) {
        echo "<li>".$hobby->Type."</li>";
    }
        echo "</ul>";

    $getPersonneMusique = $appliBD->getPersonneMusique(4);
        echo "<ul>";
    foreach($getPersonneMusique as $style) {
        echo "<li>".$style->Type."</li>";
    }
        echo "</ul>";

    $getRelationPersonne = $appliBD->getRelationPersonne(1);
        echo "<ul>";
    foreach($getRelationPersonne as $relation) {
        echo "<li>".$relation->Type."</li>";
    }
        echo "</ul>"; */
 
?>