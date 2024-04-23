<?php
require_once __DIR__."/constantes/constantes.php";
if(session_status() !== PHP_SESSION_ACTIVE) {
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
session_set_cookie_params([
    'path' => '/',
    'secure' => false,
    'httponly' => false,
    'samesite' => 'lax'
]);
session_start();
}

function classSuivantLeChemin () {
    $pages = [
        BASE_URL.'index.php' => '<i class="fa-solid fa-house"></i>',
        BASE_URL.'contact.php' => '<i class="fa-solid fa-file-signature"></i>',
        BASE_URL.'profil.php'=> '<i class="fa-solid fa-user"></i>'
    ];
    foreach ($pages as $page => $label) {
        $class = ($_SERVER['REQUEST_URI'] ==  $page) ? 'active' : '';
        echo '<li class="p-2"><a href='.  $page .' class=' . $class . '>' . $label . '</a></li>';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$metaDescription?? ''?>">
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <link href="./src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?=$pageTitre?? ''?></title>
</head>

<body class="bg-slate-50">
    <nav class="flex justify-between bg-white text-blue-500">
        <a href="./index.php" class="p-2">Logo</a>
        <ul class="flex">
            <?php classSuivantLeChemin(); ?>
        </ul>
        <ul class="flex">
            <li class="p-2"><a href="./connexion.php ">connexion</a></li>
            <li class="p-2"><a href="./inscription.php ">inscription</a></li>
        </ul>
    </nav>