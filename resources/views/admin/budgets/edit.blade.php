@extends('frontend.layouts.app')

@section('title', 'Edit Budget')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Edit Budget #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Editing admin budget {{ $id }}.</p>
    </section>
@endsection
