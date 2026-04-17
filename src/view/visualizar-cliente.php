<?php /** @var \model\Cliente $cliente ; */?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cliente-getName()?></title>
</head>
<body>
    <h1>
        <?=$cliente->getNome() ?>
    </h1>
    <h2>
        <?=$cliente->getCpf() ?>
    </h2>
</body>
</html>