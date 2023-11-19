<?php
include_once('settings.php');
include('navbar.php');
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
    $role = 'user';

    if (empty($name)) {
        echo '<script>showNameErrorMessage()</script>';
    } elseif (empty($surname)) {
        echo '<script>showSurnameErrorMessage()</script>';
    } elseif (empty($email)) {
        echo '<script>showEmailErrorMessage()</script>';
    } elseif (empty($password)) {
        echo '<script>showPasswordErrorMessage()</script>';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertUser = "INSERT INTO users (name, surname,password,role) VALUES ('$name', '$surname','$hashedPassword','$role')";

        $getId = "SELECT idUser FROM users WHERE name='$name' AND surname='$surname' AND password='$hashedPassword'";

        $getEmails = "SELECT email FROM contacts WHERE email='$email'";


        if ($email_Result = mysqli_query($conn, $getEmails)) {
            if (mysqli_num_rows($email_Result) > 0) {
                echo '<script>showExistEmailErrorMessage()</script>';
            } else {
                if (mysqli_query($conn, $insertUser)) {
                    echo '<script>InsertUserMessage()</script>';
                } else {
                    echo "Error: " . $insertUser . "<br>" . mysqli_error($conn);
                }
                if ($result = mysqli_query($conn, $getId)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $clientId = $row['idUser'];
                        }
                        $add_email = "INSERT INTO contacts(idUser,email,phoneNumber) VALUES ($clientId,'$email','000000000')";
                        if (mysqli_query($conn, $add_email)) {

                        } else {
                            echo "Problem z pobraniem dodaniem emailu";
                        }
                    } else {
                        echo "Problem z pobraniem idUsera bazą danych";
                    }
                    mysqli_free_result($result);
                } else {
                    echo "Problem z pobraniem idUsera bazą danych";
                }

            }
        }
    }

}


?>
    <div class="loginOrRegistrationContainer">
        <div class="registrationDiv">
            <h2 class="inputTitle">REJESTRACJA</h2>
            <form id="registrationForm" class="registrationForm" action="registration.php" method="post">
                <h3 class="inputInfo">Imię</h3><input class="input" type="text" name="name"><br>
                <h3 class="inputInfo">Nazwisko</h3><input class="input" type="text" name="surname"><br>
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