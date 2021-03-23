@extends('layouts.app')

@section('title', 'Résumé')

@push('style')
<link rel="stylesheet" href="{{ asset('css/resume.css') }}">
@endpush

@section('main')

<div class="resume">
    <h1>Blaine Bush</h1>

    <div class="contact">
        <ul>
            <li><a href="mailto:blaine.bush@gmail.com" class="has-icon"><i class="far fa-envelope"></i> <span>email</span></a></li>
            <li><a href="/portfolio" class="has-icon"><i class="fas fa-folder"></i> <span>Portfolio</span></a></li>
            <li><a href="https://www.linkedin.com/in/blainetbush/" class="has-icon"><i class="fab fa-linkedin-in"></i> <span>LinkedIn</span></a></li>
            <li><a href="https://github.com/blaine-t-bush" class="has-icon"><i class="fab fa-github"></i> <span>GitHub</span></a></li>
            <li><a href="https://www.npmjs.com/~blaine-t-bush" class="has-icon"><i class="fab fa-npm"></i> <span>npm</span></a></li>
        </ul>
    </div>

    <p>
        Hi.
    </p>

    <p>
        I'm a researcher, data analyst, and full-stack web developer.
    </p>

    <p>
        I love working with data and building websites.
        I do things the right way: plan carefully, design precisely, and test thoroughly.
        I use the right tool for the job. When I don't know it, I learn it.
        I love teaching others and learning from them in turn.
    </p>

    <p>
        If you think I could be a good fit for your team,
        contact me via <a href="mailto:blaine.bush@gmail.com">email</a> or <a href="https://www.linkedin.com/in/blainetbush/">LinkedIn</a>.
    </p>

    <div class="skills">
        <h2>Skills</h2>
    
        <div class="skill-group">
            <h3>Web</h3>
            <ul>
                <li>HTML</li>
                <li>CSS/SCSS</li>
                <li><mark>JavaScript</mark>, TypeScript, Vue.js, Chai/Mocha</li>
                <li>Webpack, Babel, npm</li>
                <li>PHP, <mark>Laravel</mark>, phpunit</li>
            </ul>
        </div>
        
        <div class="skill-group">
            <h3>Data</h3>
            <ul>
                <li>Python</li>
                <li>SQL (MySQL, <mark>SQL Server</mark>)</li>
                <li>Excel, PowerQuery</li>
                <li>PowerBI</li>
                <li>SPSS</li>
            </ul>
        </div>
        
        <div class="skill-group">
            <h3>Technical</h3>
            <ul>
                <li>Linux</li>
                <li>Git</li>
            </ul>
        </div>

        <div class="skill-group">
            <h3>Soft</h3>
            <ul>
                <li>Critical thinking & quantitative problem solving</li>
                <li>Teaching technical concepts approachably</li>
                <li>Attention to detail & adaptability</li>
            </ul>
        </div>
    </div>

    <div class="experiences">
        <h2>Experience</h2>

        <div class="experience-group">
            <h3>Junior Research Engineer</h3>
            <div class="experience-details">
                <span>MAGNA Global</span>
                <span>Jan 2018 – Nov 2020</span>
            </div>
            <ul>
                <li>Contributed to the development and design of scientific <mark>thought leadership research projects</mark> in advertising.</li>
                <li><mark>Full-stack web development</mark> to simulate popular apps/platforms for advertising studies.</li>
                <li>Designed and programmed <mark>custom consumer surveys</mark>.</li>
                <li><mark>ETL</mark> of data from multiple sources: surveys, website interactions, and third-party.</li>
                <li>Delivered <mark>statistical analyses</mark> and business insights that influenced the advertising industry.</li>
                <li><mark>Presented research findings</mark> to clients, management, and Advertising Research Foundation conventions.</li>
            </ul>
        </div>

        <div class="experience-group">
            <h3>Graduate Student Researcher</h3>
            <div class="experience-details">
                <span>University of California, Davis</span>
                <span>Sep 2015 – Sep 2017</span>
            </div>
            <ul>
                <li>Developed Python script for automated logging of data across multiple experimental systems.</li>
                <li>Presented original work at 2017 American Physical Society March Meeting hosted in New Orleans, LA.</li>
                <li>Joint author on four experimental condensed matter physics papers in Physical Review B and Physica B.</li>
                <li>Trained colleagues in Python programming, pressure cell use, and nuclear magnetic resonance techniques.</li>
                <li>Completed training at National High Magnetic Field Lab in experimental techniques and noise suppression.</li>
            </ul>
        </div>

        <div class="experience-group">
            <h3>Graduate Teaching Assistant</h3>
            <div class="experience-details">
                <span>University of California, Davis</span>
                <span>Sep 2015 – June 2017</span>
            </div>
            <ul>
                <li>Taught algebra-based, calculus-based, and computational (C++) physics to undergraduate students in a collaborative classroom environment.</li>
                <li>Completed training on active-engagement teaching methods in physics.</li>
                <li>Teaching effectiveness rated 4.5 out of 5 across 202 students.</li>
                <li>Sensitivity to student difficulties rated 4.6 out of 5 across 83 students.</li>
            </ul>
        </div>

        <div class="experience-group">
            <h3>Undergraduate Research Assistant</h3>
            <div class="experience-details">
                <span>University of California, Davis</span>
                <span>Jan 2013 – Sep 2015</span>
            </div>
            <ul>
                <li>Designed and implemented automatic pressure measurement device using Python, spectrometer, microcontroller, and laser.</li>
                <li>Calculated exact properties for a physical model of materials using Python and Mathematica.</li>
                <li>Presented original work at 2013 American Physical Society Far West Section hosted in Sonoma, CA.</li>
            </ul>
        </div>
    </div>

    <div class="experiences">
        <h2>Education</h2>

        <div class="experience-group">
            <h3>B.S. Physics</h3>
            <div class="experience-details">
                <span>University of California, Davis</span>
                <span>Sep 2011 – June 2015</span>
            </div>
            <ul>
                <li>Graduated <mark><em>summa cum laude</em> (highest honors)</mark>.</li>
                <li>Honors thesis: <em>Calculating Properties of the Heavy Fermions from the Anderson Model</em>.</li>
                <li>Regents Scholarship recipient and Integrated Studies Honors Program member.</li>
                <li>Nominated for American Physical Society’s LeRoy Apker Undergraduate Achievement Award.</li>
            </ul>
        </div>
    </div>
</div>

@endsection