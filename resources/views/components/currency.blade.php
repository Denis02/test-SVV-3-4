<div class="table-responsive">
    <form method="post" id="edit_currency" action="" >
        <table class="table table-striped table-bordered">
            <thead>
            @auth
            <tr>
                <th width="20%">Currency</th>
                <th width="25%">Buy</th>
                <th width="25%">Sell</th>
                <th width="30%">Action</th>
            </tr>
            @else
                <tr>
                    <th width="30%">Currency</th>
                    <th width="35%">Buy</th>
                    <th width="35%">Sell</th>
                </tr>
            @endauth
            </thead>
            <tbody>
            @if(isset($data))
                <tr>
                    <td>{{ $data->currency }} <input type="hidden" name="currency" value="{{ $data->currency }}"></td>
                    <td><input name="buy" value="{{ $data->buy }}" title="buy"/><p>{{ $data->buy }}</p></td>
                    <td><input name="sell" value="{{ $data->sell }}" title="sell"/><p>{{ $data->sell }}</p></td>
                    @auth
                    <td>
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                        <p class="text-center">
                            <button class="btn btn-primary edit" title="Edit">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                </svg></button>
                            <button class="btn btn-danger delete" title="Delete">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </p>
                    </td>
                    @endauth
                </tr>
            @endif
            </tbody>
        </table>
    </form>
</div>

