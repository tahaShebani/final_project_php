<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body>
@php
    $navLinks = [
        'Home' => '/',
    ];

    if (auth()->check()) {
        $navLinks['Dashboard'] = route('dashboard');
        $navLinks['Profile'] = route('profile.edit');
        $navLinks['Logout'] = route('logout');
    } else {
        $navLinks['Login'] = route('login');
        $navLinks['Register'] = route('register');
    }
@endphp

<x-navbar brand="LaravelDev" :links="$navLinks"></x-navbar>

<main>
                {{ $slot }}
</main>
<x-footer />
  </body>
</html>
