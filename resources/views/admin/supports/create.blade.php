@extends('admin.layouts.app')

@section('title', 'Nova postagem')

@section('header')
    <h1>Nova dúvida</h1>
@endsection

@section('content')
    <x-alert />

    <form action="{{ route('supports.store') }}" method="POST">
        @include('admin.supports.partials.form')
    </form>
@endsection