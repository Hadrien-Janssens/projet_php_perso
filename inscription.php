<?php
$metaDescription = "ici vous trouverez la page d'inscription de mon site";
$pageTitre = "inscription";
require_once "./header.php";
require_once "./controllers/inscriptionController.php";
?>
<div class="container">
    <h1 class="text-xl text-center my-10">Inscription</h1>
    <form action="" method="POST" class="flex flex-col max-w-96 m-auto">
        <input type="hidden" name="formName" value="formInscription">
        <input type="text" id="pseudo" name="pseudo" required minlength="2" maxlength="255" placeholder="Pseudo"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs"
            value=<?php if (isset($_POST['pseudo']) && !empty($erreurs)) echo $_POST['pseudo'] ; ?>>
        <div id="name-erreur" class="erreur">
            <?=   $erreurs['pseudo'] ?? '' ?>
        </div>
        <input id="email" name="email" placeholder="email" class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs"
            value=<?php if (isset($_POST['email']) && !empty($erreurs)) echo $_POST['email'] ; ?>>
        <div id="name-erreur" class="erreur">
            <?=   $erreurs['email'] ?? '' ?>
        </div>
        <input type="password" id="password" name="password" required minlength="8" maxlength="72"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" placeholder="Mot de passe"
            value=<?php if (isset($_POST['password']) && !empty($erreurs)) echo $_POST['password'] ; ?>>
        <div id="name-erreur" class="erreur">
            <?=   $erreurs['password'] ?? '' ?>
        </div>
        <input type="password" id="confirmation" name="confirmation" placeholder="Confirmation" minlength="8"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" maxlength="72"
            value=<?php if (isset($_POST['confirmation']) && !empty($erreurs)) echo $_POST['confirmation'] ; ?>>
        <div id="name-erreur" class="erreur">
            <?=   $erreurs['confirmation'] ?? '' ?>
        </div>
        <input type="submit" value="s'inscrire" class="p-1 bg-blue-500 rounded mb-2  text-white hover:cursor-pointer">
    </form>
</div>