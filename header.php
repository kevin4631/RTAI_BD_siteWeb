<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>head</title>
    <style>
        header {
            height: 100px;
            padding-left: 100px;
            display: flex;
            justify-content: space-between;
            background-color: rgb(1, 157, 27);
            align-items: center;
        }

        .logo {
            height: 90px;
            display: flex;
        }

        .head_link {
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 30px;
            padding-right: 50px;
            border: 3px solid;
            border-color: #e8e8e8;
            background-color: #569edf;
            border-radius: 49px 0px 0px 49px;
        }

        .text_link {
            margin-left: 40px;
            margin-right: 40px;
            font-weight: bold;
            text-decoration: none;
            color: blanchedalmond;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="img/game-icons-ecology.png" />
            <h1>OBERE</h1>
        </div>

        <div class="head_link">
            <a class="text_link" href="index.php">Accueil</a>
            <a class="text_link" href="page_seie.php">SEIE</a>
            <a class="text_link" href="page_aree.php">AREE</a>
            <a class="text_link" href="page_apf.php">APF</a>
        </div>
    </header>
</body>

</html>
