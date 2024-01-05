<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
        }

        header {
            display: flex;
            background-color: green;
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

    <header>
        <div class="logo">
            <img class="game-icons-ecology" src="img/game-icons-ecology.png" />
        </div>

        <div class="header_link">
            <a class="text-wrapper-12" href="index.html">Accueil</a>
            <a class="text-wrapper-12" href="seie.php">SEIE</a>
            <a class="text-wrapper-12" href="aree.php">AREE</a>
            <a class="text-wrapper-12" href="apf.php">APF</a>
        </div>
    </header>

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

    <div class="section2">
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
            <h2>jsp</h2>
        </section>
    </div>

</body>

</html>