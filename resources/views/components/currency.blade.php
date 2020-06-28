<div class="table-responsive">
    <form method="post" id="edit_currency" action="" >
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="20%">Currency</th>
                    <th width="25%">Buy</th>
                    <th width="25%">Sell</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->currency }} <input type="hidden" name="currency" value="{{ $data->currency }}"></td>
                    <td><input name="buy" value="{{ $data->buy }}" title="buy"/><p>{{ $data->buy }}</p></td>
                    <td><input name="sell" value="{{ $data->sell }}" title="sell"/><p>{{ $data->sell }}</p></td>
                    <td>
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                        <p class="text-center">
                            <button class="btn btn-primary edit" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button>
                            <button class="btn btn-danger delete" title="Delete"><span class="glyphicon glyphicon-trash"></span></button>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

