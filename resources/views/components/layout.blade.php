<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <title>{{ config('app.name') }}</title>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>

<body class="h-full">
  <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
  <div class="min-h-full">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center">
          <div class="flex items-center flex-1">
            <div class="shrink-0">
              <h6 class="text-xs font-bold text-white">
                <a href="/" class="text-white text-2xl font-bold">{{ '<Jobsity />' }}</a>
              </h6>
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                @auth

                  <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
                  <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                @endauth

              </div>
            </div>
            <div class="hidden md:block ml-auto">
              <div class="flex items-baseline spaxe-x-4">
                @guest
                  <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
                  <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                @endguest

                @auth
                  <x-nav-link href="/profile" :active="request()->is('profile')">Profile</x-nav-link>
                  <form method="POST" action="/logout">
                    @csrf
                    <x-form-button>Logout</x-form-button>
                  </form>
                @endauth
              </div>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden ">
            <!-- Mobile menu button -->
            <button type="button"
              class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
              aria-controls="mobile-menu" aria-expanded="true" id="mobile-menu-toggle">
              <span class="absolute -inset-0.5"></span>
              <span class="sr-only">Open main menu</span>
              <!-- Menu open: "hidden", Menu closed: "block" -->
              <svg class="block size-6 menu-icon-open" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" aria-hidden="false" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
              <!-- Menu open: "block", Menu closed: "hidden" -->
              <svg class="hidden size-6 menu-icon-close" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="md:hidden hidden" id="mobile-menu">
        <div class="space-y-2 px-2 pt-2 pb-3 sm:px-3">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <x-nav-link href="/">Home</x-nav-link>
          <x-nav-link href="/about">About</x-nav-link>
          <x-nav-link href="/contact" :active="true">Contact</x-nav-link>
          @guest
            <div class="border-t border-gray-700 pt-2 mt-2">

              <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
              <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>

            </div>
          @endguest
        </div>
      </div>
    </nav>

    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
        @if (request()->is('jobs'))
          <x-button href="/jobs/create">Create Job</x-button>
        @endif
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        {{ $slot }}
      </div>
    </main>
  </div>
  <!-- jQuery and Toastr JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  {{-- * Toastr --}}
  <x-toastr />
</body>

</html>
