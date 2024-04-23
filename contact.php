<?php 
$metaDescription = "voici la super description de la page Contact";
$pageTitre = "contact";
require_once "./header.php";
require_once "./core/envoyerMail.php";
require_once __DIR__."/controllers/contactController.php";
?>

<div class="container">
    <h1 class=" text-xl text-center my-10">Contact</h1>
    <form action="" method="POST" class="flex flex-col max-w-96 m-auto">
        <input type="hidden" name="formName" value="formContact">
        <p class="text-right">* champs obligatoires</p>
        <input type="text" maxlength="255" name="name" id="name" aria-describedby="name-erreur" aria-invalid="true"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" placeholder="Nom"
            value=<?php if (isset($_POST['name']) && !empty($erreurs)) echo $_POST['name'] ; ?>>
        <div id="name-erreur" class="erreur">
            <?=   $erreurs['name'] ?? '' ?>
        </div>
        <input type="text" name='firstname' maxlength="255" minlength="2" id="firstname" placeholder="Prénom"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" aria-describedby="firstname-erreur"
            aria-invalid="true"
            value=<?php if (isset($_POST['firstname']) && !empty($erreurs)) echo $_POST['firstname'] ; ?>>
        <div id="firstname-erreur" class="erreur">
            <?=   $erreurs['firstname'] ?? '' ?>
        </div>
        <input type="email" name='email' id="email" placeholder="Mail" aria-describedby="email-erreur"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" aria-invalid="true"
            value=<?php if (isset($_POST['email']) && !empty($erreurs)) echo $_POST['email'] ; ?>>
        <div id="email-erreur" class="erreur">
            <?=   $erreurs['email'] ?? '' ?>
        </div>
        <textarea type='text' required maxlength="3000" minlength="10" name="message" cols="30" rows="5"
            class="p-1 bg-gray-100 rounded mb-2 shadow shadow-xs" placeholder="Message"
            aria-describedby="message-erreur" aria-invalid="true">
                <?php if (isset($_POST['message']) && !empty($erreurs)) echo $_POST['message'] ; ?>
            </textarea>
        <div id="message-erreur" class="erreur">
            <?=   $erreurs['message'] ?? '' ?>
        </div>
        <input type="submit" value="Envoyer"
            class="p-1 bg-blue-500 rounded mb-2 duration-300 text-white hover:cursor-pointer hover:bg-blue-600">
        <?= $validationFormulaire ?? "" ?>
    </form>
</div>