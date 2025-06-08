<x-app-layout>
   <div class="company-cards">
      <div class="company">
         <div class="company-image">
            <img src="{{ $user ->profile_photo_url }}" alt="{{ $user ->name }}" />
         </div>

         <div class="company-text">
            <h1>{{$user  -> name}}</h1>

            <x-button href="{{route('profile.show')}}"><i class="fa-solid fa-pen-to-square" aria-hidden="true" style="color: #ffffff;"></i> editar perfil</x-button>
         </div>
      </div>

      <div>
         <div class="company-info">
            <h1> datos de la empresa: </h1>
            <p>
               <b>dirección de corrreo:</b>   {{$user -> email}}
               <br>
               <b>teléfono:</b>   {{$user -> company -> phone}}
            </p>
         </div>

         <div class="company-botones">
         <x-button href="{{ route('machines') }}">mis maquinas</x-button>
         <x-button href="{{ route('orders') }}">mis pedidos</x-button>
         <x-button href="{{ route('notifications') }}">mis avisos</x-button>
         </div>
      </div>
   </div>


   
</x-app-layout>
