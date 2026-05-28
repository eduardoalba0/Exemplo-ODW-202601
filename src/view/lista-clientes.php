<?php
/** @var \model\Cliente[] $clientes */
/** @var \model\Cliente $cliente */
$rota_clientes = BASE_URL . "/clientes";
?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Listagem de Clientes</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-3">

    <div class="row align-items-center">
        <div class="col-lg-9 col-md-6 col-sm-12">
            <h1>Listagem de Clientes</h1>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 text-end">
            <a class="0btn btn-primary" href="<?= BASE_URL . '/clientes/novo' ?>">Cadastrar Cliente</a>
        </div>
    </div>

    <table class="table table-striped mt-3">
        <thead>
        <tr class="table-dark">
            <th>#</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clientes as $cliente) : ?>
            <tr>
                <td><?= $cliente->getId() ?></td>
                <td>
                    <?php if (!empty($cliente->getUrlFotoPerfil())) : ?>
                    <img src="<?= $cliente->getUrlFotoPerfil() ?>"
                         class="img-foto-tabela rounded-circle border border-3 border-primary"
                         alt="<?= 'Imagem do Cliente ' . $cliente->getNome() ?>">
                    <?php else : ?>
                    <div class="border border-3 border-primary rounded-circle img-foto-tabela d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-fill text-primary"></i>
                    </div>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($cliente->getNome()) ?></td>
                <td><?= $cliente->getCpf() ?></td>
                <td>
                    <a class="btn btn-outline-primary"
                       href="<?= $rota_clientes . '/' . $cliente->getId() . '/editar' ?>">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a class="btn btn-outline-secondary" href='<?= $rota_clientes . '/' . $cliente->getId() ?>'>
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <form action='<?= $rota_clientes . '/' . $cliente->getId() . '/remover' ?>' method='POST'>
                        <button class="btn btn-outline-danger" type='submit'>
                            <i class="bi bi-trash2-fill"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "templates/template-rodape.php" ?>

</body>
</html>