<?php
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
    <title>Activiteitenbeheer - Stichting Zwembad De Marne</title>

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
              <li><a href="#" class="huidig">Activiteitenbeheer</a></li>
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
        <li><a href="#" class="huidig">Activiteitenbeheer</a></li>
        <li><a href="gebruikersbeheer">Gebruikersbeheer</a></li>
      </ul>
    </nav>
    <section id="middle">
      <div id="inhoud">
        <h2>Activiteitenbeheer</h2>
        <h4>Nieuwe activiteit aanmaken</h4>
        <form class="eventform" action="eventaanmaken" method="post" onsubmit="return eventAanmaken()">
          <table>
            <tr>
              <td>Titel:</td>
              <td><textarea name="titel" rows=2 required></textarea></td>
            </tr>
            <tr>
              <td>Beschrijving:</td>
              <td><textarea name="beschrijving" rows=5 required></textarea></td>
            </tr>
            <tr>
              <td><input type="checkbox" class="material-icons" onchange="inputEnable(this)">* Starttijd:</td>
              <td><input type="time" name="starttijd" disabled></td>
            </tr>
            <tr>
              <td><input type="checkbox" class="material-icons" onchange="inputEnable(this)">* Eindtijd:</td>
              <td><input type="time" name="eindtijd" disabled></td>
            </tr>
            <tr>
              <td><input type="checkbox" class="material-icons" onchange="inputEnable(this)">* Startdatum:</td>
              <td><input type="date" name="startdatum" disabled></td>
            </tr>
            <tr>
              <td><input type="checkbox" class="material-icons" onchange="inputEnable(this)">* Einddatum:</td>
              <td><input type="date" name="einddatum" disabled></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" value="Opslaan" title="Een nieuwe activiteit aanmaken"></td>
            </tr>
          </table>
          <em>* Als er geen tijd/datum is voor een activiteit, dan gelieve geen enkele tijd/datum aankruisen.
            En als er geen eindtijd/-datum is, maar alleen &eacute;&eacute;n tijdstip/datum, dan gelieve alleen de starttijd/-datum aankruisen en invullen.</em>
          <hr>
        </form>
        <h4 style="margin-top: 60px;">Bestaande activiteit(en) beheren</h4>
        <?php
          $query = "
            SELECT *
            FROM events
            ORDER BY startdatum ASC
          ";
          $response = mysql_query($query) or die ('Fout in query');
          while ($row = mysql_fetch_row($response)) {
              echo "
                <form action='eventverwijderen' method='post'>
                  <input type='hidden' name='id' value='".$row[0]."'>
                </form>
                <form id='event".$row[0]."' class='eventform' action='eventaanpassen' method='post' onsubmit='return eventAanpassen()'>
                  <input type='hidden' name='id' value='".$row[0]."'>
                  <table>
                    <tr>
                      <td>Titel:</td>
                      <td><textarea name='titel' rows=2>".$row[1]."</textarea></td>
                      <td><a class='material-icons delete' onclick='eventVerwijderen(this)' title='Deze activiteit verwijderen'>delete</a></td>
                    </tr>
                    <tr>
                      <td>Beschrijving:</td>
                      <td><textarea name='beschrijving' rows=5>".$row[6]."</textarea></td>
                    </tr>
                    <tr>
                      <td><input type='checkbox' class='material-icons' onchange='inputEnable(this)'>* Starttijd:</td>
                      <td><input type='time' name='starttijd' value='".$row[2]."' disabled></td>
                    </tr>
                    <tr>
                      <td><input type='checkbox' class='material-icons' onchange='inputEnable(this)'>* Eindtijd:</td>
                      <td><input type='time' name='eindtijd' value='".$row[3]."' disabled></td>
                    </tr>
                    <tr>
                      <td><input type='checkbox' class='material-icons' onchange='inputEnable(this)'>* Startdatum:</td>
                      <td><input type='date' name='startdatum' value='".$row[4]."' disabled></td>
                    </tr>
                    <tr>
                      <td><input type='checkbox' class='material-icons' onchange='inputEnable(this)'>* Einddatum:</td>
                      <td><input type='date' name='einddatum' value='".$row[5]."' disabled></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><input type='submit' value='Opslaan' title='Deze activiteit verwijderen'></td>
                    </tr>
                  </table>
                  <em>* Als er geen tijd/datum is voor een activiteit, dan gelieve geen enkele tijd/datum aankruisen.
                    En als er geen eindtijd/-datum is, maar alleen &eacute;&eacute;n tijdstip/datum, dan gelieve alleen de starttijd/-datum aankruisen en invullen.</em>
                  <hr>
                </form>
              ";
              if ($row[2] != "00:00:00") {
                  echo "<script>inputEnable(document.querySelectorAll('#event".$row[0]." input[type=checkbox]')[0])</script>";
              }
              if ($row[3] != "00:00:00") {
                  echo "<script>inputEnable(document.querySelectorAll('#event".$row[0]." input[type=checkbox]')[1])</script>";
              }
              if ($row[4] != "0000-00-00") {
                  echo "<script>inputEnable(document.querySelectorAll('#event".$row[0]." input[type=checkbox]')[2])</script>";
              }
              if ($row[5] != "0000-00-00") {
                  echo "<script>inputEnable(document.querySelectorAll('#event".$row[0]." input[type=checkbox]')[3])</script>";
              }
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
