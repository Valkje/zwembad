<?php
  session_start();

  include("../includes/verbinding.php");
  if (!empty($_POST)) {
      $gn = $_POST['gn'];
      $ww = $_POST['ww'];
      $query = "
        SELECT *
        FROM users
        WHERE username = '$gn' AND password = '$ww'
      ";
      $response = mysql_query($query) or die ('fout in query');
      $count = mysql_num_rows($response);
      $row = mysql_fetch_row($response);
      if (!$count) {
          echo "
            <script>
              alert('Gebruikers en/of wachtwoord niet goed ingevoerd. Probeer het opnieuw.');
            </script>
          ";
          $_POST['gn'] = "";
          $_POST['ww'] = "";
      } else {
          $_SESSION['ingelogd'] = true;
          $uri = $_SESSION['uri'];
          if (empty($uri)) {
              header('Location: /');
          } else {
              header('Location: '.$uri);
          }
      }
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
    <title>Inloggen - Stichting Zwembad De Marne</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../stylesheets/standard.css" media="(min-width: 800px)">
    <link rel="stylesheet" type="text/css" href="../stylesheets/standardMobile.css" media="(max-width: 800px)">
    <link rel="icon" type="image/ico" href="../images/favicon.png">
    <script src="../includes/functions.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <script src="../includes/Vibrant.js"></script>
  </head>
  <body class="beheer inloggen">
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
      <li><a onclick='menuEnable(this)'><i class='material-icons'>menu</i>Menu <i class='material-icons'>keyboard_arrow_down</i></a>
        <ul>
          <li><a href="/"><i class='material-icons'>home</i>Home</a></li>
          <li><a href="/openingstijden"><i class='material-icons'>today</i>Openingstijden & tarieven</a></li>
          <li><a href="/activiteiten"><i class='material-icons'>list</i>Activiteiten</a></li>
          <li><a href="/over"><i class='material-icons'>info_outline</i>Over</a></li>
          <li><a href="/contact"><i class='material-icons'>message</i>Contact</a></li>
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
      </ul>
    </nav>
    <section id="middle">
      <div id="inhoud">
        <h2>Inloggen</h2>
        <form action="inloggen" method="post">
          <input type="text" name="gn" placeholder="Gebruikersnaam" autofocus required><br>
          <input type="password" name="ww" placeholder="Wachtwoord" required><br>
          <input type="submit" value="Inloggen">
        </form>
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
