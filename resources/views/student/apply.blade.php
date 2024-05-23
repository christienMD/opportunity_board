@extends('auth.main')

@section('content')

 <div class="h-full bg-white pb-10">
  
    <div class="mt-8 flex flex-col md:grid grid-cols-12 items-center mb-4">
        <h1 class="text-center text-xl capitalize mb-2 col-span-12 md:col-span-5"><span class="text-3xl text-indigo-900 font-bold">Apply</span> for this opportunity</h1>
    </div>
 
            <div class="grid grid-cols-12">
                <div class="w-full flex flex-col items-center justify-center col-span-12 md:col-span-5">
                <form method="POST" action="{{ route('student.submit', $opportunity->id) }}"   x-data="{ isApplying: false, cvSizeError: false }"class="mb-2 w-80 max-w-screen-lg sm:w-96" enctype="multipart/form-data" novalidate>
                    <div class="sm:col-span-3">
                        @csrf

                        {{-- opportunity id --}}
                        <input type="hidden" name="opportunity_id" value="{{ $opportunity->id }}">

                                {{-- name --}}
                                <div class="mt-2">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name </label>
                                    <div class="">
                                        <input 
                                        value="{{ auth()->check() ? old('name', optional($user)->name) : '' }}"
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
                                    value="{{old('email', optional($user)->email)}}"
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
                                        value="{{old('phone_number', optional($user)->phone_number)}}"
                                        type="text" 
                                        name="phone_number"
                                        id="phone_number" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="123-456-789" 
                                        />
                                    </div>
                                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">put a phone number that matches the format.</p>
                                    @error('phone_number')
                                    <p class="text-error text-sm">{{$message}}</p>
                                @enderror
                            </div>

                        {{-- message       --}}
                        <div class="mt-4">
                            <label for="message" class='block text-sm font-medium leading-6 text-gray-900'>
                        Briefly tell us why you are fit for this position
                            </label>
                            <textarea
                            onfocus="moveCursorToStart(this)"
                            placeholder="brief message"
                            class="mt-1 p-2 w-full h-28 border border-1 outline-none rounded-md placeholder:text-xs focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                            id="message"
                            name="message"
                            >
                          {{ old('description')}}
                         </textarea>
                            @error('message')
                                <p class="text-error text-base">{{$message}}</p>
                            @enderror
                        </div>

                        {{-- CV upload --}}
                        <div class="mt-4">
                            <label for="cv" class="block text-sm font-medium leading-6 text-gray-900">Upload CV (PDF only)</label>
                            
                            <input type="file" id="cv" name="cv_upload" accept="application/pdf" class="block w-full text-sm text-gray-900 file:bg-gray-50 file:border-gray-300 file:px-8 file:py-3 file:rounded-md file:text-sm file:font-semibold file:border-0 file:text-gray-900 hover:file:bg-gray-100">
                            
                            @error('cv_upload')
                                <p class="text-error text-sm">{{ $message }}</p>
                            @enderror
                        </div>



                    {{-- submit --}}
                    <button @click="isApplying = true" type="submit" class="flex items-center justify-center mt-4 w-full rounded-md bg-indigo-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 capitalize">
                    <span class="pe-1">Apply</span>
                    <span x-cloak x-show="isApplying" class="loading loading-dots loading-md"></span>
                    </button>

                    </div>
                </form>
                </div>
            <div class="col-span-12 md:col-span-7">
                    <div class="flex gap-3">
                        <div class="rounded-xl h-36 w-40 flex justify-center items-center"> 
                                    {{--image--}}
                            <img src="{{ $opportunity->img_url }}" alt="Image for {{ $opportunity->title }}" class="rounded-xl h-36 w-40 object-cover">
                        </div>
                        <div class="flex-1">
                        <div class="flex flex-col gap-3">
                        <h2 class="font-bold capitalize text-2xl md:text-3xl text-gray-800">{{ $opportunity->title }}</h2>
                          <div class="flex gap-4">

                                <div class="bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-indigo-400 border border-indigo-400">{{ $opportunity->category }}</div>
                                <div class="text-sm font-medium italic">
                               posted 
                               <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                </svg>
                               {{ $opportunity->published_at->diffForHumans() }}</span></div> 
                            </div>
                            <p class="text-base mt-2">
                            {{ $opportunity->description }}
                        </p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  const loadingSpan = document.querySelector('.loading');
  const errorMessages = document.querySelectorAll('.text-error');

  form.addEventListener('submit', function () {
    // Only show loading if there are no error messages present
    if (errorMessages.length === 0) {
      loadingSpan.style.display = 'block';
    } else {
      loadingSpan.style.display = 'none';
    }
  });
});

  function moveCursorToStart(input) {
    input.focus();
    input.setSelectionRange(0, 0);
  }

</script>
