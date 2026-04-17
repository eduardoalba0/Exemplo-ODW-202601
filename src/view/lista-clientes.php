<?php /** @var \model\Cliente[] $clientes */?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>
        Listagem de Clientes
    </h1>
    <table>
        <thead>
            <th>#</th>
            <th>nome</th>
            <th>cpf</th>
        </thead>
        <tbody>

            <?php foreach ($clientes as $cliente) : ?>
            <?= "<tr>"?>
                <?= "<td>{$cliente->getId()}</ttd"?>
                <?= "<td>{$cliente->getNome()}</td>"?>
                <?= "<td>{$cliente->getCpf()}</td>"?>
                <?= "</tr>"?>

            <?php endforeach; ?>
        </tbody>

    </table>
</body>
</html>