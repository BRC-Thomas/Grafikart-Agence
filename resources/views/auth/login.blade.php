@extends('base')

@section('title','Se connecter')

@section('content')
    <div class="mt-4 container">
        <h1>@yield('title')</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="my-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('login') }}" class="vstack grap-3">
            @csrf
            @include('shared.input',['class'=>'col', 'name'=>'email','label'=>'Email', 'type'=>'email'])
            @include('shared.input',['type'=>'password','class'=>'col', 'name'=>'password','label'=>'Mot de passe'])
        <div>
            <button class="btn btn-primary">Se connecter</button>
        </div>
        </form>
    </div>
@endsection