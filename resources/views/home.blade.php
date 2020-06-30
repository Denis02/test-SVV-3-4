@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 align="center"><a class="button primary" href="{{route('currencies')}}">Currency Rate UAH</a></h3></div>

                <div class="card-body">
                    @include('components.modal-message')
                    <div id="table_data">
                        @include('components.currencies')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
