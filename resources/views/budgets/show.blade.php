@extends('frontend.layouts.app')

@section('title', 'Budget Details')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Budget Details #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Viewing budget record {{ $id }}.</p>
    </section>
@endsection
