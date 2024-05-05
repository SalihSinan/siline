<?php include_once ("util.inc.php"); ?>

</main>
<footer>
    <div class="footer-div">2024 Yuksel Sinan L2-ID CY-SUP</div>
    <div class="footer-div">Navigateur actuelle de l'internaute :
        <?php echo get_navigateur(); ?>
    </div>
    <div class="footer-div">Nombre de visites :
        <?php
        /**
         * @brief Incrémente le compteur de hits et renvoie sa nouvelle valeur.
         *
         * Cette fonction vérifie si le fichier de compteur de hits existe. Si le fichier n'existe pas,
         * elle le crée avec une valeur initiale de 0. Ensuite, elle lit la valeur actuelle du compteur depuis
         * le fichier, l'incrémente, sauvegarde la nouvelle valeur dans le fichier, et enfin, retourne la nouvelle valeur du compteur.
         *
         * @return int La nouvelle valeur du compteur de hits.
         *
         * @exception Exception Si la lecture ou l'écriture du fichier de compteur de hits échoue.
         */
        function incrementHitsCounter()
        {
            // Chemin vers le fichier de compteur de hits
            $fichierCompteur = 'compteur_hits.txt';

            try {
                // Vérifier si le fichier existe, sinon le créer avec la valeur initiale à 0
                if (!file_exists($fichierCompteur)) {
                    file_put_contents($fichierCompteur, '0');
                }

                // Lire la valeur actuelle du compteur depuis le fichier
                $compteur = file_get_contents($fichierCompteur);

                // Incrémenter le compteur
                $compteur++;

                // Sauvegarder la nouvelle valeur du compteur dans le fichier
                file_put_contents($fichierCompteur, $compteur);

                // Retourner la valeur du compteur pour affichage
                return $compteur;
            } catch (Exception $e) {
                // Lancer une exception si la lecture ou l'écriture du fichier de compteur de hits échoue
                throw new Exception("Erreur lors de la manipulation du fichier de compteur de hits : " . $e->getMessage());
            }
        }
        ?>
        <?php echo incrementHitsCounter(); ?>
    </div>
    <div><a href="tech.php<?php echo isset ($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>"
            style="text-decoration: none; color: white; border-bottom: 1px solid white; margin-bottom: 20px;">Tech</a>
    </div>
    <div>
        <a href="plan_du_site.php<?php echo isset ($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>"
            style="text-decoration: none; color: white; border-bottom: 1px solid white; margin-bottom: 20px;">Plan du
            site</a>
    </div>
    <a href="https://mycy.cyu.fr/" target="_blank">
        <img src="images/cyu.png" alt="Logo CYU" width="100" />
    </a>
</footer>

</body>

</html>