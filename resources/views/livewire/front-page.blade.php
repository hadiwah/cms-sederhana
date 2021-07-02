<div class="divide-y divide-gray-800" x-data="{ show:false }">
    <nav  class="bg-gray-900 px-3 py-2 flex items-center shadow-lg">
        
        <div class="h-12 w-full flex items-center p-2">
            <a href="{{ url('/')}}" class="flex items-center">
              <!--  <img class="h-8" src="{{ url('/img/logo.svg')}}"/> -->
                <x-jet-application-mark class="block h-8 w-auto" />
                <h1 class="text-white pl-6">Web Usaha</h1>
            </a>
        </div>
        <div class="flex justify-end sm:w-8/12">
        <!-- top navigation -->
            <ul class="hidden sm:flex text-gray-100 text-xs sm:text-left">
            @foreach ($topNavLinks as $item)
                <a href="{{ url('/'.$item->slug)}}">
                    <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                </a>
            @endforeach
            </ul>
        </div>
        <div>
            <button @click="show =! show"
            class="block sm:hidden p-2 justify-center rounded-md text-gray-200 items-center hover:text-gray-200 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-200 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': show, 'inline-flex': ! show }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! show, 'inline-flex': show }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>
    <div class="sm:flex sm:min-h-screen">
        <aside class="bg-gray-900 text-gray-700 divide-y divide-gray-700 divide-dashed sm:w-3/12 lg:w-2/12">
        <!-- desktop web view -->
            <ul class="hidden sm:block sm:text-left text-sm text-gray-200">
            @foreach ($sideBarLinks as $item)
                <a href="{{ url('/'.$item->slug)}}">
                    <li class="text-center cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                </a>
            @endforeach
            </ul>
        <!-- mobile web view -->
            <div :class="show ? 'block' : 'hidden' " class="pb-3 block sm:hidden divide-y divide-gray-700">
                <ul class="text-gray-200 text-sm">
                @foreach ($sideBarLinks as $item)
                    <a href="{{ url('/'.$item->slug)}}">
                        <li class=" cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                 @endforeach
                </ul>
        <!-- top navigation mobile view -->
                <ul class="text-gray-200 text-sm">
                @foreach ($topNavLinks as $item)
                <a href="{{ url('/'.$item->slug)}}">
                    <li class=" cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                </a>
                @endforeach
                </ul>
            </div>
        </aside>
        <main class="bg-gray-100 p-12 min-h-screen sm:w-9/12 lg:w-10/12">
            <section class="divide-y text-gray-900">
            <div x-text="show == true ? 'True':'False' "></div>
                <h1 class="text-3xl font-bold">
                {{ $title }}
                </h1>
                <article>
                    <div  class="mt-5 text-sm">
                    {!! $content !!}
                    </div>
                </article>
            </section>
            
        </main>
        
    </div>
    <footer class="bg-gray-900 text-gray-300 p-5 text-center">
        <div class="text-sm">
            <p>Created by @2021 Hadi Wahyudi</p>
        </div>
    </footer>
</div>