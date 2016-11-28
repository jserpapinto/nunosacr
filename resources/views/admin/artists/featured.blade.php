<!-- Admin template for featured artist --> 

@extends('admin.layout')

@section('title', 'Artistas')

@section('subtitle', 'Artista em Destaque')

@section('content')

	{{ $artist->name }}

	{{ var_dump($works) }}

@endsection