<?php
include_once('settings.php');
include('navbar.php');
include_once('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, surname,password) VALUES ('$name', '$surname','$hashedPassword')";

    $getId = "SELECT idUser FROM users WHERE name='$name' AND surname='$surname' AND password='$hashedPassword'";



    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    if ($result=mysqli_query($conn, $getId)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $clientId = $row['idUser'];
                echo "User ID: " . $clientId . "<br>";
            }
        } else {
            echo "No matching users found.";
        }

        mysqli_free_result($result);
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $add_email = "INSERT INTO contacts(idUser,email,phoneNumber) VALUES ($clientId,'$email','000000000')";
    if (mysqli_query($conn, $add_email)) {
        echo "Dodałeś emaail";
    } else {
        echo "Error: " . $add_email . "<br>" . mysqli_error($conn);
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
            <input class="loginButton" type="submit" value="Zarejestruj">
            <a href="login.php">
                <label id="toLogin" class="changeLoginWindow">Mam już konto</label>
            </a>
        </form>
    </div>
</div>
<?php include('footer.php'); ?>