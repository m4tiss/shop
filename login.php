<?php include_once('settings.php') ?>
<?php include('navbar.php'); ?>
<div class="loginContainer">
    <div class="loginDiv">
        <h2 class="inputTitle">LOGOWANIE</h2>
        <form id="loginForm" class="loginForm">
            <h3 class="inputInfo">Email</h3><input class="inputLogin" type="email" name="email"><br>
            <h3 class="inputInfo">Hasło</h3> <input class="inputLogin" type="password" name="password"><br>
            <input class="loginButton" type="submit" value="Zaloguj">
            <a href="registration.php">
                <label id="toRegistration" class="toRegistration">Nie mam jeszcze konta</label>
            </a>
        </form>
    </div>
</div>
<?php include('footer.php'); ?>
