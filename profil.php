<?php
$metaDescription = "profil";
$pageTitre = "profil";
require_once __DIR__."/header.php";
require_once __DIR__."/controllers/profilController.php";
?>
<div class="p-5 ">
    <h1 class=" text-xl mb-3 ">Profil</h1>
    <div class="bg-slate-200 p-2 rounded max-w-96 ">
        <p>nom : <?= $utilisateur['UsePseudo']??'...'?> </p>
        <p>email : <?=$utilisateur['UseEmail'] ?? '...'?></p>
    </div>


    <form action="" method="POST" class="max-w-96 flex justify-end">
        <input type="submit" value='Déconnecter'
            class="rounded bg-red-400 text-white px-2 py-1 mt-3 hover:cursor-pointer ">

    </form>
</div>

<?php require_once __DIR__."/footer.php";