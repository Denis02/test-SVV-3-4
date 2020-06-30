<div class="table-responsive">
    <div>
        <input id="create_currency_btn" class="btn btn-primary" type="button" value="Add New Currency">
        <a class="pull-right btn btn-outline-info" href="{{route('history')}}" target="_blank">History</a>
    </div>
    <table class="table table-striped table-bordered">
        <tr>
            <th width="20%">Currency</th>
            <th width="30%">Buy</th>
            <th width="30%">Sell</th>
        </tr>
        @foreach($data as $row)
            <tr>
                <td class="currency"><a>{{ $row->currency }}</a></td>
                <td>{{ $row->buy }}</td>
                <td>{{ $row->sell }}</td>
            </tr>
        @endforeach
    </table>
    {!! $data->links() !!}
</div>

