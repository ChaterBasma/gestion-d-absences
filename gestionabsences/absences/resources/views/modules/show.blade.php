<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails du module') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Code</label>
                        <p class="font-mono text-lg">{{ $module->CodeM }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Filière</label>
                        <p class="text-lg">{{ $module->filiere->Libelle ?? 'N/A' }}</p>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">MHP (heures)</label>
                            <p class="bg-blue-100 dark:bg-blue-900 px-3 py-2 rounded">{{ $module->MHP }} h</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">MHD (heures)</label>
                            <p class="bg-green-100 dark:bg-green-900 px-3 py-2 rounded">{{ $module->MHD }} h</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">MHG (heures) - Calculée</label>
                            <p class="bg-purple-100 dark:bg-purple-900 px-3 py-2 rounded font-semibold">{{ $module->getMHGAttribute() }} h</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Coefficient</label>
                        <p class="text-lg">{{ $module->coef }}</p>
                    </div>

                    <div class="flex gap-4 mt-6">
                        <a href="{{ route('modules.edit', $module) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Modifier
                        </a>
                        <a href="{{ route('modules.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
