    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>
        <flux:separator />

        {{-- Clientes --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Clientes" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="{{ route('dashboard') }}" badge="" icon="magnifying-glass-circle">
                    Crear
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="pencil-square">SubMenu1</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Proveedores --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Proveedores" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="{{ route('dashboard') }}" badge="" icon="magnifying-glass-circle">
                    Crear
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="pencil-square">SubMenu1</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Ventas --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Ventas" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="{{ route('dashboard') }}" icon="magnifying-glass-circle">SubMenu1
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="pencil-square">SubMenu1</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Inventario --}}
        <flux:navlist class="w-64 mt-2" variant="outline">
            <flux:navlist.group heading="Inventario" icon="calendar" expandable :expanded="false">
                <flux:navlist.item href="{{ route('dashboard') }}" icon="calendar">SubMenu1
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="clock">SubMenu1</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Productos --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Nueva Venta o Servicio" expandable :expanded="false">
                <flux:navlist.item href="{{ route('dashboard') }}" icon="credit-card">Productos
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Sucursales --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Sucursales" icon="clipboard-list" expandable
                :expanded="false">
                <flux:navlist.item href="{{ route('negocio.sucursales.index') }}" icon="x-mark">
                    Gestionar Sucursales
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="lock-open">SubMenu1</flux:navlist.item>
                <flux:navlist.item href="#" icon="lock-open">SubMenu2</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{--  --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Concepto Médico" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="#" icon="magnifying-glass-circle">Sucursal 1</flux:navlist.item>
                <flux:navlist.item href="#" icon="pencil-square">Sucursal 2</flux:navlist.item>
                <flux:navlist.item href="#" icon="presentation-chart-line">Sucursal 3
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Facturacion --}}
        <flux:navlist class="w-64 rounded-lg" variant="outline">
            <flux:navlist.group heading="Orden de Servicio" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="{{ route('dashboard') }}" icon="magnifying-glass-circle" badge="">
                    Consultar
                </flux:navlist.item>
                <flux:navlist.item href="{{ route('dashboard') }}" icon="magnifying-glass-circle" badge="">
                    Pendientes
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>


        {{-- Envios & Entregaso --}}
        <flux:navlist class=" w-64
            " variant="outline">
            <flux:navlist.group heading="Envios & Entregas" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="#" icon="magnifying-glass-circle">Entrega de Certificados
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="pencil-square">Historial de Envios
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="presentation-chart-line">Formulario</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Informes & Reportes --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Informes & Reportes" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="#" icon="magnifying-glass-circle">Clientes</flux:navlist.item>
                <flux:navlist.item href="#" icon="pencil-square">Administrativos</flux:navlist.item>
                <flux:navlist.item href="#" icon="presentation-chart-line">Ventas</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Formatos --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Formatos" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="#" icon="magnifying-glass-circle">Descargas</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- Auditoria --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Auditoria" icon="clipboard-list" expandable :expanded="false">
                <flux:navlist.item href="#" icon="magnifying-glass-circle">Ordenes de Servicio
                </flux:navlist.item>
                <flux:navlist.item href="#" icon="pencil-square">Ventas</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        {{-- SEGURIDAD & SALUD EN EL TRABAJO --}}
        <flux:navlist class="w-64" variant="outline">
            <flux:navlist.group heading="Seguridad & Salud T" icon="clipboard-list" expandable
                :expanded="false">
                <flux:navlist.item href="#" icon="magnifying-glass-circle">Consultar</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>

        <!-- Desktop User Menu -->
        {{-- <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down" data-test="sidebar-menu-button" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full" data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown> --}}
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full" data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
