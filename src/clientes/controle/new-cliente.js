$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar nova cliente')

        const datacriacao = new Date().toLocaleString()

        $('.modal-body').load('src/clientes/visao/form-cliente.html', function() {
            $('#datacriacao').val(datacriacao)
        })

        $('.btn-save').show()
        $('.btn-update').hide()

        $('#modal-cliente').modal('show')
    })
})