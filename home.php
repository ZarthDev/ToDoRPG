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
    $stmt = $conn->prepare("SELECT * FROM tb_tasks WHERE id_user = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_info']['id_user']);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    print_r($tasks);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoRPG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body {
            background-color: #0b0b0b;
            color: #e0e0e0;
        }

        .navbar {
            background-color: #1a0000;
            border-bottom: 2px solid #8b0000;
        }

        .navbar-brand {
            color: #c62828 !important;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .card {
            background-color: #121212;
            border: 1px solid #8b0000;
        }

        .btn-danger {
            background-color: #8b0000;
            border: none;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
        }

        .form-control {
            background-color: #1e1e1e;
            border: 1px solid #8b0000;
            color: #fff;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .progress {
            background-color: #1e1e1e;
            height: 20px;
        }

        .progress-bar {
            background-color: #c62828;
        }

        .task-item {
            border-bottom: 1px solid #8b0000;
            padding: 10px 0;
            color: #FFF;
        }

        .task-item:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navbar-brand">RACCOON CITY TASKS</span>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">

            <!-- CONTEÚDO PRINCIPAL -->
            <main class="col-lg-9 col-md-8 mb-4">
                <div class="card p-4">
                    <h4 class="mb-3 text-light">Missões Ativas</h4>

                    <!-- Criar tarefa -->
                    <div class="input-group mb-4">
                        <form action="add_task.php" method="POST">
                            <div class="input-group">
                                <input type="text" name="task_name" class="form-control" placeholder="Nova missão...">
                                <button type="submit" class="btn btn-danger">Adicionar</button>
                            </div>
                        </form>
                    </div>

                    <!-- Lista de tarefas -->
                    <?php foreach ($tasks as $task): ?>
                        <div class="task-item d-flex justify-content-between align-items-center">
                            <span><?php echo htmlspecialchars($task['description_task']); ?></span>
                            <div>
                                <form action="conclude_task.php" method="POST" class="d-inline">
                                    <button class="btn btn-sm btn-success me-2">
                                        <input type="hidden" name="task_id" value="<?php echo $task['id_task']; ?>">
                                        Concluir
                                    </button>
                                </form>
                                <form action="delete_task.php" method="POST" class="d-inline">
                                    <button class="btn btn-sm btn-outline-danger">
                                        <input type="hidden" name="task_id" value="<?php echo $task['id_task']; ?>">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>

            <!-- SIDEBAR / PERFIL -->
            <aside class="col-lg-3 col-md-4">
                <div class="card p-3 text-center text-light">
                    <h5 class="mb-2"><?php echo $_SESSION['user_info']['level_user']; ?></h5> 
                    <p class="text-light mb-1"><?php echo $_SESSION['user_info']['name_user']; ?></p>

                    <div class="mb-2">XP</div>
                    <div class="progress mb-3">
                        <div class="progress-bar" style="width: <?php echo ($_SESSION['user_info']['XP_user'] / 1000 * 100) ?>%;"> <?php echo $_SESSION['user_info']['XP_user']; ?> / 10000</div>
                    </div>

                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item bg-transparent text-light border-danger">
                            🧠 Missões concluídas: 12
                        </li>
                        <li class="list-group-item bg-transparent text-light border-danger">
                            ⚔️ Rank: <?php echo $_SESSION['user_info']['level_user']; ?>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>