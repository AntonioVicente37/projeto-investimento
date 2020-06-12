@extends('templates.master')

        @section('conteudo-view')
            @if(session('success'))
            <h3>{{ session('success')['messages'] }}</h3>
        @endif
        {!! Form::open(['route' => 'instituition.store', 'method' => 'post' , 'class' => 'form-padrao']) !!}
            @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
            @include('templates.formulario.submit', ['input' => 'Cadastrar'])
        {!! Form::close() !!}

        <table class="default-table">
            <thead>
            <tr>
                <th>Produto</th>
                <th>Nome da Instituição</th>
                <th>Valor investido</th>
            </tr>
            </thead>
            <tbody>
                @foreach($product_list as $product)
                    <tr>    
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->instituition->name }}</td>
                        <td>{{ $product->valueFormUser(Auth::user()) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>  

@endsection