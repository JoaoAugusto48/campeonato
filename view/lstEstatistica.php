<?php
    require_once('../controller/EstatisticaController.php');
    require_once('../controller/CampeonatoController.php');
    require_once('../controller/EquipeController.php');

    $id_campeonato = $_GET['id'];

    $estatisticaController = new EstatisticaController();
    $campeonatoController = new CampeonatoController();
    $equipeController = new EquipeController();    
    
    $estatistica = $estatisticaController->listarPorCampeonato($id_campeonato);
    $campeonato = $campeonatoController->listarId($id_campeonato);

    // regras de classificação do campeonato 
    $classificacao = $estatisticaController->classificacao($estatistica);
        
    // var_dump($classificacao);
    // die();

    $timeCampeao = '';
    if($classificacao){
        // definição do campeão /* como separar em metodo? */
        $campeao = $estatisticaController->listarCampeao($campeonato,$classificacao);
                
        if($campeao){
            $campeao = $equipeController->listarPorId($campeao);
            $timeCampeao = ' - Campeão <b>' . $campeao->getNome().'</b>';
        }
        // até aqui
    }

    $titulo = $campeonato->getNome();
    require_once('header.php');
?>

    <h2><?= $campeonato->getNome() . $timeCampeao ?></h2>
    <hr class="bg-dark">
    <input type="button" class="btn btn-info" value="Voltar" onclick="javascript: location.href='menu'">
    <input type="button" class="btn btn-info" value="Jogos" onclick="javascript: location.href='lstPartidas?id=<?= $id_campeonato ?>'">
    <br><br>
    
    
    <?php if(!$classificacao){ ?>
        <h2>Ainda não há equipes cadastradas</h2>
        <input type="button" class="btn btn-outline-info" value="Adicionar Equipes" onclick="javascript: location.href='frmAddEquipes?id=<?= $campeonato->getId() ?>'">
    <?php } else { ?>
        <table class="table table-striped table-hover bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>NOME</th>
                    <th>JOGOS</th>
                    <th>VITORIA</th>
                    <th>EMPATE</th>
                    <th>DERROTA</th>
                    <th>GOLS</th>
                    <th>AGV (%)</th>
                    <th>PONTOS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=1; foreach($classificacao as $row) { 
                ?>
                <tr 
                    <?php if($i==1){ ?>
                        class="bg-info text-white font-weight-bold"
                    <?php } ?>
                >
                <!-- style="background-color: #000" -->
                    <td><?= $i ?></td>
                    <td><?= strip_tags($row->getEquipe()->getNome()) ?></td>
                    <td><?= $estatisticaController->jogos($row->getId(),$row->getVitoria(),$row->getEmpate(),$row->getDerrota()) ?></td>
                    <td><?= $row->getVitoria() ?></td>
                    <td><?= $row->getEmpate() ?></td>
                    <td><?= $row->getDerrota() ?></td>
                    <td>
                        <?= $row->getGolPro() ?>/<?= $row->getGolContra() ?>
                    </td>
                    <td><?= $estatisticaController->average($row->getVitoria(),$row->getEmpate(),$row->getDerrota()) ?>%</td>
                    <td><?= $estatisticaController->pontos($row->getId(),$row->getVitoria(),$row->getEmpate()) ?></td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    <?php } ?>

<?php require_once('footer.php'); ?>