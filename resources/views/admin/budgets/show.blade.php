@extends('frontend.layouts.app')

@section('title', 'Budget Record')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Budget Record #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Viewing admin budget {{ $id }}.</p>
    </section>
@endsection
