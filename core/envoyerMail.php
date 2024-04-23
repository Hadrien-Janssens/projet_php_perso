<?php

function envoyerMail($nom, $email, $message, $destinataire) {
$sujet = "Prise de contact";
// Configuration simple de l'entête.
$entete = [
    "From" =>  "$nom <$email>",
    "MIME-Version" => "1.0",
    "Content-Type" => "text/html; charset=\"UTF-8\"",
    "Content-Transfer-Encoding" => "quoted-printable"
];
// Tentative d'envoi du mail :
if (mail($destinataire, $sujet, $message, $entete)){
    echo "Un code a été envoyé à : $destinataire 📬";
}
else{
    echo "L'envoi du courriel a échoué.";
}

}
function simulationMail ($code) {
    $boiteMail = fopen(dirname(__DIR__).'/boitemail/code.json', 'a+');
    fwrite($boiteMail, $code . PHP_EOL);
    return true;
}