
@if (session()->has('message'))
    <div
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 4000 )"
        x-show="show"
        style="position: absolute; top: 5%; left: 50%; transform: translateX(-50%); background-color: #6366f1; color: white; padding: 1.1rem 1.4rem;  border-radius: 0.5rem; width: fit-content; z-index: 1000;">
        <p>{{session('message')}}</p>
    </div>
@endif
