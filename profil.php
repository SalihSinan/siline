<?php
$lang_selected = "fr";
$title = "A propos";
require_once ("include/header.inc.php");
?>

<h1>Qui suis-je, et qu'elle est l'objectif du site?</h1>

<div style="display: flex;">
    <div style="flex-direction: column">
        <section>
            <h2>Découvrez mes Réalisations en Développement Web !</h2>
            <p>
                Bienvenue sur mon site ! Ici, vous pouvez explorer le projet final que j'ai du faire lors de mon cursus
                universitaire, à la fin de la seconde année de la licence informatique de cergy. Plongez dans mes
                projets de développement web, où j'ai utilisé des langages tels que PHP, HTML et XML pour créer des
                solutions innovantes.

                Pourquoi explorer ce site ?
                Démonstration de Compétences: Découvrez mes compétences en développement web à travers ce projets
                concrets et fonctionnels.

                Inspiration pour Vous: Que vous soyez étudiant en informatique ou passionné de développement web, mes
                réalisations peuvent vous inspirer dans vos propres travaux.
            </p>
            <img alt="code" src="images/code.png" width="100" />
        </section>

        <section>
            <h2>Pourquoi ce site</h2>
            <div class="image-text-container">
                <div class="image-container">
                    <img src="images/rechauffement.png" alt="Rechauffement Climatique" />
                </div>
                <div class="text-container">
                    <p>
                        Ce site a été créé dans le but de sensibiliser les jeunes à l'importance de l'utilisation des
                        transports en commun dans le contexte de l'urgence climatique croissante. En tant qu'étudiant en
                        informatique, je suis conscient de l'impact environnemental des modes de transport individuels,
                        comme les voitures personnelles, sur notre planète. Le développement climatique devient de plus
                        en plus un problème crucial, et il est essentiel de promouvoir des alternatives durables pour
                        réduire les émissions de carbone.

                        À travers ce site, j'ai cherché à fournir une plateforme intuitive et accessible pour aider les
                        jeunes à planifier leurs déplacements en utilisant les transports en commun. En offrant des
                        itinéraires faciles à trouver et des informations sur les horaires de départ, je vise à rendre
                        l'utilisation des transports en commun plus attrayante et pratique pour les jeunes générations.
                        En les encourageant à opter pour des modes de transport collectifs, nous pouvons tous contribuer
                        à réduire notre empreinte carbone et à préserver notre environnement pour les générations
                        futures.
                    </p>
                </div>
            </div>
        </section>

        <section>
            <h2>Qui je suis?</h2>
            <img alt="codeur" src="images/codeur.png" width="100" />
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Information Personelle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nom</td>
                        <td>YUKSEL</td>
                    </tr>
                    <tr>
                        <td>Prénom</td>
                        <td>Sinan</td>
                    </tr>
                    <tr>
                        <td>Université</td>
                        <td>CY PARIS UNIVERSITE</td>
                    </tr>
                    <tr>
                        <td>Filière</td>
                        <td>L2-Informatique</td>
                    </tr>
                    <tr>
                        <td>Groupe</td>
                        <td>TD D</td>
                    </tr>
                    <tr>
                        <td>Choix</td>
                        <td class="choix">Bienvenue sur le site conçu et imaginé par moi-même, [Votre Nom], passionné
                            par le monde numérique depuis mon plus jeune âge. Mon parcours dans le développement
                            informatique a été marqué par une fascination pour la logique et la créativité, des éléments
                            essentiels pour résoudre les défis de notre quotidien à travers la programmation.

                            En explorant la diversité des langages et des formats d'applications, j'ai trouvé une source
                            infinie d'inspiration. Que ce soit la création de sites web dynamiques ou d'applications
                            mobiles intuitives, chaque projet m'a permis de mettre en œuvre ma créativité et mes
                            compétences techniques. Pour moi, le développement va au-delà d'une simple expertise
                            technique : c'est un moyen d'expression puissant qui permet de concrétiser mes idées et de
                            toucher un large public de manière efficace.

                            En dehors de mes activités académiques, j'ai été impliqué dans divers projets de
                            développement, explorant de nouveaux langages et techniques pour enrichir mes compétences.
                            Cette passion pour la technologie ne se limite pas à l'éducation formelle : elle se traduit
                            par un engagement constant dans des projets innovants et stimulants.

                            En résumé, en tant qu'étudiant en L2 informatique et concepteur-designer de ce site, j'ai
                            choisi de me spécialiser dans le développement en raison de ma fascination pour la puissance
                            créative du code. Mon travail reflète ma passion débordante et mon désir incessant
                            d'apprendre et de contribuer à l'évolution rapide du monde numérique.

                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>
<?php include ("include/footer.inc.php"); ?>