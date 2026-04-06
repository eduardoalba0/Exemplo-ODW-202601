<?php
/** @var \model\Cliente[] $clientes  */
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
</head>
<body>
<h1>Clientes Cadastrados</h1>
<ul>
    <?php foreach ($clientes as $cliente): ?>
        <li><?= $cliente->getNome(); ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>