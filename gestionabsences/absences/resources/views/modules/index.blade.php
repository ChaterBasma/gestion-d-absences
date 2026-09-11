<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Modules') }}
            </h2>
            <a href="{{ route('modules.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Ajouter
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full text-sm">
                        <thead class="border-b border-gray-300 dark:border-gray-600">
                            <tr>
                                <th class="text-left py-2">Code</th>
                                <th class="text-left py-2">Filière</th>
                                <th class="text-center py-2">MHP</th>
                                <th class="text-center py-2">MHD</th>
                                <th class="text-center py-2">MHG</th>
                                <th class="text-center py-2">Coef</th>
                                <th class="text-center py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($modules as $module)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="py-3 font-mono">{{ $module->CodeM }}</td>
                                    <td class="py-3">{{ $module->filiere->Libelle ?? 'N/A' }}</td>
                                    <td class="py-3 text-center">
                                        <span class="bg-blue-100 dark:bg-blue-900 px-2 py-1 rounded text-xs">{{ $module->MHP }} h</span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="bg-green-100 dark:bg-green-900 px-2 py-1 rounded text-xs">{{ $module->MHD }} h</span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="bg-purple-100 dark:bg-purple-900 px-2 py-1 rounded text-xs font-semibold">{{ $module->getMHGAttribute() }} h</span>
                                    </td>
                                    <td class="py-3 text-center">{{ $module->coef }}</td>
                                    <td class="py-3 text-center space-x-2">
                                        <a href="{{ route('modules.show', $module) }}" class="text-blue-600 hover:underline">Voir</a>
                                        <a href="{{ route('modules.edit', $module) }}" class="text-green-600 hover:underline">Modifier</a>
                                        <form method="POST" action="{{ route('modules.destroy', $module) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Confirmer ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 text-center text-gray-500">Aucun module</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $modules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
