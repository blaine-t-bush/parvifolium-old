# title
Folia

# posted_at
2021-02-11T10:23:00+00:00

# category
web

# summary
A real-time message board built with Laravel and Vue. Check it out! You can use a guest account or make one quickly, without verification.

# body
[Visit the site](https://folia.parvifolium.net) or check out the repo on <a href="https://github.com/blaine-t-bush/folia" class="has-icon"><i class="fab fa-github"></i> <span>GitHub</span></a>.

## Tech Stack
| Feature | Tool |
| --- | --- |
| Backend | Laravel |
| Broadcasting | Pusher & Laravel Echo |
| Frontend | Vue.js |
| Style | SCSS |
| Images | Inkscape |

## Features
- Custom authentication and registration
- User profiles with custom avatar uploads
- Posts, replies, and reactions
- Form validation
- Error alerts on API failure
- Completely asynchronous; posts, replies, and reactions update in real time
- Bots! New posts and replies are made every minute

## Lessons Learned
**Make Things Easy.** I'm glad that I was able to write my own authentication scheme, and I did so because I wanted something lightweight. This project is just a demonstration, so I don't want users to have to provide their email or use two-factor authentication just to check it out. But ultimately, it would've taken less time to use a built-in authentication library like [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze) and simply disable unnecessary features, rather than starting from scratch.

![text](/img/portfolio/folia_preview.png)

**API-First Approach.** Initially, the project didn't use Vue.js, and didn't have the asynchronous frontend. Creating a new post would refresh the page, and you'd need to refresh the page to see others' new posts. That doesn't make for a smooth experience, so I switched to using Laravel purely as an authentication system and API. Even if I had decided that a non-asynchronous approach was the right way, it would still have been good practice to separate controller action and display in a testable way.

**Mobile Photos Are Weird.** It turns out that many mobile photos have EXIF data describing their orientation. In order to display them properly, that data needs to be taken into account. [This article](https://medium.com/thetiltblog/fixing-rotated-mobile-image-uploads-in-php-803bb96a852c) describes the problem, as well as the solution I used with Intervention, an image manipulation package for PHP.

**Lots and Lots of Small Things.** Too many to list here, so I'll just stick to the ones that were the coolest... or saved me the most hair.
- Use `php artisan queue:listen`, not `queue:work`, in development. This forces Laravel's scheduler to automatically check for changes to events, rather than requiring a restart. I spent a lot of frustrated time trying to figure out why my updates weren't taking effect.
- Big separate projects should be on a separate domain or subdomain. This website is also written in Laravel, and initially both it and Folia were part of the same project. That quickly became messy, but luckily setting up a subdomain for Laravel projects is easy.