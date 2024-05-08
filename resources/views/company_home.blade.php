<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
     @vite('resources/css/app.css')
    <title>Home - Company</title>
</head>
<body>

<div class="bg-white">
  <header class="absolute inset-x-0 top-0 z-50 border-b group">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5">
          @include('components._logo')
        </a>
      </div>
      <div class="flex lg:hidden">
       <!-- Button to open the mobile menu -->
        <button id="mobile-menu-open-button" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open mobile menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18"></path>
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="text-base font-semibold leading-6 text-gray-900 group-hover:text-indigo-600 hover:bg-gray-200 px-4 py-2 rounded-md">Product</a>
        <a href="#" class="text-base font-semibold leading-6 text-gray-900 group-hover:text-indigo-600 hover:bg-gray-200 px-4 py-2 rounded-md" >Features</a>
        <a href="#" class="text-base font-semibold leading-6 text-gray-900 group-hover:text-indigo-600 hover:bg-gray-200 px-4 py-2 rounded-md">Marketplace</a>
        <a href="#" class="text-base font-semibold leading-6 text-gray-900 group-hover:text-indigo-600 hover:bg-gray-200 px-4 py-2 rounded-md">Company</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center gap-1">
  {{-- showing the profile if user is logged in --}}
        @auth    
        <h2 class="font-semibold text-lg">{{auth()->user()->name}}</h2>
        <div class="dropdown dropdown-end">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 cursor-pointer text-indigo-700" tabindex="0">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>

        <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
          <li><a href="#" class="flex gap-2 capitalize text-sm font-medium text-gray-950 ring-0 focus:bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-700">
             <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>

            profile
          </a></li> 
          <li class="">
            <form method="POST" action="{{ route('auth.logout') }}" class="inline-block">
              @csrf
              <button type="submit" class="flex text-sm gap-2 capitalize font-medium leading-6 text-gray-950 ring-0 active:bg-transparent focus:bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-700">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                </svg>
               Sign Out
              </button>
            </form>
              
          </li>
        </ul>
      </div>
      @endauth
  
      </div>
    </nav>
    {{-- <!-- Mobile menu, show/hide based on menu open state. -->
    <div id="mobile-menu" class="lg:hidden hidden" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
              @include('components._logo')
          </a>
          <button id="mobile-menu-close-button" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Product</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>
            </div>
            <div class="py-6">
                <form method="POST" action="{{ route('auth.logout') }}" class="inline-block">
              @csrf
              <button type="submit" class="flex text-sm gap-2 capitalize font-medium leading-6 text-gray-950 ring-0 active:bg-transparent focus:bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
              </svg>
              Log Out
              </button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

    <!-- Mobile menu, show/hide based on menu open state. -->
<div id="mobile-menu" class="lg:hidden hidden" role="dialog" aria-modal="true">
  <!-- Background backdrop, show/hide based on slide-over state. -->
  <div class="fixed inset-0 z-50"></div>
  <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
    <div class="flex items-center justify-between">
      <a href="#" class="-m-1.5 p-1.5">
        <span class="sr-only">Your Company</span>
        @include('components._logo')
      </a>
      <button id="mobile-menu-close-button" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Close menu</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
     
    </div>
    <div class="mt-6 flow-root">
      <div class="-my-6 divide-y divide-gray-500/10">
        <div class="space-y-2 py-6">
          <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Product</a>
          <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
          <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
          <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>
        </div>
        <div class="py-6">
          <form method="POST" action="{{ route('auth.logout') }}" class="inline-block">
            @csrf
            <button type="submit" class="flex text-sm gap-2 capitalize font-medium leading-6 text-gray-950 ring-0 active:bg-transparent focus:bg-transparent">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
              </svg>
              Log Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Button to open the mobile menu -->
 <div class="hidden">
      <button id="mobile-menu-open-button" type="button" class=" -m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 lg:hidden">
        <span class="sr-only">Open mobile menu</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18"></path>
        </svg>
      </button>
  </div>
  </header>

  <div class="relative isolate px-6 lg:px-8">
    <div class="mx-auto max-w-2xl py-28 sm:py-28 lg:py-24">
      <div class="hidden sm:mb-8 sm:flex sm:justify-center">
      
      </div>
      <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Lorem ipsum dolor sit amet consectetur.</h1>
        <p class="mt-6 text-lg leading-8 text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="{{ route('company.create') }}" class="rounded-full bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 h-full flex gap-3">Create Opportunity
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </span>
          </a>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
<div class="bg-white">

  @include('components._com_opportunities')
  @include('components._toast')
</div>






<script>
  document.addEventListener("DOMContentLoaded", function() {
  const mobileMenu = document.querySelector('#mobile-menu');
  const mobileMenuCloseButton = document.querySelector('#mobile-menu-close-button');
  const mobileMenuOpenButton = document.querySelector('#mobile-menu-open-button');

  // Show mobile menu when hamburger button is clicked
  mobileMenuOpenButton.addEventListener('click', () => {
    mobileMenu.classList.remove('hidden');
  });

  // Hide mobile menu when close button is clicked
  mobileMenuCloseButton.addEventListener('click', () => {
    mobileMenu.classList.add('hidden');
  });

  // Hide mobile menu when a link is clicked
  const mobileMenuLinks = mobileMenu.querySelectorAll('a');
  mobileMenuLinks.forEach((link) => {
    link.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
    });
  });
});

</script>

</body>
</html>