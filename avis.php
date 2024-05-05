<?php
$lang_selected = "fr";
$title = "Avis";
require_once ("include/header.inc.php");
require_once ("include/functions.inc.php");
?>

<h1>Qu'est-ce que les utilisateurs pensent de nous ?</h1>

<section>
    <h2>Ne passez pas à côté, dites-nous votre avis !</h2>
    <!-- Formulaire de contact -->
    <form action="avis.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>" method="post">
        <label for="email">Votre e-mail:</label>
        <input type="email" id="email" name="email" required="" />
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" style="width: 70%;" required=""></textarea>
        <input type="submit" style="background: linear-gradient(to right, #0044CC, #DB4437);" value="Envoyer" />
    </form>

    <?php
    // Traitement de l'envoi du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $expediteur = $_POST['email'];
        $message = $_POST['message'];

        // Envoi de l'email
        if (envoyer_email($expediteur, $message)) {
            echo "<p>Votre message a été envoyé avec succès.</p>";
        } else {
            echo "<p>Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer.</p>";
        }

        // Enregistrement de l'avis dans le fichier avis.txt
        if (enregistrer_avis($expediteur, $message)) {
            echo "<p>Votre avis a été enregistré avec succès.</p>";
        } else {
            echo "<p>Une erreur s'est produite lors de l'enregistrement de l'avis.</p>";
        }
    }
    ?>
</section>

<section>
    <?php
    // Récupération et affichage des 5 derniers avis
    $derniers_avis = recuperer_derniers_avis();

    if ($derniers_avis) {
        echo "<h2>Derniers avis</h2>";
        echo "<ul>";
        foreach ($derniers_avis as $un_avis) {
            echo "<li>$un_avis</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucun avis disponible pour le moment.</p>";
    }
    ?>
</section>

<?php include ("include/footer.inc.php"); ?>