@extends('frontend.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Edit Category #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Editing category {{ $id }}.</p>
    </section>
@endsection
