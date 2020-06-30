/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



$(document).ready(function(){
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $.ajax({
            url: "/currencies?page="+page,
            success: function(data)
            {
                $('#table_data').html(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '.currency a', function(event){
        event.preventDefault();
        var code = $(this).text();
        $.ajax({
            url: "/currency/"+code,
            success: function(data)
            {
                $('#table_data').html(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '#edit_currency button[type="submit"]', function(event){
        event.preventDefault();
        var data = $('#edit_currency');
        var code = data.find('input[name="currency"]').val();
        $.ajax({
            url: "/currency/"+code,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data.serialize() + '&_method=PUT',
            success: function(data) {
                $('#table_data').html(data);
            },
            error: function(error) {
                if(error.status == 422)
                    showMessage(error.responseText);
                else console.log(error);
            }
        });
    });

    $(document).on('click', '#create_currency_btn', function(event){
        event.preventDefault();
        $('#table_data').html('<div class="table-responsive">'+
            '<form method="post" id="create_currency" action="" >'+
            '<table class="table table-striped table-bordered">'+
            '<thead>'+
            '<tr>'+
            '<th width="20%">Currency</th>'+
            '<th width="25%">Buy</th>'+
            '<th width="25%">Sell</th>'+
            '<th width="30%">Action</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>'+
            '<tr>'+
            '<td><input name="currency" value="" title="currency"/></td>'+
            '<td><input name="buy" value="" title="buy"/></td>'+
            '<td><input name="sell" value="" title="sell"/></td>'+
            '<td><button type="submit" class="btn btn-primary btn-block">Save</button> </td>'+
            '</tr>'+
            '</tbody>'+
            '</table>'+
            '</form>'+
            '</div>');
    });

    $(document).on('click', '#create_currency button[type="submit"]', function(event){
        event.preventDefault();
        var data = $('#create_currency');
        $.ajax({
            url: "/currency",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data.serialize(),
            success: function(data) {
                $('#table_data').html(data);
            },
            error: function(error) {
                if(error.status == 422)
                    showMessage(error.responseText);
                else console.log(error);
            }
        });
    });

    $(document).on('click', '#edit_currency button.edit', function(event){
        event.preventDefault();
        var table = $('#edit_currency');
        table.find('p').hide();
        var inputs = table.find('input, button[type="submit"]').show();
    });

    $(document).on('click', '#edit_currency button.delete', function(event){
        event.preventDefault();
        var code = $('#edit_currency').find('input[name="currency"]').val();
        $.ajax({
            url: "/currency/"+code,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {_method:'DELETE'},
            success: function(data) {
                $('#table_data').html(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '#modal-message button', function(event){
        event.preventDefault();
        hideMessage();
    });

});

function showMessage(data) {
    data = JSON.parse(data);
    var block = $('#modal-message');
    block.find('.modal-title').text(data.message);
    var body = block.find('.modal-body').text('');
    if(!$.isEmptyObject(data.errors)){
        $.each(data.errors, function (index, value) {
            body.append('<div class="alert alert-danger" role="alert"><b>'+index+':</b> '+value+'</div>');
        })
    }
    block.show();
}

function hideMessage(data) {
    var block = $('#modal-message');
    block.find('.modal-title').text('');
    block.find('.modal-body').html('');
    block.hide();
}