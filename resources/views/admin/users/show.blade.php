@extends('frontend.layouts.app')

@section('title', 'User Profile')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - User Profile #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Viewing user {{ $id }}.</p>
    </section>
@endsection
