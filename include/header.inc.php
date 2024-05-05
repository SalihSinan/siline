<!DOCTYPE html>
<html lang="<?php echo isset($lang_selected) ? $lang_selected : 'fr'; ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    // Vérifier si le paramètre style est défini dans l'URL
    if (isset($_GET['style'])) {
        // Récupérer la valeur du paramètre style
        $style = $_GET['style'];

        // Vérifier la valeur du paramètre style
        if ($style === 'alternatif') {
            // Utiliser la feuille de style alternative pour le mode nuit
            echo '<link rel="stylesheet" type="text/css" href="style_nuit.css" />';
            // Définir le cookie avec la valeur 'alternatif'
            setcookie('theme', 'alternatif', time() + (86400 * 30), '/'); // Cookie valable pendant 30 jours dans le répertoire racine
        } else {
            // Utiliser la feuille de style par défaut
            echo '<link rel="stylesheet" type="text/css" href="style.css" />';
            // Définir le cookie avec la valeur par défaut (supprimer le cookie)
            setcookie('theme', '', time() - 3600, '/'); // Supprimer le cookie en le rendant expiré
        }
    } else {
        // Vérifier si un cookie existe déjà pour le thème
        if (isset($_COOKIE['theme'])) {
            // Récupérer la valeur du cookie
            $style = $_COOKIE['theme'];
            // Vérifier si la valeur du cookie est 'alternatif'
            if ($style === 'alternatif') {
                // Utiliser la feuille de style alternative pour le mode nuit
                echo '<link rel="stylesheet" type="text/css" href="style_nuit.css" />';
                // Ajouter /?style=alternatif à la fin de l'URL
                echo '<script>window.location.href += "/?style=alternatif";</script>';
            } else {
                // Utiliser la feuille de style par défaut
                echo '<link rel="stylesheet" type="text/css" href="style.css" />';
            }
        } else {
            // Utiliser la feuille de style par défaut si le cookie n'existe pas
            echo '<link rel="stylesheet" type="text/css" href="style.css" />';
        }
    }
    ?>
    <link rel="icon" href="images/site.png" />

    <title>
        <?= $title ?>
    </title>
</head>

<body>

    <header>

        <nav>
            <a href="index.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <img src="images/acceuil.png" alt="Image accueil" width="60" />
            </a>

            <form method="get">
                <input type="hidden" name="style"
                    value="<?php echo isset($_GET['style']) && $_GET['style'] === 'alternatif' ? '' : 'alternatif'; ?>" />
                <button type="submit" aria-label="Mode nuit"
                    class="slider-button <?php echo isset($_GET['style']) && $_GET['style'] === 'alternatif' ? 'night-mode' : 'day-mode'; ?>">
                    <span class="slider-button-inner"> </span>
                </button>
            </form>

            <ol>
                <li><a
                        href="itineraire.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">Itineraire</a>
                </li>
                <li><a href="depart.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">Prochain
                        Depart</a>
                </li>
                <li><a
                        href="statistiques.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">Statistiques</a>
                </li>
                <li><a href="profil.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">A
                        Propos</a>
                </li>
                <li><a href="avis.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">Avis</a>
                </li>
            </ol>
        </nav>

    </header>
    <main>