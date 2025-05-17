<div class="admin-dashboard">
    <x-button class="menu-toggle-button" id="menuToggle">☰</x-button>

    <div class="aside">
        <aside id="aside">
            <ul>
                <li wire:click="setView('dashboard')"><i class="fa-solid fa-house-user"></i>Dashboard</li>
                <hr />
                <li wire:click="setView('dashboard')">Dashboard</li>
                <hr />
                <hr />
                <li wire:click="setView('orders')"><i class="fa-solid fa-basket-shopping"></i>Pedidos</li>
                <hr />
                <li wire:click="setView('articles')"><i class="fa-solid fa-couch"></i></i>Productos</li>
                <hr />
                <li wire:click="setView('categories')"><i class="fa-solid fa-tags"></i>Categorias</li>
                <hr />
                <hr />
                <li wire:click="setView('companies')"><i class="fa-solid fa-building"></i>Empresas</li>
                <hr />
                <li wire:click="setView('workers')"><i class="fa-solid fa-users-gear"></i>Trabajadores</li>
                <hr />
                <li wire:click="setView('machines')"><i class="fa-solid fa-hard-drive"></i>Maquinas</li>
            </ul>
        </aside>
    </div>


    <div class="admin-content">
        @if ($view === 'dashboard')
        @livewire('admin-dashboard.dashboard')
        @elseif ($view === 'dashboard')
        @livewire('admin-dashboard.dashboard')
        @elseif ($view === 'orders')
        @livewire('admin-dashboard.orders')
        @elseif ($view === 'articles')
        @livewire('admin-dashboard.articles')
        @elseif ($view === 'categories')
        @livewire('admin-dashboard.category.categories')
        @elseif ($view === 'companies')
        @livewire('admin-dashboard.companies')
        @elseif ($view === 'workers')
        @livewire('admin-dashboard.workers')
        @elseif ($view === 'machines')
        @livewire('admin-dashboard.machines')
        @endif
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggleButton = document.getElementById('menuToggle');
        const adminAside = document.getElementById('aside');

        if (menuToggleButton && adminAside) {
            menuToggleButton.addEventListener('click', function() {
                adminAside.classList.toggle('is-open');
            });

            // logica que cierra el menu en moviles al hacer click
            adminAside.querySelectorAll('li[wire\\:click]').forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth <= 900) {
                        adminAside.classList.remove('is-open');
                    }
                });
            });
        }
    });
</script>