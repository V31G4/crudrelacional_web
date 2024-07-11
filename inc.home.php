<!DOCTYPE html>
<html>
<head>
    <title>Consultas Médicas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="./img/fav.png" sizes="32x32">
    <style>
        body {
            margin-bottom: 0;
        }
        #main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 180px);
        }
        .element {
            text-align: center;
            padding: 30px;
            border: 1px solid #ccc; 
            flex-grow: 1;
            max-width: 400px;
        }
        .element img {
            max-width: 100%;
        }
        @media (max-width: 768px) {
            .element {
                margin-bottom: 20px; 
            }
        }
    </style>
</head>
<body>

<main id="main" class="container py-4">
    <div class="row"> 

        <div class="col-sm-12 col-md-2 element"> 
            <a href="index.php?pg=consulta"><img src="img/consulta.png"></a>
            <div class="caption"> 
                <a href="index.php?pg=consulta"><h3>Cadastrar Consulta</h3></a> 
            </div> 
        </div> 

        <div class="col-sm-12 col-md-2 element"> 
            <a href="index.php?pg=paciente"><img src="img/paciente.png"></a>
            <div class="caption"> 
                <a href="index.php?pg=paciente"><h3>Cadastrar Paciente</h3></a>
            </div> 
        </div> 
        
        <div class="col-sm-12 col-md-2 element"> 
            <a href="index.php?pg=especialidade"><img src="img/especialidade.png"></a> 
            <div class="caption"> 
                <a href="index.php?pg=especialidade"><h3>Cadastrar Especialidade</h3></a>
            </div> 
        </div>

        <div class="col-sm-12 col-md-2 element"> 
            <a href="index.php?pg=cid"><img src="img/cid.png"></a> 
            <div class="caption"> 
                <a href="index.php?pg=cid"><h3>Cadastrar CID</h3></a>
            </div> 
        </div>

        <div class="col-sm-12 col-md-2 element"> 
            <a href="index.php?pg=medico"><img src="img/medico.png"></a>
            <div class="caption"> 
                <a href="index.php?pg=medico"><h3>Cadastrar Médico</h3></a>
            </div> 
        </div>

    </div>
</main>

</body>
</html>