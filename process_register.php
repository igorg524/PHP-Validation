
<?php
include('header.php');

$imie=htmlspecialchars($_POST['imie']);
$nazwisko=htmlspecialchars($_POST['nazwisko']);
$email=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$haslo1=$_POST['haslo1'];
$haslo2=$_POST['haslo2'];
$blad_danych=false;

    //walidacja
    function sprawdz_imie($imie){
        $sprawdz='/^[A-ZŁŚĆŹŻĄĘÓŃ][ąęółśżźćńa-z]{2,}+$/';
        if(preg_match($sprawdz,$imie))
            return true;
        else
            return false;
    }
    function sprawdz_nazwisko($nazwisko){
        $sprawdz='/^[A-ZŁŚĆŹŻĄĘÓŃ][ąęółśżźćńa-z]{2,}+$/';
        if(preg_match($sprawdz,$nazwisko))
            return true;
        else
            return false;
    }
    function sprawdz_haslo1($haslo1){
        $sprawdz='/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/';
        if(preg_match($sprawdz,$haslo1))
            return true;
        else
            return false;
    }
    function sprawdz_haslo2($haslo1,$haslo2){
        if($haslo1==$haslo2)
            return true;
        else
            return false;
    }

    //komunikaty
    if(!sprawdz_imie($imie)){
        echo "<p style='color:red;'>Błędnie wpisano imię.</p>";
        $blad_danych=true;
    }
    if(!sprawdz_nazwisko($nazwisko)){
        echo "<p style='color:red;'>Błędnie wpisano nazwisko.</p>";
        $blad_danych=true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<p style='color:red;'>Nieprawidłowy adres e-mail.</p>";
        $blad_danych=true;
    }
    if(!sprawdz_haslo1($haslo1)){
        echo "<p style='color:red;'>Hasło musi składać się z co najmniej 8 znaków w tym jednej wielkiej litery oraz cyfry.</p>";
        $blad_danych=true;
    }
    if(!sprawdz_haslo2($haslo1,$haslo2)){
        echo "<p style='color:red;'>Hasła się nie zgadzają.</p>";
        $blad_danych=true;
    }
    if(!$blad_danych){
        echo "<p style='color:#ffffff;'>Rejestracja zakończona sukcesem! Potwierdzenie rejestracji zostało wysłane na podany adres e-mail <b>".$email."</b></p>";
        echo "<a href='index.php'><button>Powrót do strony głównej</button></a>";
        include('footer.php');
    }
    if($blad_danych){
        echo "<a href='register.php'><button>Powrót do formularza</button></a>";
        include('footer.php');
        exit;
    }        
    //zapisanie danych
    $haslo=password_hash($haslo1, PASSWORD_DEFAULT);
    $dane="$imie|$nazwisko|$email|$haslo\n";
    $plik=fopen('users.txt','a');

    fwrite($plik, $dane);
    fclose($plik);

    //wysylanie email
    $do=$email;
    $tytul="Potwierdzenie rejestracji";
    $wiadomosc="Cześć $imie $nazwisko,\n\nDziękujemy za rejestracje na naczym portalu!";
    $od="From: no-reply@igorgibas.pl";

    mail($do, $tytul, $wiadomosc, $od);
?>