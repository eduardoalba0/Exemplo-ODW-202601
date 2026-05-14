<?php /** @var model\Cliente $cliente */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Listagem de Clientes</title>
</head>
<body class="container pt-5">

<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <!-- Os formulários possuem dois atributos principais -->
    <!-- o action indica o endereço da página que vai receber os dados -->
    <!-- o method indica o tipo da requisição (se GET ou POST) -->
    <!-- Usamos formulários quando queremos capturar dados do usuário para algo -->
    <!-- e usar eles para alguma operação do sistema -->
    <form id="formularioCliente" action="<?= BASE_URL . '/clientes/cadastrar' ?>" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($cliente->getId() ?? '') ?>">
        <!-- O label é um texto que aparece e indica o que será inserido -->
        <!-- No seu atributo 'for', colocamos o ID do campo que ele é label  -->
        <label for="nome" class="form-label">Nome:</label>
        <!-- O input tem um id, que deve ser único em toda a página-->
        <!-- o name é usado para transferir os dados do formulário pra o action -->
        <!-- type indica o tipo do formulário (Se é data, numero, texto, senha) -->
        <!-- required indica que o campo é obrigatório -->
        <input id="nome" name="nome" type="text" class="form-control"
               value="<?= htmlspecialchars($cliente->getNome() ?? '') ?>" required>
        <br>

        <label for="cpf" class="form-label">CPF</label>
        <input id="cpf" name="cpf" type="text" class="form-control"
               value="<?= htmlspecialchars($cliente->getCpf() ?? '') ?>" required>
        <br>

        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
        <input id="data_nascimento" name="data_nascimento" class="form-control" type="date"
               value="<?= htmlspecialchars($cliente->getDataNascimento() ? $cliente->getDataNascimento()->format('Y-m-d') : '') ?>"
               required>
        <br>

        <!-- O botão "Submit" vai encaminhar o formulário para o ation correspondente -->
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="<?= BASE_URL . '/clientes' ?>" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>
</body>
<?php require_once "templates/template-rodape.php" ?>
</body>
</html>
