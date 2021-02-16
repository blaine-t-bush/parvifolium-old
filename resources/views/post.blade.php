@extends('layouts.app')

@section('title', strip_tags(parsedown($post->title, true)))

@push('style')
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endpush

@section('main')
<article id="post">
    <h1>{!! parsedown($post->title, true) !!}</h1>

    <p class="posted-at">Posted on <time datetime="{{ $post->posted_at }}">{{ date('j F Y', strtotime($post->posted_at)) }}</time></p>

    <summary>{!! parsedown($post->summary) !!}</summary>

    {!! parsedown($post->body) !!}
</article>
@endsection

@push('script')
<script>
    // Get all img elements that are descendants of the post.
    let post = document.getElementById('post');
    let images = post.getElementsByTagName('img');

    // For each such img element, add a click listener that opens the image in a new tab.
    for (let i = 0; i < images.length; i++) {
        let image = images[i];
        image.addEventListener('click', function() {
            window.open(image.src, '_blank');
        });
    }
</script>
@endpush