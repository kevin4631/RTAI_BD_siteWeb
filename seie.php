<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

  <Style>
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

    h2 {
      text-align: center
    }

    h3 {
      text-align: center
    }

    table {
      width: 600px;
    }

    .section1 {
      display: flex;
      justify-content: center;
    }

    #chart1 {
      max-height: 400px;
      max-width: 600px;
    }

    .section2 {
      display: flex;
      justify-content: center;
    }
  </Style>
</head>

<body>

  <header>
    <div class="logo">
      <img class="game-icons-ecology" src="img/game-icons-ecology.png" />
    </div>

    <div class="header_link">
      <a class="text-wrapper-12" href="index.html">Accueil</a>
      <a class="text-wrapper-12" href="aree.php">AREE</a>
      <a class="text-wrapper-12" href="apf.php">APF</a>
    </div>
  </header>

  <h1>Sensibilisation des entreprises aux initiatives écologiques</h1>

  <hr>

  <div class="part1">
    <h2>Information sur les entreprises d'un secteur</h2>

    <section id="formulaire">
      <?php
      //Se conecter
      include_once("utils.php");
      $connexion = Utils::connect();
      if ($connexion) {
        //faire la requette sql
        $sql = "SELECT DISTINCT E.secteur
          FROM Entreprise E
          ORDER BY E.secteur ASC;";

        //interoger la bbd
        $result = Utils::query($connexion, $sql);

        Utils::disconnect($connexion);
      }
      ?>

      <form method="post">
        Choisir un secteur:
        <select name="list">
          <option value="">--choose an option--</option>
          <?php
          foreach ($result as $row) {
            echo '<option value="' . $row['secteur'] . '">' . $row['secteur'] . '</option>';
          }
          ?>
        </select>
        <input type="submit" value="Soumettre">
      </form>
      <br>

      <?php
      // Traitement de la sélection
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["list"])) {
        // Récupérer la valeur sélectionnée dans la liste déroulante
        $choix = $_POST["list"];
      }
      ?>
      <h3>Secteur : <?php echo $choix ?><h3>
    </section>

    <div class="section1">
      <section id="action_entreprise">
        <?php
        //Se conecter
        include_once("utils.php");
        $connexion = Utils::connect();
        if ($connexion) {
          //faire la requette sql
          $sql = "SELECT E.nomE, A.nomA, A.anneeA, A.nbLike
              FROM Entreprise E, Action A
              WHERE E.nomE = A.nomE
              AND E.secteur = '$choix'
              ORDER BY E.nomE ASC, A.anneeA ASC;";

          //interoger la bbd
          $result = Utils::query($connexion, $sql);

          Utils::disconnect($connexion);
        }
        ?>

        <table border="1">
          <caption>
            <th colspan="4">Entreprise et leur actions</th>
          </caption>
          <tr>
            <th>Entreprise</th>
            <th>Action</th>
            <th>Année</th>
            <th>nb Like</th>
          </tr>
          <?php
          foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['nomE'] . ' </td>';
            echo '<td>' . $row['nomA'] . ' </td>';
            echo '<td>' . $row['anneeA'] . ' </td>';
            echo '<td>' . $row['nbLike'] . ' </td>';
            echo '</tr>';
          }
          ?>
        </table>
        <br>
      </section>

      <section id="evolution_entrepise">
        <?php
        //Se conecter
        include_once("utils.php");
        $connexion = Utils::connect();
        if ($connexion) {
          //faire la requette sql
          $sql = "SELECT EE.nomE, EE.anneeEE, EE.chiffreAffaire, EE.montantTotalInvestisement, EE.nbRecrutement, EE.quantiteCarbone
              FROM EvolutionEntreprise EE, Entreprise E
              WHERE EE.nomE = E.nomE
              AND E.secteur = '$choix'
              ORDER BY EE.nomE ASC;";

          //interoger la bbd
          $result = Utils::query($connexion, $sql);

          Utils::disconnect($connexion);
        }
        ?>

        <table border="1">
          <caption>
            <th colspan="6">Evolution Entreprise</th>
          </caption>
          <tr>
            <th>Entreprise</th>
            <th>Année</th>
            <th>CA</th>
            <th>Montant investi</th>
            <th>recrutements</th>
            <th>Quantite CO2</th>
          </tr>
          <?php
          foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['nomE'] . ' </td>';
            echo '<td>' . $row['anneeEE'] . ' </td>';
            echo '<td>' . $row['chiffreAffaire'] . ' </td>';
            echo '<td>' . $row['montantTotalInvestisement'] . ' </td>';
            echo '<td>' . $row['nbRecrutement'] . ' </td>';
            echo '<td>' . $row['quantiteCarbone'] . ' </td>';
            echo '</tr>';
          }
          ?>
        </table>
      </section>
    </div>
  </div>

  <hr>

  <div class="part2">
    <h2>Information sur les subventions</h2>

    <div class="section2">
      <section id="subvention_secteur">
        <br><br><br>

        <form method="post">
          nombre minimun de subvention :
          <input type="number" name="minSubvention" value="1">
          <input type="submit" value="Soumettre">
        </form>

        <?php
        $choixMinSubvention = 1;
        // Traitement de la sélection
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["minSubvention"])) {
          // Récupérer la valeur sélectionnée dans la liste déroulante
          $choixMinSubvention = $_POST["minSubvention"];
        }
        ?>
        <p>minimun : <?php echo $choixMinSubvention ?><p>

          <?php

          //Se conecter
          include_once("utils.php");
          $connexion = Utils::connect();
          if ($connexion) {
            //faire la requette sql
            $sql = "SELECT E.secteur, COUNT(A.idA) nbAction, SUM(F.montantF) montantTotal
              FROM Financer F, Action A, Entreprise E
              WHERE F.idA = A.idA
              AND A.nomE = E.nomE
              GROUP BY E.secteur
              HAVING COUNT(A.idA) >= $choixMinSubvention
              ORDER BY montantTotal DESC;";

            //interoger la bbd
            $result = Utils::query($connexion, $sql);

            Utils::disconnect($connexion);
          }
          ?>

        <table border="1">
          <caption>
            <th colspan="3">Info subvention</th>
          </caption>
          <tr>
            <th>Secteur</th>
            <th>Nb d'action</th>
            <th>Total investi</th>
          </tr>

          <?php

          $secteurs = array();
          $investissements = array();

          foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['secteur'] . ' </td>';
            echo '<td>' . $row['nbAction'] . ' </td>';
            echo '<td>' . $row['montantTotal'] . ' </td>';
            echo '</tr>';

            $secteurs[] = $row['secteur'] . " " . $row['nbAction'] . " actions";
            $investissements[] = $row['montantTotal'];
          }
          ?>
        </table>
        <br>


      </section>

      <canvas id="chart1"></canvas>

      <script>
        var secteurs = <?php echo json_encode($secteurs); ?>;
        var investissements = <?php echo json_encode($investissements); ?>;


        let ctx = document.getElementById("chart1").getContext('2d');
        let data = {
          labels: secteurs,
          datasets: [{
            label: 'Investisement',
            data: investissements,
            backgroundColor: 'rgba(0,123,255,0.5)'
          }]
        };

        let myChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {

          }
        });
      </script>

    </div>
  </div>

  <hr>

  <section id="r3"></section>

  <section id="r4"></section>

</body>

</html>