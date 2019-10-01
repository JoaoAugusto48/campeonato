<?php
    require_once('../controller/EquipeController.php');
    $equipeController = new EquipeController();

    $equipe = $equipeController->listarNome();

    $titulo = 'Equipes - Times';
    require_once('header.php');
?>

    <h2>Lista de Times</h2>
    <hr/>
    <input type="button" value="Voltar" onclick="javascript: location.href='menu'">
    <input type="button" value="Inserir Equipe" onclick="javascript: location.href='frmInsEquipe'">
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>SIGLA</th>
            <th>PAIS</th>
            <th>OPERAÇÕES</th>
        </tr>
        <?php foreach($equipe as $row) { ?>
        <tr>
            <td><?= $row->getId() ?></td>
            <td><?= $row->getNome() ?></td>
            <td><?= $row->getSigla() ?></td>
            <td><?= $row->getPais()->getNome() ?></td>
            <th>
                <input type="button" value="Editar" onclick="javascript: location.href='frmEdtEquipe?id='+<?= $row->getId() ?>">
                <input type="button" value="Remover">
            </th>
        </tr>
        <?php } ?>
    </table>

<?php require_once('footer.php');