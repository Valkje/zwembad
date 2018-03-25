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
    <title>Openingstijden & tarieven - Stichting Zwembad De Marne</title>

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
                  <li><a href='#' class='huidig'><i class='material-icons'>today</i>Openingstijden & tarieven</a></li>
                  <li><a href='activiteiten'><i class='material-icons'>list</i>Activiteiten</a></li>
                  <li><a href='nieuws'><i class='material-icons'>import_contacts</i>Nieuws</a></li>
                  <li><a href='over'><i class='material-icons'>info_outline</i>Over</a></li>
                  <li><a href='contact'><i class='material-icons'>message</i>Contact</a></li>
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
                  <li><a href='#' class='huidig'><i class='material-icons'>today</i>Openingstijden & tarieven</a></li>
                  <li><a href='activiteiten'><i class='material-icons'>list</i>Activiteiten</a></li>
                  <li><a href='nieuws'><i class='material-icons'>import_contacts</i>Nieuws</a></li>
                  <li><a href='over'><i class='material-icons'>info_outline</i>Over</a></li>
                  <li><a href='contact'><i class='material-icons'>message</i>Contact</a></li>
                </ul>
              </li>
            ";
        }
      ?>
    </nav>
    <nav id="pc_tablet">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="#" class="huidig">Openingstijden & tarieven</a></li>
        <li><a href="activiteiten">Activiteiten</a></li>
        <li><a href="nieuws">Nieuws</a></li>
        <li><a href="over">Over</a></li>
        <li><a href="contact">Contact</a></li>
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
        <h2>Voorverkoop zwemabonnementen <?php echo date('Y'); ?></h2>
        <p>
          De zomer nadert, en dat vergt natuurlijk een goede voorbereiding.
          E&eacute;n van die voorbereidingen betreft natuurlijk het aanschaffen
          van een zwemabonnement! De voorverkoop van abonnementen/leskaarten
          is in het gemeentehuis van Leens op:
        </p>
        <ul>
          <li><b>woensdag 28 maart, van 14:00 tot 20:00;</b></li>
          <li><b>donderdag 29 maart, van 14:00 tot 17:00.</b></li>
        </ul>
        <p>
          Formulieren kunt u <a href="documents/bestelformulier2018.doc">hier</a>
          vinden of afhalen bij de receptie van het gemeentehuis. (Tarieven kunt
          u <a href="documents/tarieven2018.doc">hier</a> vinden.) Het formulier
          kunt u tijdens de voorverkoop onder gelijktijdige betaling inleveren.
          Betaling is mogelijk per kas of via PIN-betaling.
        </p>
        <h2>Watergewenning</h2>
        <p><b><i>Dit onderdeel gaat onder voorbehoud door.</i></b></p>
        <p>
          Is uw kind 3 of 4 jaar, en wilt u hem of haar laten wennen aan
          het water als voorbereiding op zwemles? Dan hebt u geluk!
          Zwembad De Marne biedt namelijk <b>watergewenning</b> aan.
          Door middel van spelletjes en oefeningen leert uw kind het water kennen
          en daarin te bewegen, waardoor het leren zwemmen wordt vergemakkelijkt.
        </p>
        <div style="display: none;">
          <table>
            <th>Dag</th>
            <th>Tijd</th>
            <th>Kosten</th>
            <tr>
              <td>Vrijdag</td>
              <td>16:00 - 16:30</td>
              <td>&euro; 35,00</td>
            </tr>
          </table>
        </div>
        <p>
          Voor vragen kunt u terecht bij H. de Boer of
          <a href="mailto:info@zwembaddemarne.nl">info@zwembaddemarne.nl</a>.
          Opgave kan bij de kassa van het zwembad.
        </p>
        <h2>Openingstijden</h2>
        <p>
          Op zaterdag 28 april, om 11:00, gaat het zwembad weer open.
          Zaterdag 8 september is het seizoen helaas weer afgelopen.
        </p>
        <table>
          <th>Dagen</th>
          <th>Tijden</th>
          <tr>
            <td>Maandag t/m vrijdag</td>
            <td>7:30-9:30 en 13:30-20:00</td>
          </tr>
          <tr>
            <td>Maandag t/m vrijdag <br> (Zomervakantie regio Noord)</td>
            <td>7:30-20:00</td>
          </tr>
          <tr>
            <td>Zaterdag en zondag</td>
            <td>11:00-17:00</td>
          </tr>
        </table>
        <h3>Tarieven <?php echo date('Y'); ?></h3>
        <table>
          <th></th>
          <th>Voorverkoop</th>
          <th>Seizoen</th>
          <tr>
            <td>Dagkaartje volwassenen</td>
            <td></td>
            <td>&euro; 5,00</td>
          </tr>
          <tr>
            <td>Dagkaartje kind (t/m 3 jaar gratis)</td>
            <td></td>
            <td>&euro; 4,00</td>
          </tr>
          <tr>
            <td>Avondkaartje (na 18:00)</td>
            <td></td>
            <td>&euro; 2,50</td>
          </tr>
          <tr>
            <td>Tienbadenkaart (niet persoonsgebonden)</td>
            <td></td>
            <td>&euro; 42,50</td>
          </tr>
          <tr>
            <td>Aquagym (bij abonnement; 10 lessen)</td>
            <td></td>
            <td>&euro; 40,00</td>
          </tr>
          <tr>
            <td>Aquagym (zonder abonnement; 10 lessen)</td>
            <td></td>
            <td>&euro; 50,00</td>
          </tr>
          <tr>
            <td colspan="3"><b>Persoonlijk abonnement (pasfoto verplicht)</b></td>
          </tr>
          <tr>
            <td><b>a)</b> Tot 18 jaar</td>
            <td>&euro; 42,00</td>
            <td>&euro; 47,00</td>
          </tr>
          <tr>
            <td><b>b)</b> Vanaf 18 jaar</td>
            <td>&euro; 62,50</td>
            <td>&euro; 67,50</td>
          </tr>
          <tr>
            <td colspan="3"><b>Gezinsabonnement alleen in voorverkoop (pasfoto verplicht)</b></td>
          </tr>
          <tr>
            <td><b>c)</b> Hoofdkaart (eerste gezinslid)</td>
            <td>&euro; 97,50</td>
            <td></td>
          </tr>
          <tr>
            <td><b>d)</b> Bijkaart (overige gezinsleden)</td>
            <td>&euro; 22,50</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3"><b>Leskaart (alleen aan te schaffen in combinatie met abonnement)</b></td>
          </tr>
          <tr>
            <td colspan="3"><b>e)</b> Vanaf dit seizoen starten we met een <b>totaalpakket</b>. Diploma A, B en C voor &eacute;&eacute;n bedrag. Geldig voor het seizoen 2018, 2019 en 2020. Het tarief voor 2018 is <b>&euro; 200,-</b>. Heeft uw kind inmiddels een A- en/of B-diploma in ons bad gehaald? Vraag dan naar de voorwaarden om het B- en/of C-diploma te halen.</td>
          </tr>
          <tr>
            <td><b>f)</b> Leskaart afzonderlijk voor A, B of C <br>(1 seizoen)</td>
            <td>&euro; 75,00</td>
            <td></td>
          </tr><tr>
            <td><b>g)</b> Geheel seizoen 18 jaar en ouder <br>(op aanvraag)</td>
            <td>&euro; 90,00</td>
            <td></td>
          </tr>
        </table>
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
