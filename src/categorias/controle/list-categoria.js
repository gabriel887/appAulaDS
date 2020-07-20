$(document).ready(function() {
    $('#table-categoria').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "src/categorias/modelo/list-categoria.php",
            "type": "POST"
        },
        "language": {
            "url": "libs/DataTables/dataTables.brazil.json"
        },
        "columns": [{
                "data": "idcategoria",
                "className": "text-center"
            },
            {
                "data": "nome",
                "className": "text-center"
            },
            {
                "data": "datamodificacao",
                "className": "text-center"
            },
            {
                "data": "ativo",
                "orderable": false,
                "serchable": false,
                "className": "text-center",
                "render": function(data, type, row, meta) {
                    return data == 'S' ? 'Ativo' : 'Não Ativo'
                }
            },
            {
                "data": "idcategoria",
                "orderable": false,
                "serchable": false,
                "className": "text-center",
                "render": function(data, type, row, meta) {
                    return `
                    <button id="${data}" class="btn btn-info btn-sm btn-view"> I</button>
                    <button id="${data}" class="btn btn-primary btn-sm btn-edit">U</i></button>
                    <button id="${data}" class="btn btn-danger btn-sm btn-delete">D</button>
                    `
                }
            }
        ]
    })
})