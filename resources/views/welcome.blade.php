<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
    <nav x-data="{ open: false }">
        <div class="bg-indigo-500">
            <div class="flex flex-col sm:flex-row">
                <div class="flex items-center justify-between px-4 py-2 sm:py-0 border-b border-indigo-400 sm:border-b-0">
                    <div>
                        <a href="#" class="uppercase font-semibold text-indigo-100 hover:text-white text-3xl">Brand</a>
                    </div>
                    <div>
                        <button @click="open = ! open" class="block sm:hidden justify-center p-2 rounded-md text-indigo-100 hover:text-white hover:bg-indigo-500 focus:outline-none focus:bg-indigo-100 focus:text-indigo-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div :class="{'block': open, 'hidden': ! open}" class="sm:flex flex-col sm:flex-row justify-between w-full py-2">
                        <div class="flex flex-col sm:flex-row border-b border-indigo-500 sm:border-b-0">
                            <a href="#" class="block px-4 py-2 text-indigo-100 hover:text-white">Galeri</a>
                            <a href="#" class="block px-4 py-2 text-indigo-100 hover:text-white">Blog</a>
                            <a href="#" class="block px-4 py-2 text-indigo-100 hover:text-white">About</a>
                        </div>
                        @if (Route::has('login'))
                        <div class="flex flex-col sm:flex-row">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-indigo-100 hover:text-white">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-blue-100 hover:text-white">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block px-4 py-2 text-blue-100 hover:text-white">Register</a>
                                @endif
                            @endauth
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </nav>
    <main>
    <div
        class="relative pt-16 pb-32 flex content-center items-center justify-center"
        style="min-height: 100vh;"
      >
        <div
          class="absolute top-0 w-full h-full bg-center bg-cover"
          style='background-image: url("{{asset('./image/background-image.png')}}");'
        >
          <span
            class="w-full h-full absolute opacity-75 bg-black"
          ></span>
        </div>
        <div class="container relative mx-auto">
          <div class="items-center flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
              <div class="pr-12">
                <h1 class="text-white font-semibold text-5xl">
                  Your story starts with us.
                </h1>
                <p class="mt-4 text-lg text-gray-300">
                  This is a simple example of a Landing Page you can build using
                  Tailwind Starter Kit. It features multiple CSS components
                  based on the Tailwindcss design system.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
        <div class="py-12 bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white pb-2 hover:shadow-lg rounded-xl grid grid-cols-1 sm:grid-cols-2 sm:px-8 sm:py-12 sm:gap-x-8 md:py-16">
                        <div class="relative z-10 col-start-1 row-start-1 px-4 pt-40 pb-3 bg-gradient-to-t from-black sm:bg-none">
                            <p class="text-sm font-medium text-white sm:mb-1 sm:text-gray-500">Entire house</p>
                            <h2 class="text-xl font-semibold text-white sm:text-2xl sm:leading-7 sm:text-black md:text-3xl">Beach House in Collingwood</h2>
                        </div>
                        <div class="col-start-1 row-start-2 px-4 sm:pb-16">
                            <div class="flex items-center text-sm font-medium my-5 sm:mt-2 sm:mb-4">
                            <svg width="20" height="20" fill="currentColor" class="text-indigo-600">
                                <path d="M9.05 3.691c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.372 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118l-2.8-2.034c-.784-.57-.381-1.81.587-1.81H7.03a1 1 0 00.95-.69L9.05 3.69z" />
                            </svg>
                            <div class="ml-1">
                                <span class="text-black">4.94</span>
                                <span class="sm:hidden md:inline">(128)</span>
                            </div>
                            <div class="text-base font-normal mx-2">·</div>
                            <div>Collingwood, Ontario</div>
                            </div>
                            <hr class="w-16 border-gray-300 hidden sm:block">
                        </div>
                        <div class="col-start-1 row-start-3 space-y-3 px-4">
                            <p class="flex items-center text-black text-sm font-medium">
                            <img src="/kevin-francis.jpg" alt="" class="w-6 h-6 rounded-full mr-2 bg-gray-100">
                            Hosted by Kevin Francis
                            </p>
                            <button type="button" class="bg-indigo-100 text-indigo-700 text-base font-semibold px-6 py-2 rounded-lg">Check availability</button>
                        </div>
                        <div class="col-start-1 row-start-1 flex sm:col-start-2 sm:row-span-3">
                            <div class="w-full grid grid-cols-3 grid-rows-2 gap-2">
                            <div class="relative col-span-3 row-span-2 md:col-span-2">
                                <img src="{{asset('./image/background-image.png')}}" alt="" class="absolute inset-0 w-full h-full object-cover bg-gray-100 sm:rounded-lg" />
                            </div>
                            <div class="relative hidden md:block">
                                <img src="{{asset('./image/background-image.png')}}" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg bg-gray-100" />
                            </div>
                            <div class="relative hidden md:block">
                                <img src="{{asset('./image/background-image.png')}}" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg bg-gray-100" />
                            </div>
                            </div>
                        </div>
                    </div>
                <br>
                <section class="bg-white hover:shadow-lg px-4 sm:px-6 lg:px-4 xl:px-6 pt-4 pb-4 sm:pb-6 lg:pb-4 xl:pb-6 space-y-4 rounded-xl">
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg leading-6 font-medium text-black">Projects</h2>
                        <button class="hover:bg-blue-200 hover:text-blue-800 group flex items-center rounded-md bg-blue-100 text-blue-600 text-sm font-medium px-4 py-2">
                        <svg class="group-hover:text-blue-600 text-blue-500 mr-2" width="12" height="20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                        </svg>
                        New
                        </button>
                    </header>
                    <form class="relative">
                        <svg width="20" height="20" fill="currentColor" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                        </svg>
                        <input class="focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none w-full text-sm text-black placeholder-gray-500 border border-gray-200 rounded-md py-2 pl-10" type="text" aria-label="Filter projects" placeholder="Filter projects" />
                    </form>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-4">
                        <li x-for="item in items">
                        <a :href="item.url" class="hover:bg-blue-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200">
                            <dl class="grid sm:block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
                            <div>
                                <dt class="sr-only">Title</dt>
                                <dd class="group-hover:text-white leading-6 font-medium text-black">
                                {item.title}
                                </dd>
                            </div>
                            <div>
                                <dt class="sr-only">Category</dt>
                                <dd class="group-hover:text-blue-200 text-sm font-medium sm:mb-4 lg:mb-0 xl:mb-4">
                                {item.category}
                                </dd>
                            </div>
                            <div class="col-start-2 row-start-1 row-end-3">
                                <dt class="sr-only">Users</dt>
                                <dd class="flex justify-end sm:justify-start lg:justify-end xl:justify-start -space-x-2">
                                <img x-for="user in item.users" :src="user.avatar" :alt="user.name" width="48" height="48" class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white" />
                                </dd>
                            </div>
                            </dl>
                        </a>
                        </li>
                        <li class="hover:shadow-lg flex rounded-lg">
                        <a href="/new" class="hover:border-transparent hover:shadow-xs w-full flex items-center justify-center rounded-lg border-2 border-dashed border-gray-200 text-sm font-medium py-4">
                            New Project
                        </a>
                        </li>
                    </ul>
                </section>
                <br>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <figure class="hover:shadow-lg md:flex bg-white rounded-xl p-8 md:p-0">
                    <img class="w-32 h-32 md:w-48 md:h-auto md:rounded-none rounded-full mx-auto" src="{{asset('./image/background-image.png')}}" alt="" width="384" height="512">
                    <div class="pt-6 md:p-8 text-center md:text-left space-y-4">
                        <blockquote>
                        <p class="text-lg font-semibold">
                            “Tailwind CSS is the only framework that I've seen scale
                            on large teams. It’s easy to customize, adapts to any design,
                            and the build size is tiny.”
                        </p>
                        </blockquote>
                        <figcaption class="font-medium">
                        <div class="text-cyan-600">
                            Sarah Dayan
                        </div>
                        <div class="text-gray-500">
                            Staff Engineer, Algolia
                        </div>
                        </figcaption>
                    </div>
                    </figure>
                    <figure class="hover:shadow-lg md:flex bg-white rounded-xl p-8 md:p-0">
                    <img class="w-32 h-32 md:w-48 md:h-auto md:rounded-none rounded-full mx-auto" src="{{asset('./image/background-image.png')}}" alt="" width="384" height="512">
                    <div class="pt-6 md:p-8 text-center md:text-left space-y-4">
                        <blockquote>
                        <p class="text-lg font-semibold">
                            “Tailwind CSS is the only framework that I've seen scale
                            on large teams. It’s easy to customize, adapts to any design,
                            and the build size is tiny.”
                        </p>
                        </blockquote>
                        <figcaption class="font-medium">
                        <div class="text-cyan-600">
                            Sarah Dayan
                        </div>
                        <div class="text-gray-500">
                            Staff Engineer, Algolia
                        </div>
                        </figcaption>
                    </div>
                    </figure>
                </div>
            </div>
        </div>
    </main>
    <footer class="relative bg-gray-300 pt-8 pb-6">
      <div
        class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
        style="height: 80px; transform: translateZ(0px);"
      >
      </div>
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <h4 class="text-3xl font-semibold">Let's keep in touch!</h4>
            <h5 class="text-lg mt-0 mb-2 text-gray-700">
              Find us on any of these platforms, we respond 1-2 business days.
            </h5>
            <div class="mt-6">
              <button
                class="bg-white text-blue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fab fa-twitter"></i></button
              ><button
                class="bg-white text-blue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fab fa-facebook-square"></i></button
              ><button
                class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fab fa-dribbble"></i></button
              ><button
                class="bg-white text-gray-900 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fab fa-github"></i>
              </button>
            </div>
          </div>
          <div class="w-full lg:w-6/12 px-4">
            <div class="flex flex-wrap items-top mb-6">
              <div class="w-full lg:w-4/12 px-4 ml-auto">
                <span
                  class="block uppercase text-gray-600 text-sm font-semibold mb-2"
                  >Useful Links</span
                >
                <ul class="list-unstyled">
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >About Us</a
                    >
                  </li>
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >Blog</a
                    >
                  </li>
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >Github</a
                    >
                  </li>
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >Free Products</a
                    >
                  </li>
                </ul>
              </div>
              <div class="w-full lg:w-4/12 px-4">
                <span
                  class="block uppercase text-gray-600 text-sm font-semibold mb-2"
                  >Other Resources</span
                >
                <ul class="list-unstyled">
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >MIT License</a
                    >
                  </li>
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >Terms &amp; Conditions</a
                    >
                  </li>
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >Privacy Policy</a
                    >
                  </li>
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm"
                      href="#"
                      >Contact Us</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <hr class="my-6 border-gray-400" />
        <div
          class="flex flex-wrap items-center md:justify-between justify-center"
        >
          <div class="w-full md:w-4/12 px-4 mx-auto text-center">
            <div class="text-sm text-gray-600 font-semibold py-1">
              Copyright © 2019 
              <a
                href="#"
                class="text-gray-600 hover:text-gray-900"
                >Creative Tim</a
              >.
            </div>
          </div>
        </div>
      </div>
    </footer>
        @livewireScripts
    </body>
</html>
