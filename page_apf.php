<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apf</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        body {
            margin: 0;
            background-color: #FFF5EE;
        }

        h1 {
            text-align: center
        }

        .section {
            width: 600px;
        }

        table {
            width: 600px;
        }

        .section1 {
            display: flex;
            justify-content: center;
        }

        .section2 {
            display: flex;
            justify-content: center;
        }

        .section3 {
            display: flex;
            justify-content: center;
        }

        .part2 h2 {
            text-align: center;
        }

        #chart1 {
            max-height: 400px;
            max-width: 600px;
        }

        #chart2 {
            max-height: 400px;
            max-width: 600px;
        }
    </style>
</head>

<body>

    <?php include "header.php"; ?>

    <h1>Analyse des programmes de financement</h1>

    <hr>

    <div class="section1">
        <section class="section">
            <h2>F2</h2>
        </section>

        <section class="section">
            <h2>R9</h2>
        </section>
    </div>

    <hr>

    <div class="part2">
        <h2>Evolution du montant total des subventions</h2>

        <div class="section2">
            <section class="section">
                <br>
                <?php

                //Se conecter
                include_once("utils.php");
                $connexion = Utils::connect();
                if ($connexion) {
                    //faire la requette sql
                    $sql = "SELECT F.anneeF, SUM(F.montantF) AS montantTotal
                            FROM Financer F
                            GROUP BY F.anneeF;";

                    //interoger la bbd
                    $result = Utils::query($connexion, $sql);

                    Utils::disconnect($connexion);
                }
                ?>

                <table border="1">
                    <tr>
                        <th>Année</th>
                        <th>Montant total</th>
                    </tr>

                    <?php

                    $secteurs = array();
                    $investissements = array();

                    foreach ($result as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['anneeF'] . ' </td>';
                        echo '<td>' . $row['montantTotal'] . ' </td>';
                        echo '</tr>';

                        $annees[] = $row['anneeF'];
                        $mTotals[] = $row['montantTotal'];
                    }
                    ?>
                </table>
            </section>

            <canvas id="chart1"></canvas>

            <script>
                var annees = <?php echo json_encode($annees); ?>;
                var mTotals = <?php echo json_encode($mTotals); ?>;


                let ctx = document.getElementById("chart1").getContext('2d');
                let data = {
                    labels: annees,
                    datasets: [{
                        label: 'Subvention',
                        data: mTotals,
                        backgroundColor: 'rgba(0,123,255,0.5)'
                    }]
                };

                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {}
                });
            </script>
        </div>
    </div>


    <hr>

    <div class="section3">
        <section class="section">
            <h2>Information sur les types d'actions</h2>

            <?php
            //Se conecter
            include_once("utils.php");
            $connexion = Utils::connect();
            if ($connexion) {
                //faire la requette sql
                $sql1 = "SELECT categorie
                        FROM TypeAction
                        WHERE idTA NOT IN(
                            SELECT idTA
                            FROM Eligible);";

                //nb de TypeAction
                $sql2 = "SELECT COUNT(*) AS nbTA FROM TypeAction;";
                //nb de TypeAction  sans programme de financement
                $sql3 = "SELECT (SELECT COUNT(*) FROM TypeAction) - COUNT(DISTINCT idTA) AS TypeAsansF
                        FROM Eligible;";

                //interoger la bbd
                $result1 = Utils::query($connexion, $sql1);
                $result2 = Utils::query($connexion, $sql2);
                $result3 = Utils::query($connexion, $sql3);

                Utils::disconnect($connexion);
            }
            ?>

            <p>Sur <?php echo $result2[0][0] ?> types d'actions, <?php echo $result3[0][0] ?> ne sont pas éligible a un programme de financement.</p>

            <h4>Type d'action sans programme de financement :</h4>

            <?php
            foreach ($result1 as $row) {
                echo '-' . $row['categorie'] . '<br>';
            }
            ?>



        </section>

        <section class="section">
            <h2>Information sur les action financé</h2>

            <?php
            //Se conecter
            include_once("utils.php");
            $connexion = Utils::connect();
            if ($connexion) {
                //faire la requette sql
                $sql1 = "SELECT (SELECT COUNT(DISTINCT idA) FROM Financer) * 100.0 / COUNT(idA) AS prActionsFinancees
                        FROM Action;";

                //nb action
                $sql2 = "SELECT COUNT(*) AS nbActions FROM Action;";
                //nb action financé
                $sql3 = "SELECT COUNT(DISTINCT idA) AS nbActionF FROM Financer;";

                //interoger la bbd
                $result1 = Utils::query($connexion, $sql1);
                $result2 = Utils::query($connexion, $sql2);
                $result3 = Utils::query($connexion, $sql3);

                Utils::disconnect($connexion);
            }
            ?>

            <p>Il y a <?php echo $result3[0][0]; ?> action financé sur <?php echo $result2[0][0]; ?> soit <?php echo $result1[0][0]; ?> % d'action financé</p>

            <canvas id="chart2"></canvas>

            <script>
                var actionF = <?php echo json_encode($result3[0][0]); ?>;
                var actionNotF = <?php echo json_encode($result2[0][0] - $result3[0][0]); ?>;


                let ctx2 = document.getElementById("chart2").getContext('2d');
                let data2 = {
                    labels: ['Action financée', 'Action non financé'],
                    datasets: [{
                        label: 'nb action',
                        data: [actionF, actionNotF],
                        backgroundColor: ['rgb(1, 157, 27)', 'rgb(255, 99, 132)']
                    }]
                };

                let myChart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: data2,
                });
            </script>
        </section>
    </div>

    <br><br><br><br><br>

</body>

</html>