<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails de la filière') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Code</label>
                        <p class="font-mono text-lg">{{ $filiere->CodeF }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Libellé</label>
                        <p class="text-lg">{{ $filiere->Libelle }}</p>
                    </div>

                    <div class="flex gap-4 mt-6">
                        <a href="{{ route('filieres.edit', $filiere) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Modifier
                        </a>
                        <a href="{{ route('filieres.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
