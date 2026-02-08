<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login | Raccoon City</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: radial-gradient(circle at top, #1a0000, #000);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e0e0e0;
        }

        .login-card {
            background-color: #0f0f0f;
            border: 1px solid #8b0000;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 0 30px rgba(139, 0, 0, 0.6);
        }

        .login-title {
            color: #c62828;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .form-control {
            background-color: #1c1c1c;
            border: 1px solid #8b0000;
            color: #fff;
        }

        .form-control:focus {
            background-color: #1c1c1c;
            color: #fff;
            border-color: #c62828;
            box-shadow: none;
        }

        .btn-danger {
            background-color: #8b0000;
            border: none;
            letter-spacing: 1px;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
        }

        .login-footer a {
            color: #c62828;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="login-card card p-4">
    <div class="text-center mb-4">
        <h2 class="login-title">RACCOON CITY</h2>
        <small class="text-light">Sistema de Sobrevivência</small>
    </div>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label class="form-label text-light">Email</label>
            <input name="user" type="email" class="form-control" placeholder="Digite seu email">
        </div>

        <div class="mb-4">
            <label class="form-label text-light">Senha</label>
            <input name="password" type="password" class="form-control" placeholder="Digite sua senha">
        </div>

        <button type="submit" class="btn btn-danger w-100 mb-3">
            ENTRAR NA CIDADE
        </button>
    </form>

    <div class="login-footer text-light text-center">
        <small>
            Novo sobrevivente?
            <a href="#">Criar conta</a>
        </small>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
