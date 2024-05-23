   {{-- display opportunities on the landing page --}}
<div class="grid lg:grid-cols-2 px-2">
    {{-- all opportunities --}}
    <div class="w-full">
        <div class="p-3 pb-0">
        @foreach ($opportunities as $opportunity)
            <div id="opportunity-{{ $opportunity->id }}" class="card w-full md:max-w-xl shadow-sm mb-6 bg-gray-100 border border-gray-200 cursor-pointer opportunity-card">
            <div class="card-body">
            <div class="flex gap-3">
                <div class="rounded-xl h-36 w-40 flex justify-center items-center"> 
                    {{--image--}}
                    <img src="{{ asset($opportunity->img_url) }}" alt="Image for {{ $opportunity->title }}" class="rounded-xl h-36 w-40 object-cover">
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
                <a href="{{ route('student.apply', $opportunity->id) }}">
                    <button class='px-20 py-1 text-medium text-white rounded-2xl bg-indigo-500 border hover:bg-indigo-700'>Apply</button>
                </a>
            </div>
            </div>
            </div>
        @endforeach
     </div>

     <div class="p-4 mb-10 px-8">{{ $opportunities->links() }}</div>
    </div>

    {{-- opportunity details --}}
    <div class="sticky top-[20rem] right-0">
        <div id="opportunity-details" class="h-screen relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
            <div class="flex flex-col gap-2 justify-center items-center">
                <div class="mt-3">@include('components.logo')</div>
                <h1>Browse Opportunities That Match Your Career From Top Companies</h1>
                <div class="flex md:flex justify-center items-center mt-10 w-full gap-10">
                 <div class="">
                    <div class="rating">
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" checked />
                    </div>
                    <p class="mt-3 text-sm text-gray-800 dark:text-neutral-200">
                     <span class="font-bold">4.6</span> /5 - from 12k reviews
                     </p>
                    <div class="mt-3">
                        <!-- Star -->
                        <svg class="h-auto w-16 text-gray-800 dark:text-white" width="80" height="27" viewBox="0 0 80 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.558 9.74046H11.576V12.3752H17.9632C17.6438 16.0878 14.5301 17.7245 11.6159 17.7245C7.86341 17.7245 4.58995 14.7704 4.58995 10.6586C4.58995 6.62669 7.70373 3.51291 11.6159 3.51291C14.6498 3.51291 16.4063 5.42908 16.4063 5.42908L18.2426 3.51291C18.2426 3.51291 15.8474 0.878184 11.4961 0.878184C5.94724 0.838264 1.67578 5.50892 1.67578 10.5788C1.67578 15.5289 5.70772 20.3592 11.6558 20.3592C16.8854 20.3592 20.7177 16.8063 20.7177 11.4969C20.7177 10.3792 20.558 9.74046 20.558 9.74046Z" fill="currentColor"/>
                        <path d="M27.8621 7.78442C24.1894 7.78442 21.5547 10.6587 21.5547 14.012C21.5547 17.4451 24.1096 20.3593 27.9419 20.3593C31.415 20.3593 34.2094 17.7645 34.2094 14.0918C34.1695 9.94011 30.896 7.78442 27.8621 7.78442ZM27.902 10.2994C29.6984 10.2994 31.415 11.7764 31.415 14.0918C31.415 16.4072 29.7383 17.8842 27.902 17.8842C25.906 17.8842 24.3491 16.2874 24.3491 14.0519C24.3092 11.8962 25.8661 10.2994 27.902 10.2994Z" fill="currentColor"/>
                        <path d="M41.5964 7.78442C37.9238 7.78442 35.2891 10.6587 35.2891 14.012C35.2891 17.4451 37.844 20.3593 41.6763 20.3593C45.1493 20.3593 47.9438 17.7645 47.9438 14.0918C47.9038 9.94011 44.6304 7.78442 41.5964 7.78442ZM41.6364 10.2994C43.4328 10.2994 45.1493 11.7764 45.1493 14.0918C45.1493 16.4072 43.4727 17.8842 41.6364 17.8842C39.6404 17.8842 38.0835 16.2874 38.0835 14.0519C38.0436 11.8962 39.6004 10.2994 41.6364 10.2994Z" fill="currentColor"/>
                        <path d="M55.0475 7.82434C51.6543 7.82434 49.0195 10.7784 49.0195 14.0918C49.0195 17.8443 52.0934 20.3992 54.9676 20.3992C56.764 20.3992 57.6822 19.7205 58.4407 18.8822V20.1198C58.4407 22.2754 57.1233 23.5928 55.1273 23.5928C53.2111 23.5928 52.2531 22.1557 51.8938 21.3573L49.4587 22.3553C50.297 24.1517 52.0135 26.0279 55.0874 26.0279C58.4407 26.0279 60.9956 23.9122 60.9956 19.481V8.18362H58.3608V9.26147C57.6423 8.38322 56.5245 7.82434 55.0475 7.82434ZM55.287 10.2994C56.9237 10.2994 58.6403 11.7365 58.6403 14.1317C58.6403 16.6068 56.9636 17.9241 55.2471 17.9241C53.4507 17.9241 51.774 16.4471 51.774 14.1716C51.8139 11.6966 53.5305 10.2994 55.287 10.2994Z" fill="currentColor"/>
                        <path d="M72.8136 7.78442C69.62 7.78442 66.9453 10.2994 66.9453 14.0519C66.9453 18.004 69.9393 20.3593 73.093 20.3593C75.7278 20.3593 77.4044 18.8822 78.3625 17.6048L76.1669 16.1277C75.608 17.006 74.6499 17.8443 73.093 17.8443C71.3365 17.8443 70.5381 16.8862 70.0192 15.9281L78.4423 12.4152L78.0032 11.3772C77.1649 9.46107 75.2886 7.78442 72.8136 7.78442ZM72.8934 10.2196C74.0511 10.2196 74.8495 10.8184 75.2487 11.5768L69.6599 13.9321C69.3405 12.0958 71.097 10.2196 72.8934 10.2196Z" fill="currentColor"/>
                        <path d="M62.9531 19.9999H65.7076V1.47693H62.9531V19.9999Z" fill="currentColor"/>
                        </svg>
                        <!-- End Star -->
                    </div>
                 </div>
                 <div class="">
                    <div class="rating">
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" />
                    <input type="radio" name="rating-4" class="mask mask-star-2 bg-indigo-500" checked />
                    </div>
                    <p class="mt-3 text-sm text-gray-800 dark:text-neutral-200">
                     <span class="font-bold">4.6</span> /5 - from 12k reviews
                     </p>
                    <div class="mt-3">
                        <!-- Star -->
                     <h1 class="text-gray-800 font-medium text-xl">Tech Chantier</h1>
                        <!-- End Star -->
                    </div>
                 </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const opportunityCards = document.querySelectorAll('.opportunity-card');
    const detailsSection = document.getElementById('opportunity-details');

    opportunityCards.forEach(card => {
        card.addEventListener('click', function () {
            const opportunityId = card.id.split('-')[1];
            fetchOpportunityDetails(opportunityId);
        });
    });

    function fetchOpportunityDetails(id) {
        fetch(`/opportunity/${id}`)
            .then(response => response.json())
            .then(data => {
                displayOpportunityDetails(data);
            })
            .catch(error => console.error('Error fetching opportunity details:', error));
    }

   

    function displayOpportunityDetails(opportunity) {
        const formatDateToDMY = (dateString) => {
        const date = new Date(dateString);
        const day = date.getDate().toString().padStart(2, '0'); // Ensure two digits
        const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
            const year = date.getFullYear();
                return `${day} - ${month} - ${year}`;
            };

       const publishedAt = opportunity.published_at;
       const formattedDate = formatDateToDMY(publishedAt);


        detailsSection.innerHTML = `
            <div class="p-3 pb-0">
                <div class='flex items-center gap-1' >
                    <div class="avatar">
                        <div class="w-24 mask mask-hexagon">
                            <img src="${opportunity.img_url}" />
                        </div>
                    </div>
                    <div >
                    <h2 class='font-medium text-lg capitalize text-indigo-600'>${opportunity.company.name} </h2>
                     <div class='flex items-center justify-between gap-6'>
                         <div class="text-sm font-medium italic">
                                    posted on
                            <span class="bg-gray-100 text-gray-800 text-base font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2">
                                     <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                     <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                ${formattedDate}
                            </span>
                           </div>
                           <div class='text-indigo-700 font-medium text-lg'>${opportunity.category}</div>
                      </div>

                      </div>
                    </div>
                 </div>
                  
                 <h2 class="mt-3 p-2 font-bold capitalize text-3xl md:text-3xl text-gray-900">${opportunity.title}</h2>

                 <p class='text-base p-2'>${opportunity.description}</p>
            </div>
        `;
    }
});
</script>

