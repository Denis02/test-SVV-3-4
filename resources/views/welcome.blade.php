<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Курс валют</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            .box{
                width:600px;
                margin:0 auto;
            }

            .currency a{
                cursor: pointer;
            }

            #edit_currency input, #edit_currency button[type="submit"]{
                display: none;
            }
        </style>
    </head>

    <body>
    <br />
    <div class="container">
        <h3 align="center"><a class="button primary" href="{{route('currencies')}}">Currencies</a></h3><br />
        <div id="table_data">
            @include('components.currencies')
        </div>
    </div>

    <script>
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
                        console.log(error);
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
                console.log(data.serialize());
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
                        console.log(error);
                    }
                });
            });

            $(document).on('click', '#edit_currency button.edit', function(event){
                event.preventDefault();
                var table = $('#edit_currency');
                table.find('p').hide();
                var inputs = table.find('input, button[type="submit"]').show();
                console.log(inputs);
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

        });
    </script>
    </body>

</html>
