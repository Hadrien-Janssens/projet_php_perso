<?php
require_once __DIR__."/../models/contactModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

    $dataArrayClean = xssSecurity($_POST);
    $erreurs  = traitement($reglesContact,$dataArrayClean);
    if (isset($_POST) && empty($erreurs)) {
        envoyerMail($_POST['name'],$_POST['email'], $_POST['message']);
        $validationFormulaire = "formulaire a été envoyé";
    }
    else {
        $validationFormulaire = "Veuillez remplir correctement les champs !";
    }

}