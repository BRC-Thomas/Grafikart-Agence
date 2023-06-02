@extends('base')


@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence lorem ipsum</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab assumenda atque, blanditiis commodi eaque
                explicabo iste mollitia nostrum omnis perferendis sint temporibus veniam, vitae voluptatibus!</p>
        </div>
    </div>

    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">
            @foreach($properties as $property)
                <div class="col">
                    @include('properties.card')
                </div>
            @endforeach
        </div>
    </div>

@endsection
