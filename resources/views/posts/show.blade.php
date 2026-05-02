@extends('layouts.app')

@section('content')

<h2>{{ $post->title }}</h2>

<p style="color:#6b7280; margin-top:15px;">
    {{ $post->content }}
</p>

<div style="margin-top:20px;">
    <a href="/" class="btn">← Back</a>
</div>

@endsection