$(document).ready(function(){
    $("#cpf").mask('000.000.000-00')

    // let table = new DataTable('#tabela_clientes', { });
    $('#tabela_clientes').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        }
    });
})

function mensagemSucesso(mensagem){
    Swal.fire({
        title: "Sucesso!",
        text: mensagem,
        icon: 'success',
    })
}

function mensagemErro(mensagem){
    Swal.fire({
        title: "Erro!",
        text: mensagem,
        icon: 'error',
    })
}


function confirmarRemocao(mensagem, event) {
    event.preventDefault(); // intercepta o evento e evita o for de ser enviado
    Swal.fire({ // exibe o diálogo de confirmação
        title: "Atenção!",
        text: mensagem,
        icon: 'question',
        showCancelButton: true,
    }).then((result) => { // verifica a respost do usuário
        if (result.isConfirmed){
            event.target.submit(); // SE o usuário confirmou, o formulário é enviado
        }
        return false; // se o usuário nao confirmou, o formulário não é enviado e retorna false
    })
}


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

