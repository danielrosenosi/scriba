@extends('admin.layouts.app')

@section('title', 'Nova dúvida')

@section('header')
    <h1 class="text-lg mb-4">Nova dúvida</h1>
@endsection

@section('content')
    <form action="{{ route('supports.store') }}" method="POST">
        @include('admin.supports.partials.form')
    </form>
@endsection