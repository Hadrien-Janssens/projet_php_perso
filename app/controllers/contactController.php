<?php
require_once dirname(__DIR__)."/models/contactModel.php";
require_once dirname(__DIR__,2)."/core/gestionVue.php";

function contact() {

    $reglesContact = [
        "name" => [
          "require" => true,
          "max" => 255,
          "min" => 2
        ],
        "firstname" => [
          "require" => false,
          "max" => 255,
          "min" => 2
        ],
        "email" => [
            "require" => true,
            "max" => 255,
            "min" => 2
        ],
        "message" => [
            "require" => true,
            "max" => 3000,
            "min" => 2
          ]
        ];
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

//tentative mvc

function obtenir_pageInfos(): array
{
    return [
        'vue' => 'contact',
        'titre' => "Page de contact",
        'description' => "Description de la page de contact..."
    ];
}

function index () {
  afficher_vue(obtenir_pageInfos(),'index');
}