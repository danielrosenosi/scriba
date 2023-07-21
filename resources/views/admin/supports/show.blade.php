@extends('admin.layouts.app')

@section('title', 'Ver dúvida')

@section('header')
    <h1>Detalhes do chamado {{ $support->id }}</h1>
@endsection

@section('content')
    <ul>
        <li>Assunto: {{ $support->subject }}</li>
        <li>Status: {{ $support->status }}</li>
        <li>Descrição: {{ $support->body }}</li>
    </ul>

    <form action="{{ route('supports.destroy', $support->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded my-4">Deletar</button>
    </form>
@endsection