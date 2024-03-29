<?php
    define('__ROOT__', '../..');
    require_once(__ROOT__.'/controller/CampeonatoController.php');
   $campeonatoController = new CampeonatoController();
   
   $campeonato = $campeonatoController->listarCampeonato();
   
   $titulo = 'Página Principal';
   require_once(__ROOT__.'/view/layout/header.php');
?>

    <h1 class="text-dark">Campeonato</h1>

    <a href="<?= __ROOT__ ?>/view/equipes/lstEquipe.php" class="btn btn-info">Equipes</a>
    <a href="<?= __ROOT__ ?>/view/paises/lstPais.php" class="btn btn-info">Países</a>
    <a href="<?= __ROOT__ ?>/view/campeonato/frmInsCampeonato.php" class="btn btn-info">Novo Campeonato</a>
    
    <hr class="bg-secondary">
    <h3>Campeonatos recorrentes</h3>
    <table class="table table-striped table-hover bg-light">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Campeonato</th>
                <th scope="col" class="text-center">Equipes</th>
                <th scope="col" class="text-center">Rodadas</th>
                <th scope="col" class="text-center">Turno</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($campeonato as $row) { ?>
            <tr>
                <td scope="row" class="text-center">
                    <a href="lstEstatistica.php?id=<?= $row->getId() ?>" class="btn btn-outline-dark"><?= strip_tags($row->getNome()) ?></a>
                </td>
                <td scope="row" class="text-center">E: <?= $row->getNEquipe() ?></td>
                <td scope="row" class="text-center">R: <?= $campeonatoController->numeroRodadas($row->getNEquipe(),$row->getTurno()) ?></td>
                <td scope="row" class="text-center">T: <?= $campeonatoController->condicaoTurno($row->getTurno()) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>


<?php require_once(__ROOT__.'/view/layout/footer.php'); ?>