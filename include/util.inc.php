<?php
// Fonction pour récupérer le navigateur php info(TD7)
function get_navigateur()
{
    // Vérifie la variable $_SERVER['HTTP_USER_AGENT']
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        // Récupère le navigateur de l'utilisateur
        $navigateur = $_SERVER['HTTP_USER_AGENT'];
        return $navigateur;
    } else {
        return "Navigateur non détecté";
    }
}
?>