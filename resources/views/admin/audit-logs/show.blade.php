@extends('frontend.layouts.app')

@section('title', 'Audit Log Details')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Audit Log Details #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Viewing audit log {{ $id }}.</p>
    </section>
@endsection
