@extends('admin.layouts.app')

@section('title', 'Forúm')

@section('header')
    Todos os suportes
@endsection

@section('content')
@include('admin.supports.partials.header', compact('supports'))
    @include('admin.supports.partials.content', compact('supports'))

    <x-pagination :paginator="$supports" :appends="$filters" />
@endsection
