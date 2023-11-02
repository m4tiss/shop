<?php include_once('settings.php');
include('navbar.php');
include_once('config.php');
session_start();

if (!empty($_SESSION['users'])) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        echo '<script>showEmailErrorMessage()</script>';
    } elseif (empty($password)) {
        echo '<script>showPasswordErrorMessage()</script>';
    } else {
        $getEmails = "SELECT email FROM contacts WHERE email='$email'";
        if ($email_Result = mysqli_query($conn, $getEmails)) {
            if (mysqli_num_rows($email_Result) <= 0) {
                echo '<script>showNotExistEmailErrorMessage()</script>';
            } else {

                $getId = "SELECT idUser FROM contacts WHERE email='$email'";

                if ($result_id = mysqli_query($conn, $getId)) {
                    if (mysqli_num_rows($result_id) > 0) {
                        $row = mysqli_fetch_assoc($result_id);
                        $clientId = $row['idUser'];

                        $hashedInputPassword = password_hash($password, PASSWORD_DEFAULT);

                        $getPasswordFromDB = "SELECT password FROM users WHERE idUser=$clientId";

                        if ($result_password = mysqli_query($conn, $getPasswordFromDB)) {
                            mysqli_num_rows($result_password);
                            $rowPassword = mysqli_fetch_assoc($result_password);
                            $passwordFromDB = $rowPassword['password'];

                            if (password_verify($password, $passwordFromDB)) {
                                $_SESSION['users'] = $row['idUser'];
                                header("Location: account.php");
                                    echo 'Działa Logowanko';
                            } else {
                                echo '<script>showInvalidPasswordMessage()</script>';
                            }
                        }else{
                            echo 'Błąd w pobraniu hasła';
                        }

                    }
                }
            }

        }
    }
}


?>
    <div class="loginOrRegistrationContainer">
        <div class="loginDiv">
            <h2 class="inputTitle">LOGOWANIE</h2>
            <form id="loginForm" class="loginForm" action="login.php" method="post">
                <h3 class="inputInfo">Email</h3><input class="input" type="email" name="email"><br>
                <h3 class="inputInfo">Hasło</h3> <input class="input" type="password" name="password"><br>
                <input class="registrationButton" type="submit" value="Zaloguj">
                <a href="registration.php">
                    <label id="toRegistration" class="changeLoginWindow">Nie mam jeszcze konta</label>
                </a>
                <label id="errorWarring">Siemano</label>
            </form>
        </div>
    </div>
<?php include('footer.php'); ?>