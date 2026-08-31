<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Affectations') }}
            </h2>
            <div class="flex gap-2">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('import.form') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                         Importer CSV
                    </a>
                @endif
                <a href="{{ route('affectations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    + Ajouter
                </a>
            </div>
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
                                <th class="text-left py-2">Formateur</th>
                                <th class="text-left py-2">Groupe</th>
                                <th class="text-left py-2">Module</th>
                                
                                <th class="text-center py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($affectations as $affectation)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="py-3">{{ $affectation->formateur->Nom ?? 'N/A' }}</td>
                                    <td class="py-3">{{ $affectation->groupe->Libelle ?? 'N/A' }}</td>
                                    <td class="py-3 font-mono">{{ $affectation->module->CodeM ?? 'N/A' }}</td>
                                    
                                    <td class="py-3 text-center space-x-2">
                                        <a href="{{ route('affectations.show', $affectation->Matricule) }}" class="text-blue-600 hover:underline">Voir</a>
                                        <a href="{{ route('affectations.edit', $affectation->Matricule) }}" class="text-green-600 hover:underline">Modifier</a>
                                        <form method="POST" action="{{ route('affectations.destroy', $affectation->Matricule) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Confirmer ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500">Aucune affectation</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $affectations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
