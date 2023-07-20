@if ($errors->any())
    <div class="dark:bg-gray-600 border-l-4 border-red-500 text-orange-100 p-4 my-4" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif