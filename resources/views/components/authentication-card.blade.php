<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
    style="background-color: #d6d9d9;">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <img style="width: 150px; margin: auto;" src="{{asset('images/image.png')}}">
        {{ $slot }}
    </div>
</div>
