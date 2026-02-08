<?php
    session_start();
    
    /*user levels
    1 - Novato
    2 - Sobrevivente
    3 - Membro STARS
    4 - Agente da Umbrella
    5 - Lenda de Raccoon City
    */

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'toDoRPG';

    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['user'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM tb_users WHERE email_user = :username AND password_user = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['user'] = $username;
            header('Location: home.php');
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
    }
?>