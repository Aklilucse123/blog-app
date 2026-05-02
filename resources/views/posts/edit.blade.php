@extends('layouts.app')

@section('content')

<h2>Edit Post</h2>

<form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- TITLE -->
    <input 
        type="text" 
        name="title" 
        value="{{ old('title', $post->title) }}" 
        class="input"
    >

    <!-- CONTENT -->
    <textarea 
        name="content" 
        class="input" 
        rows="5"
    >{{ old('content', $post->content) }}</textarea>

    <!-- CURRENT IMAGE -->
    @if($post->image)
        <div style="margin-bottom:15px;">
            <p style="font-size:12px; color:#6b7280;">Current Image:</p>
            <img src="{{ asset('storage/' . $post->image) }}"
                 style="width:100%; max-height:200px; object-fit:cover; border-radius:10px;">
        </div>
    @endif

    <!-- NEW IMAGE -->
    <input type="file" name="image" class="input">

    <!-- BUTTON -->
    <button type="submit" class="btn">Update Post</button>

</form>

@endsection