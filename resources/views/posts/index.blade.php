@extends('layouts.app')

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center;">
    <h2 style="margin:0;">All Posts</h2>

    @auth
        <a href="/posts/create" class="btn">+ New Post</a>
    @endauth
</div>

<!-- SEARCH -->
<form method="GET" action="/" style="margin:20px 0; display:flex; gap:10px;">
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}"
        placeholder="Search posts..."
        class="input"
    >

    <button class="btn">Search</button>
</form>


<hr style="margin:20px 0; border:none; height:1px; background:#e5e7eb;">

<div style="display:grid; gap:25px;">

    @forelse($posts as $post)

        <div style="
            padding:20px;
            border-radius:16px;
            background:white;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
            transition:0.3s;
        "
        onmouseover="this.style.transform='translateY(-5px)'"
        onmouseout="this.style.transform='translateY(0)'"
        >

            <!-- IMAGE -->
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}"
                     style="width:100%; height:220px; object-fit:cover; border-radius:12px; margin-bottom:15px;">
            @endif

            <!-- TITLE -->
            <h3 style="margin-bottom:10px;">
                {{ $post->title }}
            </h3>

            <!-- CONTENT -->
            <p style="color:#6b7280; line-height:1.6;">
                {{ $post->content }}
            </p>

            <!-- META -->
            <div style="margin-top:10px; font-size:12px; color:#9ca3af;">
                Posted at {{ $post->created_at->format('M d, Y') }}
            </div>

            <!-- ACTIONS -->
            <div style="margin-top:15px; display:flex; gap:10px; flex-wrap:wrap;">

                <!-- VIEW -->
                <a href="/posts/{{ $post->id }}" class="btn">
                    View
                </a>

                @auth
                    @can('update', $post)

                        <!-- EDIT -->
                        <a href="/posts/{{ $post->id }}/edit" class="btn btn-success">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form action="/posts/{{ $post->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Delete this post?')">
                                Delete
                            </button>
                        </form>

                    @endcan
                @endauth

            </div>

        </div>

    @empty

        <div style="
            text-align:center;
            padding:40px;
            background:white;
            border-radius:16px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
        ">
            <h3>No posts yet 😢</h3>

            <p style="color:#6b7280;">
                Create your first post to get started.
            </p>

            @auth
                <a href="/posts/create" class="btn" style="margin-top:15px;">
                    Create Post
                </a>
            @endauth
        </div>

    @endforelse

</div>

@endsection