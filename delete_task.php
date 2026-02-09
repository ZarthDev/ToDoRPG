<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'toDoRPG';

    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    
    $stmt = $conn->prepare("SELECT * FROM tb_tasks WHERE id_user = :user_id and id_task = :task_id");
    
    $stmt->bindParam(':user_id', $_SESSION['user_info']['id_user']);
    $stmt->bindParam(':task_id', $_POST['task_id']);
    $stmt->execute();
    
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($task) {
        $stmt = $conn->prepare("DELETE FROM tb_tasks WHERE id_task = :task_id");
        $stmt->bindParam(':task_id', $_POST['task_id']);
        $stmt->execute();
    }

    header('Location: home.php');
    exit();
?>