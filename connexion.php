<?php
$metaDescription = "ici vous trouverez la page de connexion de mon site";
$pageTitre = "connexion";
require_once "./header.php";
require_once __DIR__."/core/gestionAuthentification.php";
require_once __DIR__."/controllers/connectionController.php";
?>


<div class="container">
    <h1 class="text-xl text-center my-10">Connexion</h1>
    <form class="flex flex-col max-w-96 m-auto" action="" method="POST">
        <input type="hidden" name="formName" value="formConnection">
        <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required minlength="2" maxlength="255"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs">
        <input type="password" id="password" name="password" required minlength="8" maxlength="72"
            placeholder="Mot de passe" class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs">
        <input type="submit" value="se connecter" class="p-1 bg-blue-500 rounded mb-2  text-white hover:cursor-pointer">
    </form>

</div>