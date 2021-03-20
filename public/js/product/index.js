$(document).ready(function(){
    $('#refresh').click(function(){
        $('#dataTable').DataTable().ajax.reload();
    });

    const url = $("#url").val();
    $('#dataTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            {data: 'kode_produk', name:'kode_produk'},
            {data: 'nama_produk', name:'nama_produk'},
            {data: 'harga', name:'harga'},
            {data: 'stok', name:'stok'},
            {data: 'action', name:'action'}
        ],
        "order": [[0,'desc']]
    });

    $('body').on('click', '.modal-show', function(event){
        event.preventDefault();
        var me = $(this),
            url = me.attr('href'),
            title = me.attr('title');

        $('.modal-title').text(title);
        $('.modal-save').text('Tambah');
    });
});