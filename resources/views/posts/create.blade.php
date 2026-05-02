@extends('layouts.app')

@section('content')

<h2>Create Post</h2>

<form method="POST" action="/posts" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Post title" class="input">

    <textarea name="content" placeholder="Write your content..." class="input" rows="5"></textarea>

    <input type="file" name="image" class="input">

    <button type="submit" class="btn">Publish</button>
</form>

@endsection