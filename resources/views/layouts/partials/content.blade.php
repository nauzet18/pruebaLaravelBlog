<div class="flex-auto flex flex-col bg-gray-100">
    <div class="container mx-auto  flex-auto">
        <div id="content" class="xl:overflow-auto ">
            <div class="xl:pt-5 pt-2 pb-4 my-4">
                @include('layouts.partials.errors')

                @yield('content')
            </div>
        </div>
    </div>
</div>
