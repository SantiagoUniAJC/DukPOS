<flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" href="#" current>AdminPanel</flux:navbar.item>
        <flux:navbar.item icon="inbox" badge="12" href="{{ route('dashboard') }}">Buzon de Correo
        </flux:navbar.item>
        <flux:navbar.item icon="calendar" href="{{ route('dashboard') }}" badge="4">
            Calendario</flux:navbar.item>
        <flux:separator vertical variant="subtle" class="my-2" />

        <flux:dropdown class="max-lg:hidden">
            <flux:navbar.item icon:trailing="chevron-down">Favoritos</flux:navbar.item>
            <flux:navmenu>
                <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>


        <flux:navbar.item icon="user-group" href="{{ route('dashboard') }}" label="Pacientes" badge="2"
            title="Gestion de Menu">Menu
        </flux:navbar.item>


        <flux:navbar.item icon="user-group" href="{{ route('dashboard') }}" label="Especialistas" badge="3"
            title="Gestion de Menu">Menu
        </flux:navbar.item>


        <flux:navbar.item icon="users" href="{{ route('dashboard') }}" label="Usuarios" badge="5"
            title="Gestion de Usuarios Registrados">Usuarios
        </flux:navbar.item>
    </flux:navbar>

    {{-- Buscar, Ayuda, Documentacion --}}
    <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
        <flux:tooltip :content="__('Search')" position="bottom">
            <flux:navbar.item class="h-10 max-lg:hidden [&>div>svg]:size-5" icon="magnifying-glass" href="#"
                :label="__('Search')" />
        </flux:tooltip>
        <flux:tooltip :content="__('Help')" position="bottom">
            <flux:navbar.item class="!h-10 max-lg:hidden [&>div>svg]:size-5" icon="information-circle" href="#"
                :label="__('Help')" />
        </flux:tooltip>
        <flux:tooltip :content="__('Documentation')" position="bottom">
            <flux:navbar.item class="h-10 max-lg:hidden [&>div>svg]:size-5" icon="book-open-text" href="#"
                target="_blank" label="Documentation" />
        </flux:tooltip>
    </flux:navbar>

    {{-- Menu de Usuario --}}
     <flux:dropdown class="max-lg:hidden" position="top" align="end">
            <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />

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
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full"
                        data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
</flux:header>
