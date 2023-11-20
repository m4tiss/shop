<?php
include_once('settings.php');
include('navbar.php');
include('functions/functionsUser.php');
include_once('config.php');
session_start();

if (!empty($_SESSION['users'])) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    registerUser($conn, $name, $surname, $email, $password);
}
?>

    <div class="loginOrRegistrationContainer">
        <div class="registrationDiv">
            <h2 class="inputTitle">REJESTRACJA</h2>
            <form id="registrationForm" class="registrationForm" action="registration.php" method="post">
                <h3 class="inputInfo">Imię</h3><input class="input" type="text" pattern="[A-Z][a-z]*" name="name"><br>
                <h3 class="inputInfo">Nazwisko</h3><input class="input" type="text" pattern="[A-Z][a-z]*" name="surname"><br>
                <h3 class="inputInfo">Email</h3><input class="input" type="email" name="email"><br>
                <h3 class="inputInfo">Hasło</h3> <input class="input" type="password" name="password"><br>
                <input class="registrationButton" type="submit" value="Zarejestruj">
                <a href="login.php">
                    <label id="toLogin" class="changeLoginWindow">Mam już konto</label>
                </a>
                <label id="errorWarring"></label>
            </form>
        </div>
    </div>
    <script src="scripts/registrationAndLogin.js"></script>
<?php include('footer.php'); ?>