<!-- header.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultas Médicas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="./img/fav.png" sizes="32x32">
    <style>
        .navbar-nav .nav-link {
            font-size: 1.5em;
        }
        .navbar-nav {
            flex-grow: 1;
            justify-content: space-around;
        }
        .navbar-brand span {
            font-size: 1.5em;
            margin-right: 25px;
            margin-left: 25px;
        }
        .navbar-header img {
            width: 10%;
        }
        main {
            flex: 1;
        }
        footer {
            bottom: 0;
            width: 100%;
            background-color: #2b6746;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 1.3em;
            margin-top: 20px;
        }
        footer .container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
        }
        footer .lista_footer a {
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2b6746;">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="index.php?pg=home">
                    <img src="img/fav.png" width="30" height="40" class="d-inline-block align-top mr-3" alt="">
                    <span>Consultas Médicas</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pg=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pg=consulta">Cadastrar Consulta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pg=paciente">Cadastrar Paciente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pg=especialidade">Cadastrar Especialidade</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pg=cid">Cadastrar CID</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pg=medico">Cadastrar Médico</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>