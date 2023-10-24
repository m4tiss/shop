<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
    <div class="loginContainer">
        <div class="registrationDiv">
            <h2 class="inputTitle">REJESTRACJA</h2>
            <form id="registrationForm" class="registrationForm">
                <h3 class="inputInfo">Imię</h3><input class="inputLogin" type="text" name="name"><br>
                <h3 class="inputInfo">Nazwisko</h3><input class="inputLogin" type="text" name="surname"><br>
                <h3 class="inputInfo">Email</h3><input class="inputLogin" type="email" name="email"><br>
                <h3 class="inputInfo">Hasło</h3> <input class="inputLogin" type="password" name="password"><br>
                <input class="loginButton" type="submit" value="Zaloguj">
                <a href="login.php">
                    <label id="toRegistration" class="toRegistration">Mam już konto</label>
                </a>
            </form>
        </div>
    </div>
<?php include('footer.php'); ?>