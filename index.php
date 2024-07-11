<?php
require_once('inc.connect.php');
?>
<DOCTYPE html>
<html>
    <head>
        <title>Consultas Médicas</title>
        <meta charset = 'utf-8'>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="./img/fav.png" sizes="32x32">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    </head>
    <body>
    <?php include 'header.php';?>

    <div style="min-height:70%; ">

        <div class="container-fluid" margin="100px" >

            <div class="d-block" style="background-color:#fff">

                <?php

            if( isset($_GET['pg']) and !empty($_GET['pg'])){
                $pag = $_GET['pg'];
            }else{ 
                $pag = 'home';
            }

            if( isset($_GET['msg']) and !empty($_GET['msg'])){
                $msg = $_GET['msg'];
            }else{
                $msg = 'home';
            }

            if($msg=='cadastrado'){
                echo '<h2 class="bg-success">Cadastrado com sucesso!</h2>';
            }elseif($msg=='deletado'){
                echo '<h2 class="bg-success">Deletado com sucesso!</h2>';
            }elseif($msg=='alterado'){
                echo '<h2 class="bg-success">Alterado com sucesso!</h2>';
            }elseif ($msg=='erro') {
                echo '<h2 class="bg-danger">Erro ao executar comando :(</h2>';
            }
            
            include_once('inc.'.$pag.'.php');
        ?>
           </div>
        </div>
    </div>  
    <?php include 'footer.php';?>
    </body>

</html>