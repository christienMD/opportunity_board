@extends('layouts.landing_page')
@section('header')
 <nav class="flex items-center justify-between h-14 border border-b shadow-sm px-6 bg-gradient-to-t from-indigo-50 to-white">
        <div>@include('components._logo')</div>
        <div class="flex gap-3 items-center">
            <a href="{{ route('auth.signup') }}"><button class="rounded-md py-1 px-3 text-white text-base bg-indigo-800 hover:bg-indigo-900 border-indigo-800 hover:border-indigo-800">Sign Up</button></a>
            <a href="{{ route('auth.login') }}"><button class="border-2 text-base border-indigo-700 px-3 rounded-md py-0.5 text-indigo-700 hover:text-white hover:bg-indigo-800">Login</button></a>
    </div>
 </nav>
@endsection
@section('hero')
<div class="w-full flex justify-center">
    <div class="flex justify-center items-center bg-white mt-[100px] mb-16 w-full md:max-w-5xl px-12 rounded-full">
                <div class="flex justify-center">
                <div class="flex flex-col gap-6">
                    <h1 class="text-center capitalize text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"><span class="sm:text-6xl md:text-7xl text-indigo-800">W</span>elcome to Opportunity <span class="text-indigo-800">Board</span></h1>
                    <div>
                        <p class="text-center text-lg px-10 font-medium ">Discover your next career move. Explore job opportunities from top companies.
                        <span><button class="p-3 lg:pt-3 lg:mt-5 border border-indigo-800 rounded-full bg-indigo-800 font-medium text-white hover:bg-indigo-950 transition-colors">Get Started</button></span> </>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('main')
@include('components._main')
@endsection