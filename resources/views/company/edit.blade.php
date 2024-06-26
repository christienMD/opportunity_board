<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta title="viewport"="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
     @vite('resources/css/app.css')
    <title>Company - Edit Opportunity</title>
</head>
<body>
    
    <div class="mb-6">
        <div class="w-full flex flex-col items-center justify-center mt-6">
        <h1 class="text-xl font-bold text-center py-4">Edit Opportunity</h1>
       <form method="POST" x-data="{ isCreating: false }" action="/opportunities/{{$opportunity->id}}" class="mb-2 w-80 max-w-screen-lg sm:w-96" enctype="multipart/form-data">
          @csrf
          @method('PUT')
        <div class="sm:col-span-3">

         {{-- title --}}
          <div class="mt-2">
              <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title </label>
              <div class="">
                <input 
                value="{{ $opportunity->title }}"
                type="text"
                placeholder="enter opportunity title"
                title="title"
                id="title"
                name="title"
                class="outline-none mt-1 block w-full rounded-md border-0 py-1.5 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 placeholder:text-xs placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
              </div>
              @error('title')
                  <p class="text-error text-base">{{$message}}</p>
              @enderror
          </div>
          
         {{-- category  --}}
        <div id="category" class="my-4">
            <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
            <div class="w-full mt-1">
                <select name="category" id="category" title="category" class="block outline-none w-full text-base rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                 <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ $category == $opportunity->category ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
                </select>
                    </div>
                    @error('category')
                    <p class="text-error text-base">{{$message}}</p>
                    @enderror
            </div>

                {{-- decription --}}
                <div>
                <label for="description" class=''>
                opportunity decription
                </label>
                <textarea
                
                placeholder="Enter opportunity decription"
                class="mt-1 w-full border border-1 outline-none rounded-md placeholder:text-xs p-2 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                id="description"
                name="description"
                >
                {{$opportunity->description}}
            </textarea>
        @error('description')
              <p class="text-error text-base">{{$message}}</p>
        @enderror
        </div>

        {{-- image --}}
        <div class="my-4">
           <label for="img_upload" class="">Uploade Image</label>
           <input class="mt-1" type="file" id="img_upload" name="img_url" onchange="previewImage(event)" accept=".png , .jpg ,.jpeg">

           <div class="py-4">
              
             <img id="imagePreview" class="w-48"  src="{{ $opportunity->img_url ? asset($opportunity->img_url) : '' }}" alt="Your image will appear here" style="{{ $opportunity->img_url ? 'height: 120px;' : 'display: none;' }}">

           </div>
            @error('img_upload')
             <p class="text-error text-base">{{$message}}</p>
            @enderror
        </div>

         {{-- submit --}}
          <button @click="isCreating = true" type="submit" class="flex w-full items-center justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                 <span class="pe-1">Update Opportunity</span>
                 <span x-cloak x-show="isCreating" class="loading loading-dots loading-md"></span>
          </button>

        </div>
    </form>
       </div>
       
    </div>
  

       <script>
            function previewImage(event) {
                let reader = new FileReader();
                reader.onload = function() {
                    let output = document.getElementById('imagePreview');
                    output.src = reader.result;
                    output.style.display = 'block'; 
                }
                if (event.target.files.length > 0) {
                    reader.readAsDataURL(event.target.files[0]);
                } else {
                    document.getElementById('imagePreview').style.display = 'none'; 
                }
            }
      </script>

<style>
    [x-cloak] { display: none !important; }
</style>
</body>
</html>