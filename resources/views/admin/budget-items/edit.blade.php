@extends('frontend.layouts.app')

@section('title', 'Edit Budget Item')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Edit Budget Item #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Editing budget item {{ $id }}.</p>
    </section>
@endsection
