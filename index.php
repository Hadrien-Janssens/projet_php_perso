<?php
require_once __DIR__."/core/router.php";

$routes = [
    obtenir_route('GET','/','accueilController','index'),
    obtenir_route('GET','/connection','connectionController','index'),
    obtenir_route('POST','/connection','connectionController','connection'),
    obtenir_route('GET','/profil','profilController','index')
];

demarrer_routeur($routes);
?>