<?php
require_once __DIR__."/../core/gestionFormulaire.php";

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