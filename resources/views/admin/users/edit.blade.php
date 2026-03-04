@extends('frontend.layouts.app')

@section('title', 'Edit User')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Edit User #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Editing user {{ $id }}.</p>
    </section>
@endsection
