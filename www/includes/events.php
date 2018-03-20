<?php
  include("verbinding.php");

  $query = "
    SELECT COUNT(*)
    FROM events
  ";
  $response = mysql_query($query) or die ('Fout in query');
  $row = mysql_fetch_row($response);
  $total = $row[0];

  $n = 0;
  $limitOffset = $_GET['limitOffset'];
  $uri = $_SERVER['REQUEST_URI'];
  $query = "
    SELECT *, EXTRACT(DAY FROM startdatum),
      EXTRACT(MONTH FROM startdatum),
      EXTRACT(YEAR FROM startdatum),
      EXTRACT(DAY FROM einddatum),
      EXTRACT(MONTH FROM einddatum),
      EXTRACT(YEAR FROM einddatum),
      EXTRACT(HOUR FROM starttijd),
      EXTRACT(MINUTE FROM starttijd),
      EXTRACT(HOUR FROM eindtijd),
      EXTRACT(MINUTE FROM eindtijd)
    FROM events
    ORDER BY startdatum ASC
    LIMIT 6 OFFSET $limitOffset
  ";
  $response = mysql_query($query) or die ('Fout in query');
  $count = mysql_num_rows($response);
  if ($count) {
      while ($row = mysql_fetch_row($response)) {
          $maanden = array(1=>"Januari", 2=>"Februari", 3=>"Maart", 4=>"April", 5=>"Mei", 6=>"Juni", 7=>"Juli", 8=>"Augustus", 9=>"September", 10=>"Oktober", 11=>"November", 12=>"December");
          $startdatum = $row[7]." ".$maanden[$row[8]]." ".$row[9];
          $einddatum = $row[10]." ".$maanden[$row[11]]." ".$row[12];
          $datum = ($row[4] != $row[5] and $row[5] != "0000-00-00") ? $startdatum." t/m ".$einddatum : $startdatum;

          $starttijd = ($row[13] < 10 ? "0".$row[13] : "".$row[13]).":".($row[14] < 10 ? "0".$row[14] : "".$row[14]);
          $eindtijd = ($row[15] < 10 ? "0".$row[15] : "".$row[15]).":".($row[16] < 10 ? "0".$row[16] : "".$row[16]);
          $tijd = ($row[2] != $row[3] and $row[3] != "00:00:00") ? "van ".$starttijd." tot ".$eindtijd : "om ".$starttijd;

          $titel = str_replace("\n", "<br>", $row[1]);
          $beschrijving = str_replace("\n", "<br>", $row[6]);

          echo "
            <li id=$n>
              <a class='event' href='".($uri != "/activiteiten" ? "activiteiten" : "")."#$n'>
                <span>".($row[4] != "0000-00-00" ? $datum: "")." ".($row[2] != "00:00:00" ? $tijd: "")."</span>
                <p>$titel</p>
              </a>
              <a class='meer' onclick='activiteitMeer(this.nextElementSibling)'>Meer</a>
              <div>$beschrijving</div>
              <hr>
            </li>
          ";
          $n++;
      }
      if ($count == 6 && ($total - $limitOffset) > 6) echo "<button>Meer activiteiten...</button>";
  } else {
      echo "
        <p>
          Er staan tot nog toe geen nieuwe activiteiten voor ".date("Y")." gepland. Misschien komen er later meer.
        </p>
      ";
  }
?>
