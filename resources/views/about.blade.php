@extends('layouts.app')

@section('title', 'About')

@push('style')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('main')

<h2>The Author</h2>

<p>
    Hello. My name is Blaine, and Parvifolium is my workbench, sandbox, and notebook.
    I'm a researcher, data analyst, full-stack web developer, and role-playing game enthusiast.
</p>

<div class="contact">
    <ul>
        <li><a href="mailto:blaine.bush@gmail.com" class="has-icon"><i class="far fa-envelope"></i> <span>email</span></a></li>
        <li><a href="/portfolio" class="has-icon"><i class="fas fa-folder"></i> <span>Portfolio</span></a></li>
        <li><a href="/resume" class="has-icon"><i class="fas fa-id-card"></i> <span>Résumé/CV</span></a></li>
        <li><a href="https://www.linkedin.com/in/blainetbush/" class="has-icon"><i class="fab fa-linkedin-in"></i> <span>LinkedIn</span></a></li>
        <li><a href="https://github.com/blaine-t-bush" class="has-icon"><i class="fab fa-github"></i> <span>GitHub</span></a></li>
        <li><a href="https://www.npmjs.com/~blaine-t-bush" class="has-icon"><i class="fab fa-npm"></i> <span>npm</span></a></li>
    </ul>
</div>

<h2 class="page-title">The Code</h2>

<p>
    This site is built with <a href="https://laravel.com/">Laravel</a>.
    Fancier bits, like the <a href="/posts/whitehack-char-gen">Whitehack character generator</a>, are written in JavaScript or <a href="https://www.typescriptlang.org/">TypeScript</a>, with reactivity provided by <a href="https://vuejs.org/">Vue.js</a>.
    All style is hand-written in <a href="https://sass-lang.com/">SCSS</a>.
    Many icons come from <a href="https://fontawesome.com/">Font Awesome</a>, but some (like the favicon) are hand-made in <a href="https://inkscape.org/">Inkscape</a> or <a href="https://www.gimp.org/">GIMP</a>.
</p>

<h2>The Name</h2>

<p>
    Parvifolium is the name of a number of plant species, including the
    <a href="https://en.wikipedia.org/wiki/Vaccinium_parvifolium">red huckleberry</a> (<em>Vaccinium parvifolium</em>)
    which is common in the Pacific Northwest.
    The name is derived from Latin <em>parvus</em>, meaning small, and <em>folium</em>, meaning leaf.
</p>

<img class="post border" src="{{ asset('img/posts/NSRW_Huckleberry.png') }}" alt="">

<p>
    <em>Folium</em> can also refer to the leaf of a book.
    In that sense, a small leaf is a bite-sized amount of reading.
    That will have to do, as to my knowledge there is no Latin word for blog.
</p>

@endsection