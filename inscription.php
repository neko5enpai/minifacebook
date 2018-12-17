<?php

require "connexion.php";

$appliBD = new Connexion();

$lastname = $_POST["lastname"];
$firstname = $_POST["firstname"];
$photoURL = $_POST["photo_URL"];
$anniversaire = $_POST["anniversaire"];
$status = $_POST["status"];


$appliBD->insertPersonne($lastname, $firstname, $photoURL, $anniversaire, $status);





?>