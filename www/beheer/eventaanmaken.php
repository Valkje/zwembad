<?php
  if (empty($_POST)) {
      header('Location: eventbeheer');
  }

  session_start();
  $_SESSION['uri'] = $_SERVER['REQUEST_URI'];;

  if (!$_SESSION['ingelogd']) {
      header('Location: inloggen');
  }
?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="theme-color">
    <meta name="msapplication-navbutton-color">
    <meta name="apple-mobile-web-app-status-bar-style">
    <meta name="description" content="Website van zwembad De Marne">
    <meta name="keywords" content="De Marne, Leens, zwembad">
    <title>Activiteit aanmaken - Stichting Zwembad De Marne</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/standard.css" media="(min-width: 800px)">
    <link rel="stylesheet" type="text/css" href="../stylesheets/standardMobile.css" media="(max-width: 800px)">
    <link rel="icon" type="image/ico" href="../images/favicon.png">
    <script src="../includes/functions.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <?php include("../includes/verbinding.php"); ?>
    <script src="../includes/Vibrant.js"></script>
  </head>
  <body class="beheer">
    <?php include_once("../includes/analyticstracking.php") ?>
    <header>
      <img src="../images/logo.png" alt="zwembad de marne" title="Zwembad De Marne" onload="this.style.opacity = 1;">
      <?php
        $query = "
          SELECT fotonaam
          FROM slide
          ORDER BY RAND()
        ";
        $response = mysql_query($query);
        while ($row = mysql_fetch_row($response)) {
            echo "<input type='hidden' value='../images/slide/".$row[0]."'>";
        }
      ?>
    </header>
    <nav id="mobile">
      <li><a onclick="menuEnable(this)"><i class='material-icons'>menu</i>Menu <i class="material-icons">keyboard_arrow_down</i></a>
        <ul>
          <li><a href="/"><i class='material-icons'>home</i>Home</a></li>
          <li><a href="/openingstijden"><i class='material-icons'>today</i>Openingstijden & tarieven</a></li>
          <li><a href="/activiteiten"><i class='material-icons'>list</i>Activiteiten</a></li>
          <li><a href="/over"><i class='material-icons'>info_outline</i>Over</a></li>
          <li><a href="/contact"><i class='material-icons'>message</i>Contact</a></li>
          <li><a onclick="menuEnable(this)"><i class='material-icons'>edit</i>Beheer <i class="material-icons">keyboard_arrow_down</i></a>
            <ul>
              <li><a href="eventbeheer">Activiteitenbeheer</a></li>
              <li><a href="gebruikersbeheer">Gebruikersbeheer</a></li>
            </ul>
          </li>
          <li><a href="uitloggen" class="uitloggen"><i class='material-icons'>exit_to_app</i>Uitloggen</a></li>
        </ul>
      </li>
    </nav>
    <nav id="pc_tablet">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/openingstijden">Openingstijden & tarieven</a></li>
        <li><a href="/activiteiten">Activiteiten</a></li>
        <li><a href="/over">Over</a></li>
        <li><a href="/contact">Contact</a></li>
        <li><a onclick="menuEnable()">Beheer <i class="material-icons">keyboard_arrow_down</i></a></li>
        <li><a href="uitloggen" class="uitloggen">Uitloggen</a></li>
      </ul>
      <ul>
        <a class="material-icons" onclick="menuDisable()">keyboard_arrow_up</a>
        <li><a href="eventbeheer">Activiteitenbeheer</a></li>
        <li><a href="gebruikersbeheer">Gebruikersbeheer</a></li>
      </ul>
    </nav>
    <section id="middle">
      <div id="inhoud">
        <h2>Activiteit aanmaken</h2>
        <?php
          $titel = $_POST['titel'];
          $beschrijving = $_POST['beschrijving'];
          $starttijd = empty($_POST['starttijd']) ? "00:00:00" : $_POST['starttijd'];
          $eindtijd = empty($_POST['eindtijd']) ? "00:00:00" : $_POST['eindtijd'];
          $startdatum = empty($_POST['startdatum']) ? "0000-00-00" : $_POST['startdatum'];
          $einddatum = empty($_POST['einddatum']) ? "0000-00-00" : $_POST['einddatum'];

          $query = "
            INSERT INTO events(titel, beschrijving, starttijd, eindtijd, startdatum, einddatum)
            VALUES ('$titel', '$beschrijving', '$starttijd', '$eindtijd', '$startdatum', '$einddatum')
          ";
          if (!mysql_query($query)) {
              echo "Het is niet gelukt om de activiteit aan te maken. Klik <a onclick='history.back()'>hier</a> om terug te gaan naar de vorige pagina.";
          } else {
              echo "
                Het aanmaken van de activiteit is gelukt! U wordt binnen enkele seconden teruggestuurd naar de beheerpagina.
                <meta http-equiv='refresh' content='5; URL=eventbeheer' />
              ";
          }
        ?>
      </div>
    </section>
    <footer>
      <a>
        <i class="material-icons">phone</i>
        0595-421178
      </a>
      <a href="mailto:info@zwembaddemarne.nl">
        <i class="material-icons">email</i>
        info@zwembaddemarne.nl
      </a>
      <a href="https://www.facebook.com/zwembaddemarne" target="_blank">
        <i class="fa fa-facebook-official"></i>
        /zwembaddemarne
      </a>
      <?php
        $jaar = date('Y');
        echo "<p>Copyright $jaar &copy; Stichting Zwembad De Marne e.o.</p>";
      ?>
    </footer>
  </body>
</html>
