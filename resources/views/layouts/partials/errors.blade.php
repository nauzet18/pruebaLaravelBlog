@if($errors->any())
    <div class="px-4 py-2 bg-red-600 text-white mb-2">
        <ul class="list-disc mb-2 mx-4">
            @foreach ($errors->all() as $error)
                <li class="mt-2">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif