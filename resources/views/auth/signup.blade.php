@extends('auth.main')

@section('content')

 <div class="h-full bg-white pb-10">
  
    <div class="mt-8 flex flex-col items-center mb-4">
        <h1 class="text-center text-xl capitalize mb-2"><span class="text-3xl text-indigo-900 font-bold">Sign Up</span> To Opportunity Board and Ace Your Career</h1>
        <div><a href=" {{ route('welcome') }} ">@include('components.logo')</a></div>
    </div>

      <div class="w-full flex flex-col items-center justify-center">
       <form method="POST" action="{{ route('auth.store') }}"  x-data="{ isSingningUp: false }" class="mb-2 w-80 max-w-screen-lg sm:w-96">
         <div class="sm:col-span-3">
             @csrf
         {{-- name --}}
          <div class="mt-2">
              <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name </label>
              <div class="">
                <input 
                value="{{old('name')}}"
                type="text"
                placeholder="enter your full name"
                name="name"
                id="name"
                class="outline-none block w-full rounded-md border-0 py-1.5 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
              @error('name')
                <p class="text-error text-sm">{{$message}}</p>
              @enderror
          </div>
             
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
                        class="outline-none block w-full rounded-md border-0 py-1.5 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    >
                  </div>
                    @error('email')
                      <p class="text-error text-sm">{{$message}}</p>
                    @enderror
               </div>

            {{-- phone number --}}
             <div class="mt-4">
              <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
             
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                    <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                </svg>
                            </div>
                            <input 
                            type="text" 
                            value="{{old('phone_number')}}"
                            name="phone_number"
                            id="phone_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="123-456-789" />
                        </div>
                @error('phone_number')
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
                class="outline-none block w-full rounded-md border-0 py-1.5 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 placeholder:text-gray-400 placeholder:text-xs focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
              @error('password')
                <p class="text-error text-sm">{{$message}}</p>
              @enderror
          </div>

            {{-- Confirm password --}}
          <div class="mt-4">
              <label for="confirm_password" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
              <div class="">
                <input 
                value="{{old('password_confirmation')}}"
                type="password"
                placeholder="re-type your password"
                name="password_confirmation"
                id="confirm_password"
                class="outline-none block w-full rounded-md border-0 py-1.5 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 placeholder:text-gray-400 placeholder:text-xs focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
              @error('password_confirmation')
                <p class="text-error text-sm">{{$message}}</p>
              @enderror
          </div>

        <!-- User Type -->
        <div class="mt-4 font-medium">
            <label> Register as a (company or student) </label>
            <div>
                <label>
                    <input  type="radio" name="user_type" value="student" class="font-medium">
                    {{ __('Student') }}
                </label>
                <label class="ml-4">
                    <input type="radio" name="user_type" value="company" class="font-medium">
                    {{ __('Company') }}
                </label>
            </div>
              @error('user_type')
                <p class="text-error text-sm">{{$message}}</p>
              @enderror
        </div>

        {{-- category --}}
        <div id="category" class="mt-4" style="display: none">
          <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
          <div class="w-full">
            <select  id="category" name="category" class="block outline-none w-full text-sm rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <option>Select Category</option>
              <option>Volunteer</option>
              <option>Internship</option>
              <option>Job</option>
            </select>
          </div>
            @error('category')
                <p class="text-error text-sm">{{$message}}</p>
            @enderror
        </div>

         {{-- submit --}}
         <button @click="isSingningUp = true" type="submit" class="flex items-center justify-center mt-4 w-full rounded-md bg-indigo-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 capitalize">
          <span class="pe-1">Sign Up</span>
          <span x-cloak x-show="isSingningUp" class="loading loading-dots loading-md"></span>
        </button>

        </div>
       </form>
         <p>already have an account?<a href=" {{ route('auth.login') }} " class="underline sm:no-underline font-medium hover:underline"> login here </a></p>
       </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
    const categoryField = document.getElementById('category');

    userTypeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'student') {
                categoryField.style.display = 'block';
            } else {
                categoryField.style.display = 'none';
            }
        });
    });
});
</script>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection