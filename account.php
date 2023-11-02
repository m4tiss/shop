<?php include_once('settings.php')?>
<?php include('navbar.php');
session_start();

if (empty($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users'];
?>

<div>
    <h2>Twoje konto</h2>
    <a href="logout.php">Logout</a>
</div>

<?php include('footer.php'); ?>