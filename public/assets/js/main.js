$("#formularioCliente")
    .validate({
    rules: {
        // estabelece regras conforme o atributo name de cada input
        nome: {
            required: true,
        }
    }
});