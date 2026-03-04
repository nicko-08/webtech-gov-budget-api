@extends('frontend.layouts.app')

@section('title', 'Edit Expense')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Edit Expense #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Editing expense {{ $id }}.</p>
    </section>
@endsection
