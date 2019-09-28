<?php
    require_once('../controller/CampeonatoController.php');

    if(isset($_POST['txtNome']) && isset($_POST['nEquipe'])){
        $nome = $_POST['txtNome'];
        $nEquipe = $_POST['nEquipe'];
        $turno = $_POST['chkTurno'] = isset($_POST['chkTurno']) ? true : false;

        $campeonatoController = new CampeonatoController();
        $campeonato = $campeonatoController->inserirCampeonato($nome,$nEquipe,$turno);
        header('Location: frmAddEquipes?id='.$campeonato);
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Criar Campeonato</title>
    </head>
    <body>
        <h2>Criação de Campeonato</h2>
        <hr/>
        <input type="button" value="Voltar" onclick="javascript: location.href='menu'">
        <form action="frmInsCampeonato" method="post" id="frmInsCampeonato" name="frmInsCampeonato">
            <div>
                <label for="lblNome">Nome do Campeonato: </label>
                <input type="text" name="txtNome" id="txtNome" placeholder="ex: Brasileirão" autocomplete="off">
            </div>
            <div>
                <label for="lblQtd">Quantidade de Times: </label>
                <input type="number" name="nEquipe" id="nEquipe" placeholder="ex: 10" autocomplete="off">
            </div>
            <div>
                <label for="lblTurno">Habilitar 2º Turno</label>
                <input type="checkbox" name="chkTurno" id="chkTurno">
            </div>

            <input type="submit" value="Enviar">
        </form>
    </body>
</html>