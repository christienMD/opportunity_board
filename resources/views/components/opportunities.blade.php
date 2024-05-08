<div class="grid lg:grid-cols-2">
    <div class="w-full">
        @include('components._opp_card')
    </div>
    <div class="hidden md:block">
       <div class="flex w-full justify-between items-center px-2">
                <div class="flex flex-col gap-1">
                    {{-- company image and name --}}
                    <div class="flex items-center gap-1">
                        <div class="rounded-full bg-indigo-500 h-14 w-14 flex justify-center items-center text-black"> image </div>
                        <h2 class="font-bold text-lg text-black">Tech Chantier</h2>
                    </div>
                    <h2 class="font-bold capitalize text-2xl text-gray-950">opportunity title here</h2>
                </div>
             <div class="mt-3 hidden lg:flex justify-between items-center pe-3">
                <a href="/">
                    <button class='px-16 py-1 text-medium text-black rounded-2xl bg-gradient-to-b from-indigo-600 to-indigo-200 border hover:bg-indigo-800'>Apply</button>
                </a>
             </div>
       </div>
       <div class="mt-6 px-6 text-base text-black">
        <p class="">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Quis ab sunt perspiciatis fugit possimus minus repellat incidunt 
            debitis, porro suscipit vero. Optio, quasi aspernatur temporibus 
            cupiditate laborum neque eius repudiandae 
            harum omnis porro ad. Nam quaerat molestiae consequuntur provident et?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. In explicabo saepe eaque nemo ex deleniti perspiciatis quos odit,
             quae similique consequatur quas? Perferendis, veritatis eos.
        </p>
        <p class="">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Quis ab sunt perspiciatis fugit possimus minus repellat incidunt 
            debitis, porro suscipit vero. Optio, quasi aspernatur temporibus 
            cupiditate laborum neque eius repudiandae 
            harum omnis porro ad. Nam quaerat molestiae consequuntur provident et?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. In explicabo saepe eaque nemo ex deleniti perspiciatis quos odit,
             quae similique consequatur quas? Perferendis, veritatis eos.
        </p>
       </div>
    </div>
</div>
