@extends('templates.master')

@section('conteudo-view')
    <header>
        <h1>{{ $instituitions->name }}</h1>
    </header>

    @include('groups.list', ['group_list' =>  $instituitions->groups])
@endsection