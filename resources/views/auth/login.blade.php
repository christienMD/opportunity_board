@extends('auth.main')

@section('content')

<div class="h-screen bg-gradient-to-t from-indigo-600 to-indigo-100 pt-8">
  
    <div class="flex flex-col items-center mb-4">
        <h1 class="text-center text-xl capitalize mb-2"><span class="text-3xl text-indigo-900 font-bold">LOGIN</span> To Opportunity Board</h1>
    </div>

      <div class="w-full flex flex-col items-center justify-center">
       <form method="POST" action="{{ route('auth.authenticate') }}" x-data="{ isLoggingIn: false }"  class="mb-2 w-80 max-w-screen-lg sm:w-96" novalidate>
        @csrf
         <div class="sm:col-span-3">
          {{-- email --}}
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                 <div class="">
                    <input
                        value="{{old('email')}}"
                        placeholder="enter your email"
                        id="email"
                        name="email"
                        type="email"
                        class="outline-none block w-full rounded-md border-0 py-1.5 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 placeholder:text-sm placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    >
                  </div>
                  @error('email')
                      <p class="text-error text-sm">{{$message}}</p>
                  @enderror
               </div>

            {{-- password --}}
          <div class="mt-4">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password </label>
              <div class="">
                <input 
                value="{{old('password')}}"
                type="password"
                placeholder="enter your password"
                name="password"
                id="name"
                class="outline-none block w-full rounded-md border-0 py-1.5 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 placeholder:text-gray-400 placeholder:text-sm focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
              @error('password')
                      <p class="text-error text-sm">{{$message}}</p>
             @enderror
          </div>


         {{-- submit --}}
         <button @click="isLoggingIn = true" type="submit" class="flex items-center justify-center mt-4 w-full rounded-md bg-indigo-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 capitalize">
         <span class="pe-1"> LogIn </span>
         <span x-cloak x-show="isLoggingIn" class="loading loading-dots loading-md"></span>
        </button>

        </div>
       </form>
         <p>don't have an account?<a href=" {{ route('auth.signup') }} " class="underline sm:no-underline font-medium hover:underline"> Sign Up here </a></p>

       </div>
    </div>

 <style>
    [x-cloak] { display: none !important; }
</style>
@endsection