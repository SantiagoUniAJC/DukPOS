@props(['src', 'alt' => ''])

<div x-data="{ open: false }" class="inline-block">
    <!-- Thumbnail -->
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        class="h-16 w-16 object-cover rounded cursor-pointer"
        @click="open = true"
    >

    <!-- Modal -->
    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
        @click.self="open = false"
    >
        <!-- Close button -->
        <button
            @click="open = false"
            aria-label="Cerrar"
            class="absolute top-4 right-4 text-white text-3xl font-bold hover:opacity-80"
        >
            &times;
        </button>

        <!-- Image -->
        <img
            src="{{ $src }}"
            alt="{{ $alt }}"
            class="max-h-[90vh] max-w-[90vw] rounded shadow-2xl"
        >
    </div>
</div>
