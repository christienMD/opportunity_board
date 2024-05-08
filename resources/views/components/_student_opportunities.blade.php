

@foreach ($opportunities as $opportunity)
<div class="card w-full md:max-w-xl bg-base-100 shadow-md">
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

                <div class="badge badge-success badge-lg gap-2">{{ $opportunity->category }}</div>
                <div class="text-sm font-medium  italic">posted {{ $opportunity->published_at->diffForHumans() }}</div> 
            </div>
        </div>
     </div>
 </div>
 <div class="flex mt-3 justify-center">
     <a href="/">
        <button class='px-20 py-1 text-medium text-white rounded-2xl bg-indigo-700 border hover:bg-indigo-800'>Apply</button>
     </a>
 </div>
</div>
</div>
@endforeach