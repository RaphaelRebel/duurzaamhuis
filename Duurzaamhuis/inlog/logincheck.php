<HEAD>
<?php 
session_start();
?>
<link rel="stylesheet" href="../style/logincheck.css"></link>
</HEAD>
<BODY>   
    <div id="container" >
        
<?php
    $gebruikersnaam = $_POST['user'];
    $wachtwoord = $_POST['pass'];

    $host = "127.0.0.1";
    $user = "c2779amber";
    $pass = "phuxprPtXBFVJ9@";
    $db = "c2779flex";

    $mysqli = new mysqli($host,$user,$pass,$db);
    if ($mysqli -> connect_errno)
    {
        echo "fout met connectie db:" . $mysqli -> connect_error;
        exit();
    }

    $sql = "SELECT * FROM users WHERE username ='$gebruikersnaam'";
    $result = $mysqli -> query($sql);
    if ($result -> num_rows == 0)
    {
        echo "gebruiker niet bekend . $gebruikersnaam";
        exit();
    } 

   $gebruiker = $result -> fetch_assoc();
   $wachtwoord_juist = password_verify($wachtwoord, $gebruiker['password']);
    $result  -> free_result();
    $mysqli -> close();

    
    
    if($wachtwoord_juist == TRUE)
    {
       echo "Je bent ingelogd<hr>";
       $_SESSION['username'] = $gebruikersnaam;
       echo "<a href ='../main.php'>Klik hier</a> om naar de volgende beveiligde site te gaan";       
    }
    else
    {
        echo "Inloggen is mislukt. <br><a id='button' href ='../index.html'>Klik hier</a> om terug te gaan.";
        
    }
?>
</div>


</BODY>
</HTML>