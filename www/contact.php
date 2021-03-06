<?php
  session_start();
  $_SESSION['uri'] = $_SERVER['REQUEST_URI'];
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
    <title>Contact - Stichting Zwembad De Marne</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheets/standard.css" media="(min-width: 800px)">
    <link rel="stylesheet" type="text/css" href="stylesheets/standardMobile.css" media="(max-width: 800px)">
    <link rel="icon" type="image/ico" href="images/favicon.png">
    <script src="includes/functions.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <?php include("includes/verbinding.php"); ?>
    <script src="includes/Vibrant.js"></script>
  </head>
  <body>
    <?php include_once("includes/analyticstracking.php") ?>
    <header>
      <img src="images/logo.png" alt="zwembad de marne" title="Zwembad De Marne" onload="this.style.opacity = 1;">
      <?php
        $query = "
          SELECT fotonaam
          FROM slide
          ORDER BY RAND()
        ";
        $response = mysql_query($query);
        while ($row = mysql_fetch_row($response)) {
            echo "<input type='hidden' value='images/slide/".$row[0]."'>";
        }
      ?>
    </header>
    <nav id="mobile">
      <?php
        if ($_SESSION['ingelogd']) {
            echo "
              <li><a onclick='menuEnable(this)'><i class='material-icons'>menu</i>Menu <i class='material-icons'>keyboard_arrow_down</i></a>
                <ul>
                  <li><a href='/'><i class='material-icons'>home</i>Home</a></li>
                  <li><a href='openingstijden'><i class='material-icons'>today</i>Openingstijden & tarieven</a></li>
                  <li><a href='activiteiten'><i class='material-icons'>list</i>Activiteiten</a></li>
                  <li><a href='nieuws'><i class='material-icons'>import_contacts</i>Nieuws</a></li>
                  <li><a href='over'><i class='material-icons'>info_outline</i>Over</a></li>
                  <li><a href='#' class='huidig'><i class='material-icons'>message</i>Contact</a></li>
                  <li><a onclick='menuEnable(this)'><i class='material-icons'>edit</i>Beheer <i class='material-icons'>keyboard_arrow_down</i></a>
                    <ul>
                      <li><a href='beheer/eventbeheer'>Activiteitenbeheer</a></li>
                      <li><a href='beheer/gebruikersbeheer'>Gebruikersbeheer</a></li>
                    </ul>
                  </li>
                  <li><a href='beheer/uitloggen' class='uitloggen'><i class='material-icons'>exit_to_app</i>Uitloggen</a></li>
                </ul>
              </li>
            ";
        } else {
            echo "
              <li><a onclick='menuEnable(this)'><i class='material-icons'>menu</i>Menu <i class='material-icons'>keyboard_arrow_down</i></a>
                <ul>
                  <li><a href='/'><i class='material-icons'>home</i>Home</a></li>
                  <li><a href='openingstijden'><i class='material-icons'>today</i>Openingstijden & tarieven</a></li>
                  <li><a href='activiteiten'><i class='material-icons'>list</i>Activiteiten</a></li>
                  <li><a href='nieuws'><i class='material-icons'>import_contacts</i>Nieuws</a></li>
                  <li><a href='over'><i class='material-icons'>info_outline</i>Over</a></li>
                  <li><a href='#' class='huidig'><i class='material-icons'>message</i>Contact</a></li>
                </ul>
              </li>
            ";
        }
      ?>
    </nav>
    <nav id="pc_tablet">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="openingstijden">Openingstijden & tarieven</a></li>
        <li><a href="activiteiten">Activiteiten</a></li>
        <li><a href="nieuws">Nieuws</a></li>
        <li><a href="over">Over</a></li>
        <li><a href="#" class="huidig">Contact</a></li>
        <?php
          if ($_SESSION['ingelogd']) {
              echo "
                  <li><a onclick='menuEnable()'>Beheer <i class='material-icons'>keyboard_arrow_down</i></a></li>
                  <li><a href='beheer/uitloggen' class='uitloggen'>Uitloggen</a></li>
                </ul>
                <ul>
                  <a class='material-icons' onclick='menuDisable()'>keyboard_arrow_up</a>
                  <li><a href='beheer/eventbeheer'>Activiteitenbeheer</a></li>
                  <li><a href='beheer/gebruikersbeheer'>Gebruikersbeheer</a></li>
              ";
          }
        ?>
      </ul>
    </nav>
    <section id="middle">
      <div id="inhoud">
        <h2>Contactgegevens Stichting zwembad De Marne en Omstreken</h2>
        <p>
          Telefoon: 0595-421178 <br>
          Adres: Breekweg 1, Leens <br>
          Postcode: 9965 TE <br>
          Emailadres: info@zwembaddemarne.nl <br>
        </p>
        <h3>Manager</h3>
        <p>
          Hilde de Boer <br>
          Telefoon: 0595-421178 <br>
          Emailadres: hildedeboer@zwembaddemarne.nl <br>
        </p>
        <h3>Secretariaat</h3>
        <p>
          Mieke Knol <br>
          Telefoon: 0595-572702 <br>
          Emailadres: miekeknol@zwembaddemarne.nl <br>
        </p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2380.9637212252433!2d6.371730716002664!3d53.36180418125411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c9b7da86298015%3A0x84945052aa9e076!2sZwembad+De+Marne+e.o.!5e0!3m2!1sen!2snl!4v1462180014629" allowfullscreen></iframe>
      </div>
      <div id="zijkant">
        <h2>Activiteiten</h2>
        <ul id="events"></ul>
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
