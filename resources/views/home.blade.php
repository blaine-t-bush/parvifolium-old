@extends('layouts.app')

@section('title', 'Home')

@push('style')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('main')

<pre id="code-compact"><span class="define">function</span> <span class="function">getTargetPages</span>(<span class="variable">purposes</span>)
{
  <span class="define">let</span> <span class="variable">pages</span> = [];

  <span class="keyword">if</span> (<span class="variable">purposes</span>.<span class="function">includes</span>(<span class="string">"blog"</span>))
  {
    <span class="comment">// Tabletop and code stuff</span>
    <span class="variable">pages</span>.<span class="function">push</span>(<span><a href="/posts" class="shimmer shimmer-delay-1">"/posts"</a></span>);
  }

  <span class="keyword">if</span> (<span class="variable">purposes</span>.<span class="function">includes</span>(<span class="string">"career"</span>)))
  {
    <span class="comment">// My projects</span>
    <span class="variable">pages</span>.<span class="function">push</span>(<span><a href="/portfolio" class="shimmer shimmer-delay-2">"/portfolio"</a></span>);

    <span class="comment">// CV</span>
    <span class="variable">pages</span>.<span class="function">push</span>(<span><a href="/resume" class="shimmer shimmer-delay-3">"/resume"</a></span>);
  }
    
  <span class="keyword">return</span> <span class="variable">pages</span>;
}</pre>

<pre id="code"><span class="define">function</span> <span class="function">getTargetPages</span>(<span class="variable">visitPurposes</span>) {
    <span class="define">let</span> <span class="variable">targetPages</span> = [];
    
    <span class="keyword">if</span> (<span class="variable">visitPurposes</span>.<span class="function">includes</span>(<span class="string">"blog"</span>)) {
        <span class="variable">targetPages</span>.<span class="function">push</span>(<span><a href="/posts" class="shimmer shimmer-delay-1">"/posts"</a></span>); <span class="comment">// Tabletop and code stuff</span>
    }
    
    <span class="keyword">if</span> (<span class="variable">visitPurposes</span>.<span class="function">includes</span>(<span class="string">"career"</span>))) {
        <span class="variable">targetPages</span>.<span class="function">push</span>(<span><a href="/portfolio" class="shimmer shimmer-delay-2">"/portfolio"</a></span>); <span class="comment">// My projects</span>
        <span class="variable">targetPages</span>.<span class="function">push</span>(<span><a href="/resume" class="shimmer shimmer-delay-3">"/resume"</a></span>); <span class="comment">// CV</span>
    }
    
    <span class="keyword">return</span> <span class="variable">targetPages</span>;
}</pre>


@endsection