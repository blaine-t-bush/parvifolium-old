@extends('layouts.app')

@section('title', 'Posts')

@push('style')
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endpush

@section('main')
@foreach ($posts as $post)
    <article>
        <a href="{{ route('post', ['id' => $post->id]) }}">
            @if ($post->category == 'rpg')
                <i class="fas fa-dice" aria-hidden="true"></i>
            @elseif ($post->category == 'game')
                <i class="fas fa-gamepad" aria-hidden="true"></i>
            @elseif ($post->category == 'web')
                <i class="fa fa-code" aria-hidden="true"></i>
            @elseif ($post->category == 'code')
                <i class="fa fa-terminal" aria-hidden="true"></i>
            @else
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            @endif

            <h2>{!! parsedown($post->title, true) !!}</h2>

            <p class="posted-at">Posted on <time datetime="{{ $post->posted_at }}">{{ date('j F Y', strtotime($post->posted_at)) }}</time></p>

            <summary>{!! parsedown($post->summary) !!}</summary>
        </a>
    </article>
@endforeach

<aside>
    <h3>Categories</h3>
    <div class="categories">
        <a href="/posts"><i class="fa fa-pencil-square-o @if(!isset($category)) selected @endif" aria-hidden="true"></i></a> <a href="/posts"><span @if(!isset($category)) class="selected" @endif>All</span></a>
        <a href="/posts/category/rpg"><i class="fas fa-dice @if(isset($category) and $category == 'rpg') selected @endif" aria-hidden="true"></i></a> <a href="/posts/category/rpg"><span @if(isset($category) and $category == 'rpg') class="selected" @endif>RPG/Tabletop</span></a>
        <a href="/posts/category/game"><i class="fas fa-gamepad @if(isset($category) and $category == 'game') selected @endif" aria-hidden="true"></i></a> <a href="/posts/category/game"><span @if(isset($category) and $category == 'game') class="selected" @endif>Video games</span></a>
        <a href="/posts/category/web"><i class="fa fa-code @if(isset($category) and $category == 'web') selected @endif" aria-hidden="true"></i></a> <a href="/posts/category/web"><span @if(isset($category) and $category == 'web') class="selected" @endif>Web dev</span></a>
        <a href="/posts/category/code"><i class="fa fa-terminal @if(isset($category)and $category == 'code') selected @endif" aria-hidden="true"></i></a> <a href="/posts/category/code"><span @if(isset($category) and $category == 'code') class="selected" @endif>Programming</span></a>
    </div>
</aside>
@endsection