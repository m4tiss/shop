<?php
include_once('settings.php');
include('navbar.php');
?>

    <div class="loginOrRegistrationContainer">
        <div class="registrationDiv">
            <h2 class="inputTitle">REJESTRACJA</h2>
            <form id="registrationForm" class="registrationForm">
                <h3 class="inputInfo">Imię</h3><input class="input" type="text" name="name"><br>
                <h3 class="inputInfo">Nazwisko</h3><input class="input" type="text" name="surname"><br>
                <h3 class="inputInfo">Email</h3><input class="input" type="email" name="email"><br>
                <h3 class="inputInfo">Hasło</h3> <input class="input" type="password" name="password"><br>
                <input class="loginButton" type="submit" value="Zarejestruj">
                <a href="login.php">
                    <label id="toLogin" class="changeLoginWindow">Mam już konto</label>
                </a>
            </form>
        </div>
    </div>
<?php include('footer.php'); ?>