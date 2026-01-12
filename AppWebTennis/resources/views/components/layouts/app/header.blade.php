<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>
        <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
        <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
        <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>

        <flux:separator vertical variant="subtle" class="my-2" />

        <flux:dropdown class="max-lg:hidden">
            <flux:navbar.item icon:trailing="chevron-down">Favorites</flux:navbar.item>

            <flux:navmenu>
                <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:navbar>

    <flux:spacer />

    <flux:navbar class="me-4">
        <livewire:header.search />
        <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
        <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
    </flux:navbar>

    {{-- Menu de Usuario --}}
    <flux:dropdown position="top" align="start">
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
                            <span
                                class="truncate font-semibold">{{ auth()->user()->nombres . ' ' . auth()->user()->apellidos }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->cargo }}</span>
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
