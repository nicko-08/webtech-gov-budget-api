@extends('frontend.layouts.app')

@section('title', 'Budget Item Details')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Budget Item Details #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Viewing budget item {{ $id }}.</p>
    </section>
@endsection
