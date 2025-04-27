@push('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

<x-app-layout>
   <div>
      <div>
         <img style="margin: auto; height: 150; margin-bottom: 15;" src="{{Storage::url('images/image.png')}}">
      </div>

      <div class="scroll-layout">
         <button class="scroll-btn left"><i class="fa-solid fa-circle-arrow-left fa-2xl" style="color: #490e0e; margin: 10px;"></i></button>

         <div class="carousel">
            <ul class="content">
               <li><img style="height: 400; width: 942;" src="{{Storage::url('images/carrousel/imagen1.png')}}"></li>
               <li><img style="height: 400; width: 942;" src="{{Storage::url('images/carrousel/imagen2.png')}}"></li>
               <li><img style="height: 400; width: 942;" src="{{Storage::url('images/carrousel/imagen3.png')}}"></li>
               <li><img style="height: 400; width: 942;" src="{{Storage::url('images/carrousel/imagen4.png')}}"></li>
            </ul>
         </div>

         <button class="scroll-btn right"><i class="fa-solid fa-circle-arrow-right fa-2xl" style="color: #490e0e; margin: 10px;"></i></button>
      </div>
   </div>
</x-app-layout>