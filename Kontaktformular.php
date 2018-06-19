<?php
  
   // SESSION auf dieser Seite öffnen - solange das auf der gleichen Seite stattfindet, könnte man auch eine einfache Variable nehmen.
   @session_start();
   $timenow=time();
  
   if (isset($_POST['action']) && ($_POST['action']=='send')) {
     
      if (($timenow-$_POST['zeit'])<=10) {        // 10, 20, .... - sind die Sekunden für eine einfache Spam-Kontrolle
        
         /* SPAM ANGRIFF - nichts wird gesendet und es wird auf diese Formular-Seite zurückgekehrt, falls keine 10 Sekunden gewartet */
        
      } else {
        
         // SESSION-Variable zur Anzeige, wenn das Formular gesendet wurde
         $_SESSION['AnzeigeAufSeite']="JA";
        
         $admin = 'Webmaster@DeineDoamin.de';
         $useremail = $_POST['E-Mail'];
        
         // diese Zeile unten mit Deiner Message beschreiben, die in der Betreff-Zeile der Mail erscheinen soll.
         $Msg = "Mail von meiner Formular-Seite";
        
         // diese Zeile unten mit Der Message für die Kopie an User beschreiben, die in der Betreff-Zeile der Mail erscheinen soll
         $UserMsg = "Guten Tag, dies ist eine Kopie Deiner Nachricht an Tommy";
        
         // Inhalt der Mail als Variable “UserData”, der Punkt verbindet die Zeilen zu einer Variable, die als Inhalt der Mail gesendet wird.
         $UserData  = "Name: " . $_POST["Name"] . "\r\n";
         $UserData .= "Ort: " . $_POST["Ort"] . "\r\n";
         $UserData .= "e-Mail: " . $_POST["E-Mail"] . "\r\n";
         $UserData .= "Nachricht: " . $_POST["Nachricht"] . "\r\n\r\n";
         $UserData .= "Vielen Dank für diese Nachricht, ich werde nicht antworten";
        
         // Mail an Absender senden, wenn dieser das angehakt hatte (bei "From:" noch Deine korrekte Mail-Adresse als Absender eintragen)
         if (isset($_POST['UserSend']) && ($_POST['UserSend']=='on'))
         {
            mail($useremail, $UserMsg, $UserData, "From:Webmaster@DeineDomain.de");
         }
        
         // Mail an Webmaster senden
         mail($admin, $Msg, $UserData, "From:$useremail");
        
         // hier wird auf die Seite weitergeleitet, auf der dieses Formular eingebaut ist - bei mir also auf die gleiche Seite “index.php”
         @header("location: ./index.php");
         exit;
        
      }
     
   }
  
?>