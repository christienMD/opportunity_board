

@foreach ($opportunities as $opportunity)
    <div class="card w-full md:max-w-xl shadow-sm mb-6 bg-gray-100 border border-gray-200">
    <div class="card-body">
    <div class="flex gap-3">
        <div class="rounded-xl h-36 w-40 flex justify-center items-center"> 
            {{--image--}}
            <img src="{{ $opportunity->img_url }}" alt="Image for {{ $opportunity->title }}" class="rounded-xl h-36 w-40 object-cover">
        </div>
        <div class="flex-1">
            <div class="flex flex-col gap-2">
                <h2 class="font-bold capitalize text-2xl md:text-3xl text-gray-800">{{ $opportunity->title }}</h2>
                <p class="line-clamp-3 text-base">
            {{ $opportunity->description }}
                </p>
                <div class="flex justify-between">

                    <div class="bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-indigo-400 border border-indigo-400">{{ $opportunity->category }}</div>
                    <div class="text-sm font-medium italic">
                        posted 
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                            </svg>
                            {{ $opportunity->published_at->diffForHumans() }}</span></div> 
                </div>
            </div>
        </div>
    </div>
    <div class="flex mt-3 justify-center">
        <a href="{{ route('application_form', $opportunity->id) }}">
            <button class='px-20 py-1 text-medium text-white rounded-2xl bg-indigo-500 border hover:bg-indigo-700'>Apply</button>
        </a>
    </div>
    </div>
    </div>
@endforeach