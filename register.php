<?php
    include('header.php');
?>
<form action="process_register.php" method="post">
    <input type="text" name="imie" id="imie" placeholder="Imię">
    <input type="text" name="nazwisko" id="nazwisko" placeholder="Nazwisko">
    <input type="email" name="email" id="email" placeholder="E-mail">
    <input type="password" name="haslo1" id="haslo1" placeholder="Hasło">
    <input type="password" name="haslo2" id="haslo2" placeholder="Powtórz Hasło">
    <input type="submit" value="Zarejestruj się">
</form>
<?php
    include('footer.php');
?>