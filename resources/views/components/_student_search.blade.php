
<form action="/students/home" class="w-full md:max-w-xl lg:max-w-2xl mt-6">
    <label class="input input-bordered flex items-center gap-2 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        <input type="text" name="search" class="grow" placeholder="Job titles, Keywords or company" />
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70 cursor-pointer">
            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
        </svg>
    </label>
    <!-- Filters Section -->
    <div class="flex flex-wrap gap-4 mt-4 items-center justify-center">
        <!-- Job Type Filter -->
        <label>
            Opportunity Type:
            <select class="block outline-none w-full text-base rounded-md border border-indigo-600 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option>All</option>
                <option><a href="/?category='job'">Full Time</a></option>
                <option><a href="/?category='volunteer'">Part Time</a></option>
                <option><a href="/?category='internship'">Internship</a></option>
            </select>
        </label>
        
        <!-- Experience Level Filter -->
        <label>
            Experience Level:
            <select class="inline-block outline-none w-full text-base rounded-md border border-indigo-600 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option>Entry</option>
                <option>Mid</option>
                <option>Senior</option>
            </select>
        </label>

         <!-- Location Filter -->
        <div class="flex flex-col pt-1">
            Location:
            <div class="flex gap-3">
                <div><label><input type="checkbox" class="checkbox border border-gray-500" />Remote</label></div>
                <div><label><input type="checkbox" class="checkbox border border-gray-500" />Onsite</label></div>
                <div><label><input type="checkbox" class="checkbox border border-gray-500" />Hybrid</label></div>
            </div>
        </div>
    </div>
</form>
