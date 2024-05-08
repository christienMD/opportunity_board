<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
     @vite('resources/css/app.css')
    <title>Home - Student</title>
</head>
<body>
    {{-- nav bar --}}
   @include('components._student_nav')
   <div class="flex justify-center p-4 w-full">
       @include('components._student_search')
   </div>
   <div class="container mx-auto grid grid-cols-12">
      <div class="col-span-6">
          @include('components._student_opportunities')
      </div>
      <div class="col-span-6"></div>
   </div>



 @include('components._toast')
</body>
</html>