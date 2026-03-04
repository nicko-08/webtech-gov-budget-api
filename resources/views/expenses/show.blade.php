@extends('frontend.layouts.app')

@section('title', 'Expense Details')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Expense Details #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Viewing expense record {{ $id }}.</p>
    </section>
@endsection
