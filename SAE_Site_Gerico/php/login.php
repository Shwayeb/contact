<?php
session_start();

$valid_username = 'test';
$valid_password = 'test';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.html"); 
        exit();
    } else {
        echo "<script>
                document.getElementById('error-message').innerText = 'Nom d\'utilisateur ou mot de passe incorrect.';
              </script>";
    }
}
?>
