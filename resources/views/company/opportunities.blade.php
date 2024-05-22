<div class="p-6 mb-10">
   <div class="overflow-x-auto bg-white rounded-md w-full">
      <table class="table table-zebra">
        <thead>
          <tr class="font-bold text-black text-base">
            {{-- <th>Id</th> --}}
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

            @if (count($opportunities))         
            @foreach ($opportunities as $opportunity)

            <tr>
              {{-- <td>{{ $opportunity->id }}</td> --}}
              <td class="max-w-[200px]">
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                              <img src="{{ $opportunity->img_url }}" alt="{{ $opportunity->title }}" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold text-lg">{{ $opportunity->title }}</div>
                            <div class="text-sm">ends on: <span class="font-medium">{{ $opportunity->closing_date ? $opportunity->closing_date->toFormattedDateString() : 'Date not set' }}</span></div>
                        </div>
                    </div>
                </td>
                <td class="max-w-[100px] text-[1.2rem]">
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                    {{ $opportunity->category }}
                    </span>
                </td>
                <td class="max-w-[100px]"><span class="badge badge-neutral">{{ $opportunity->status }}</span></td>
                <td class="max-w-[200px] overflow-x-auto">{{ $opportunity->description }}</td>

               <td class="flex gap-3 items-center text-base capitalize font-medium max-w-xs">

              @if($opportunity->status === 'Pending')
                {{-- publish --}}
                <a href="{{ route('publish_opportunity', $opportunity->id) }}" x-data="{ isPublishing: false }">
                  <button @click="isPublishing = true"  class="flex items-center justify-center  rounded-md bg-indigo-700 w-20 text-sm leading-6 text-white shadow-sm hover:bg-indigo-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700">
                      <span class="pe-1" x-cloak x-show="!isPublishing">Publish</span>
                      <span x-cloak x-show="isPublishing" class="loading loading-dots loading-md"></span>
                  </button>
                </a>

              @elseif($opportunity->status === 'Published')
                {{-- un publish  --}}
                <a href="{{ route('unpublish_opportunity', $opportunity->id) }}" x-data="{ isUnPublishing: false }">
                  <button @click="isPublishing = true"  class="flex items-center justify-center  rounded-md bg-indigo-700 w-20 text-sm leading-6 text-white shadow-sm hover:bg-indigo-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700">
                      <span class="pe-1" x-cloak x-show="!isUnPublishing">un publish</span>
                      <span x-cloak x-show="isUnPublishing" class="loading loading-dots loading-md"></span>
                  </button>
                </a>
              @endif

                 <div class="w-full flex gap-7 ps-2">

                  {{-- show confirmation dialog box before deleting --}}
                   <div x-data="{ isModalOpen: false, isDeleting: false }">
                      <span @click="isModalOpen = true" class="tooltip tooltip-bottom tooltip-error" data-tip="delete">
                        <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                         <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                      </span>
                    <div   x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.5);">
                      <div class="modal-box bg-white p-6 rounded-md shadow-md">
                        <h3 class="font-bold text-xl mb-1">Delete Opportunity</h3>
                          <p>Are you sure you want to delete this opportunity?this action cannot be undone.</p>
                        <div class="modal-action flex gap-3">
                          <button x-cloak x-show="!isDeleting" @click="isModalOpen = false" class="btn btn-sm btn-error text-white">Cancel</button>
                              <a @click="isDeleting = true"  href="{{ route('delete_opportunity', $opportunity->id) }}" class="flex items-center justify-center rounded-md bg-indigo-600 px-3 w-20 text-sm font-semibold text-white shadow-sm hover:bg-indigo-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 capitalize">
                                <span x-cloak x-show="!isDeleting">Delete</span>
                                <span x-cloak x-show="isDeleting" class="loading loading-spinner loading-sm text-white"></span>
                              </a>
                        </div>
                      </div>
                    </div>
                  </div>

                 <a href="/opportunities/{{$opportunity->id}}/edit" class="tooltip tooltip-bottom" data-tip="edit opportunity">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                 </a>

                </div>
              </td>
            </tr>
          @endforeach
           @else
             @include('components.opp_empty')
           @endif
        </tbody>
      </table>
  </div> 
</div>



<style>
    [x-cloak] { display: none !important; }
</style>