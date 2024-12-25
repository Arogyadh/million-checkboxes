<x-layouts.app>
    <div class="text-center mb-10 mt-5">
        <h1 class="text-4xl font-bold">Million checkboxes</h1>
    </div>
    <Scroller state="{{ $state }}" :count="{{ $count }}" />
</x-layouts.app>