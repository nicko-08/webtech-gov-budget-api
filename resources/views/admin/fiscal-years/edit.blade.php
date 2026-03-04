@extends('frontend.layouts.app')

@section('title', 'Edit Fiscal Year')

@section('content')
    <section class="card">
        <h1 style="margin:0 0 8px;">Admin - Edit Fiscal Year #{{ $id }}</h1>
        <p class="muted" style="margin:0;">Editing fiscal year {{ $id }}.</p>
    </section>
@endsection
