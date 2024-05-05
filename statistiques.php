<?php
// En-tête de la page
$lang_selected = "fr";
$title = "Statistiques des Recherches de Gares";
require_once ("include/header.inc.php");
?>

<h1>Statistiques des Recherches de Gares</h1>

<section>
    <h2>Explorez les Tendances de Voyage : Découvrez les 10 Gares les Plus Recherchées!</h2>
    <p>
        Découvrez dès à présent les données les plus actuelles sur les dix gares les plus recherchées sur notre page de
        Départ. Grâce à nos graphiques interactifs, plongez au cœur des tendances de voyage et visualisez clairement où
        se concentrent les flux les plus importants de voyageurs. Que vous planifiiez un voyage ou que vous souhaitiez
        simplement rester informé sur les destinations les plus prisées, notre outil vous permettra de savoir en un clin
        d'œil où se trouve le pouls du monde. Ne laissez plus aucune place au doute et soyez toujours un pas en avance,
        en sachant exactement où se trouve l'activité la plus intense.</p>
</section>

<section>
    <h2>Explorez le Graphique en Temps Réel</h2>
    <!-- Div pour afficher le graphique -->
    <div id="chart_div"></div>
</section>

<!-- Inclusion de la bibliothèque Google Charts -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    // Chargement de la bibliothèque Google Charts
    google.charts.load('current', { packages: ['corechart', 'bar'] });

    // Fonction pour dessiner le graphique
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Gare', 'Nombre de Recherches'],
            <?php
            // Fonction pour charger les données à partir du fichier CSV
            function loadCSVData()
            {
                $file = 'include/searches.csv';
                $data = array();

                if (($handle = fopen($file, "r")) !== FALSE) {
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        // Convertir chaque nom de gare en minuscules avant de les stocker
                        $data[] = strtolower($row[0]);
                    }
                    fclose($handle);
                }

                return $data;
            }

            // Récupération des recherches de gares à partir du fichier CSV
            $searches = loadCSVData();

            // Création d'un tableau associatif pour stocker le nombre de recherches par gare
            $gares_count = array_count_values($searches);

            // Tri du tableau par ordre décroissant de nombre de recherches
            arsort($gares_count);

            // Limite le nombre de gares affichées dans le graphique
            $max_gares = 10;

            // Tableau pour garder une trace des villes déjà ajoutées
            $added_cities = array();

            $count = 0;
            foreach ($gares_count as $gare => $count) {
                // Vérifier si la ville a déjà été ajoutée
                if (!isset($added_cities[$gare])) {
                    echo "['" . $gare . "', " . $count . "],";

                    // Marquer la ville comme ajoutée
                    $added_cities[$gare] = true;
                }

                if (++$count >= $max_gares) {
                    break;
                }
            }
            ?>
        ]);

        // Options du graphique
        var options = {
            title: 'Recherches de Gares',
            chartArea: { width: '50%' },
            hAxis: {
                title: 'Nombre de Recherches',
                minValue: 0,
                textStyle: { color: 'white' }
            },
            vAxis: {
                title: 'Gare',
                textStyle: { color: 'white' }
            },
            backgroundColor: 'transparent',
            legend: { textStyle: { color: 'white' } },
            titleTextStyle: { color: 'white' }
        };

        // Création d'une instance du graphique
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        // Dessiner le graphique avec les données et les options spécifiées
        chart.draw(data, options);
    }

    // Appel de la fonction pour dessiner le graphique une fois que la bibliothèque Google Charts est chargée
    google.charts.setOnLoadCallback(drawChart);
</script>

<?php
// Inclusion du pied de page
include 'include/footer.inc.php';
?>