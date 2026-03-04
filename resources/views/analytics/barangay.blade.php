@extends('frontend.layouts.app')

@section('title', 'Barangay Analytics')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Barangay Analytics #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Viewing analytics for barangay {{ $id }}.</p>
    </section>
@endsection
