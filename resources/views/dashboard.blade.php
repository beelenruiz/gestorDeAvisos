<x-app-layout>
   <div class="company-cards">
      <div class="company">
         <div class="company-image">
            <img src="{{ $user ->profile_photo_url }}" alt="{{ $user ->name }}" />
         </div>

         <div class="company-text">
            <h1>{{$user  -> name}}</h1>

            <a href="{{ route('profile.show') }}"><x-button><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i> editar perfil</x-button></a>
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
         <a href="{{ route('machines') }}"><x-button>mis maquinas</x-button></a>
         <a href="{{ route('orders') }}"><x-button>mis pedidos</x-button></a>
         <a href="{{ route('notifications') }}"><x-button>mis avisos</x-button></a>
         </div>
      </div>
   </div>


   
</x-app-layout>
