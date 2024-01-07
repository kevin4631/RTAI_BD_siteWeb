<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aree</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        body {
            margin: 0;
            background-color: #FFF5EE;
        }

        input {
            width: 70px;
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
    </style>
</head>

<body>

    <?php include "header.php"; ?>

    <h1>Analyse de la réputation et de l'évolution des entreprises</h1>

    <hr>

    <div class="section1">
        <section class="section">
            <h2>Entreprises et leur likes</h2>
        </section>

        <section class="section">
            <h2>Plus de précision sur les certification :</h2>
            <?php
            //Se conecter
            include_once("utils.php");
            $connexion = Utils::connect();
            if ($connexion) {
                //L'entreprise qui a obtenu le plus grand nombre d'actions certifiées
                $sql1 = "SELECT nomE, COUNT(idA) AS nbActionL
                    FROM(
                        SELECT A.nomE, L.idA
                        FROM Action A, Labeliser L
                        WHERE A.IdA = L.IdA
                        GROUP BY L.idA) AS tab
                    GROUP BY nomE
                    HAVING COUNT(idA) = (
                        SELECT MAX(nbAL)
                        FROM(
                            SELECT COUNT(idA) AS nbAL
                            FROM(
                                SELECT A.nomE, L.idA
                                FROM Action A, Labeliser L
                                WHERE A.IdA = L.IdA
                                GROUP BY L.idA) AS tab
                            GROUP BY nomE ) AS tab);";

                //entreprise qui a obtenu l'action la plus certifié
                $sql2 = "SELECT A.nomE, A.nomA, COUNT(L.idA) AS nbL
                    FROM Action A, Labeliser L
                    WHERE A.IdA = L.IdA
                    GROUP BY L.idA
                    HAVING COUNT(L.idA) = (
                        SELECT MAX(nbL)
                        FROM(
                            SELECT COUNT(L.idA) AS nbL	
                            FROM Labeliser L
                            GROUP BY L.idA) AS tab);";

                //entreprise qui a obtenu le plus grand nombre de certification
                $sql3 = "SELECT A.nomE, COUNT(L.idA) AS certification
                    FROM Action A, Labeliser L
                    WHERE A.IdA = L.IdA
                    GROUP BY A.nomE
                    HAVING COUNT(L.idA) = (
                        SELECT MAX(maxL)
                        FROM(
                            SELECT COUNT(L.idA) AS maxL
                            FROM Action A, Labeliser L
                            WHERE A.IdA = L.IdA
                        GROUP BY A.nomE) AS tab);";


                //interoger la bbd
                $result1 = Utils::query($connexion, $sql1);
                $result2 = Utils::query($connexion, $sql2);
                $result3 = Utils::query($connexion, $sql3);

                Utils::disconnect($connexion);
            }
            ?>

            <h4>Entreprise qui a obtenu le plus grand nombre d'actions certifiées :</h4>
            <?php
            foreach ($result1 as $row) {
                echo '- ' . $row['nomE'] . ' avec ' . $row['nbActionL'] . ' actions certifiées <br>';
            }
            ?>

            <h4>Entreprise qui a obtenu l'action la plus certifié :</h4>
            <?php
            foreach ($result2 as $row) {
                echo '- ' . $row['nomE'] . ' avec l\'action ' . $row['nomA'] . ' certifiée ' . $row['nbL'] . ' fois <br>';
            }
            ?>

            <h4>Entreprise qui a obtenu le plus grand nombre de certification :</h4>
            <?php
            foreach ($result3 as $row) {
                echo '- ' . $row['nomE'] . ' avec ' . $row['certification'] . ' certifications <br>';
            }
            ?>
        </section>
    </div>

    <hr>

    <div class="section2">
        <section class="section">
            <h2>Entreprises qui aide et qui certifie</h2>
        </section>

        <section class="section">
            <h2>Situation ecologique</h2>

            <form action="page_aree.php" method="post">
                evolution entre
                <input type="number" name="choix_annee1" value="2022">
                et
                <input type="number" name="choix_annee2" value="2023">

                <input type="submit" value="ok">
            </form>

            <?php
            $anne1 = 2022;
            $anne2 = 2023;
            // Traitement de la sélection
            if (isset($_POST["choix_annee1"]) && isset($_POST["choix_annee2"])) {
                // Récupérer la valeur sélectionnée dans la liste déroulante
                $anne1 = $_POST["choix_annee1"];
                $anne2 = $_POST["choix_annee2"];
            }
            ?>

            <?php
            //Se conecter
            include_once("utils.php");
            $connexion = Utils::connect();
            if ($connexion) {
                //Les entreprises dont la situation écologique s'est améliorée entre deux années données
                $sql = "SELECT Ev1.nomE, Ev1.quantiteCarbone AS q1, Ev2.quantiteCarbone AS q2
                        FROM EvolutionEntreprise Ev1, EvolutionEntreprise Ev2
                        WHERE Ev1.anneeEE = $anne1
                        AND Ev2.anneeEE = $anne2
                        AND Ev1.nomE = Ev2.nomE
                        AND Ev1.quantiteCarbone > Ev2.quantiteCarbone;";

                //interoger la bbd
                $result = Utils::query($connexion, $sql);

                Utils::disconnect($connexion);
            }
            ?>

            <table border="1">
                <caption>
                    <th colspan="4">Amelioration écologique Entreprise</th>
                </caption>
                <tr>
                    <th>Entreprise</th>
                    <th>Carbone <?php echo $anne1; ?></th>
                    <th>Carbone <?php echo $anne2; ?></th>
                    <th>Difference</th>
                </tr>

                <?php

                foreach ($result as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['nomE'] . ' </td>';
                    echo '<td>' . $row['q1'] . ' </td>';
                    echo '<td>' . $row['q2'] . ' </td>';
                    $diff = 100 - (100 * $row['q2'] / $row['q1']);
                    echo '<td>-' . $diff . '%</td>';
                    echo '</tr>';
                }
                ?>
            </table>

        </section>
    </div>

    <hr>

</body>

</html>