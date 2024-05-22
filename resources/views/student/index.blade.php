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
   @include('components.student_nav')
   <div class="flex justify-center p-10 lg:p-5 w-full mb-6">
       @include('components.student_search')
   </div>
   <div class="container mx-auto grid grid-cols-12 p-2">
      <div class="col-span-12 md:col-span-6">
          @include('components.student_opportunities')
      </div>
      <div class="md:col-span-6"></div>
   </div>



 @include('components.toast_')
</body>
</html>