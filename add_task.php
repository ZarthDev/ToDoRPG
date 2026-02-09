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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $task_name = $_POST['task_name'];
        $user_id = $_SESSION['user_info']['id_user'];

        $stmt = $conn->prepare("INSERT INTO tb_tasks (description_task, id_user) VALUES (:task_name, :user_id)");
        $stmt->bindParam(':task_name', $task_name);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        header('Location: home.php');
        exit();
    }
?>