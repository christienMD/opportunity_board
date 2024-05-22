<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
     @vite('resources/css/app.css')
    <title>Application - Success</title>
</head>
<body>
    <!-- Announcement Banner -->
<div class="max-w-[85rem] p-4 sm:px-6 lg:px-8 mx-auto">
  <div class="bg-indigo-800 bg-[url('https://preline.co/assets/svg/examples/abstract-1.svg')] bg-no-repeat bg-cover bg-center p-10 rounded-lg text-center">
    <p class="me-2 inline-block text-white">
      Your Application has been submitted successfully ,
      We will get back to you after reviewing your CV.
    </p>
    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border-2 border-white text-white hover:border-white/70 hover:text-white/70 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('welcome') }}">
      find more opportunities
      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
    </a>
  </div>
</div>
<!-- End Announcement Banner -->
</body>
</html>