<?php
include_once('settings.php');
include('navbar.php');
include_once('config.php');
include_once('functions/functionsUser.php');
session_start();

if (!empty($_SESSION['users'])) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    loginUser($conn, $email, $password);
}
?>
    <div class="loginOrRegistrationContainer">
        <div class="loginDiv">
            <h2 class="inputTitle">LOGOWANIE</h2>
            <form id="loginForm" class="loginForm" action="login.php" method="post">
                <h3 class="inputInfo">Email</h3><input class="input" type="email" name="email"><br>
                <h3 class="inputInfo">Hasło</h3> <input class="input" type="password" name="password"><br>
                <input class="loginButton" type="submit" value="Zaloguj">
                <a href="registration.php">
                    <label id="toRegistration" class="changeLoginWindow">Nie mam jeszcze konta</label>
                </a>
                <label id="errorWarring">Siemano</label>
            </form>
        </div>
    </div>
<?php include('footer.php'); ?>