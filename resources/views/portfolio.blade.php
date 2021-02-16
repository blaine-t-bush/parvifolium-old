@extends('layouts.app')

@section('title', 'Portfolio')

@push('style')
<link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
@endpush

@section('main')

<h1>Portfolio</h1>

<div class="contact">
    <ul>
        <li><a href="mailto:blaine.bush@gmail.com" class="has-icon"><i class="far fa-envelope"></i> <span>email</span></a></li>
        <li><a href="/resume" class="has-icon"><i class="fas fa-id-card"></i> <span>Résumé/CV</span></a></li>
        <li><a href="https://www.linkedin.com/in/blainetbush/" class="has-icon"><i class="fab fa-linkedin-in"></i> <span>LinkedIn</span></a></li>
        <li><a href="https://github.com/blaine-t-bush" class="has-icon"><i class="fab fa-github"></i> <span>GitHub</span></a></li>
        <li><a href="https://www.npmjs.com/~blaine-t-bush" class="has-icon"><i class="fab fa-npm"></i> <span>npm</span></a></li>
    </ul>
</div>

<div class="projects">
    <div class="project">
        <a href="/posts/folia">
            <div class="img-wrapper">
                <img src="/img/portfolio/folia_preview.png">
            </div>
            <h2>Folia</h2>
            <div class="description">
                A real-time message board written in Laravel and Vue.
                Create an account or use a pre-existing one—no need for verification.
                Upload a custom profile picture or select from a list.
                Post your own thoughts or reply to others'.
            </div>
        </a>
    </div>

    <div class="project">
        <a href="/posts/whitehack-char-gen">
            <div class="img-wrapper">
                <img src="/img/portfolio/whitehack_char_gen_preview.jpg">
            </div>
            <h2>Whitehack Character Generator</h2>
            <div class="description">
                A random character generator for <em>Whitehack</em>, written in JavaScript and Vue.
                Create new characters or NPCs and level them up.
                Vocations, affiliations, weapons, spells, and more are all automatically populated.
            </div>
        </a>
    </div>

    <div class="project">
        <a href="/posts/osrs-slayer-tasks">
            <div class="img-wrapper">
                <img src="/img/portfolio/osrs_slayer_tasks_preview.png">
            </div>
            <h2>OSRS Slayer Calculator</h2>
            <div class="description">
                A skill utility for <em>Old School RuneScape</em>, written in TypeScript and Vue.
                Input your levels, quests, and unlocks, and get a list of all possible slayer tasks
                along with their respective probability of assignment.
            </div>
        </a>
    </div>

    <div class="project">
        <a href="/posts/runelite-level-scanner">
            <div class="img-wrapper">
                <img src="/img/portfolio/runelite_level_scanner_preview.png">
            </div>
            <h2>RuneLite Level Scanner</h2>
            <div class="description">
                A file utility for RuneLite, written in JavaScript with Chart.js.
                Upload the automatically-generated level-up screenshots taken by RuneLite,
                and the utility will display your levels over time.
            </div>
        </a>
    </div>
</div>

@endsection