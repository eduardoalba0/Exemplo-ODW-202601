$(document).ready(function(){
    $("#cpf").mask('000.000.000-00')
})

// Seletor de classe
// $(".form-control").addClass("mb-5")

// Seletor de elemento
// $("input").addClass("mb-5")

// Seletor de ID
// $("#nome").addClass("mb-5")

// Seletor de atributo
// $("[type='text']").addClass("mb-5")

// Combinação de seletores (E/AND)
// $("input[type='text']").addClass("mb-5")
// $(".form-control.mb-1").addClass("mb-5")

// Combinação de seletores (OU/OR)
// $("input[type='text'], input[type='date']").addClass("mb-5")

$("#formCadastroCliente").validate({
    rules: {
        // As regras são definidas para cada campo com base no NAME
        nome: {
            required: true,
            minlength: 3
        },
        cpf: {
            required: true,
            minlength: 14,
            maxlength: 14
        },
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        nome: {
            required: "O nome é obrigatório.",
            minlength: "O nome deve conter pelo menos 3 caracteres."
        },
        cpf: {
            required: "O CPF é obrigatório.",
            minlength: "O CPF deve conter exatamente 14 caracteres.",
            maxlength: "O CPF deve conter exatamente 14 caracteres."
        }
    },
    errorElement: "span",
    errorClass: "text-danger",
})

