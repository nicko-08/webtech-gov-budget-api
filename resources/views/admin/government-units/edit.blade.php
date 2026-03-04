@extends('frontend.layouts.app')

@section('title', 'Edit Government Unit')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Edit Government Unit #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Editing government unit {{ $id }}.</p>
    </section>
@endsection
