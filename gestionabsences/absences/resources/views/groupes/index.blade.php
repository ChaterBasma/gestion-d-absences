<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Groupes') }}
            </h2>
            <a href="{{ route('groupes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
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
                                <th class="text-left py-2">Libellé</th>
                                <th class="text-left py-2">Filière</th>
                                <th class="text-center py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($groupes as $groupe)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="py-3 font-mono">{{ $groupe->CodeG }}</td>
                                    <td class="py-3">{{ $groupe->Libelle }}</td>
                                    <td class="py-3">{{ $groupe->filiere->Libelle ?? 'N/A' }}</td>
                                    <td class="py-3 text-center space-x-2">
                                        <a href="{{ route('groupes.show', $groupe) }}" class="text-blue-600 hover:underline">Voir</a>
                                        <a href="{{ route('groupes.edit', $groupe) }}" class="text-green-600 hover:underline">Modifier</a>
                                        <form method="POST" action="{{ route('groupes.destroy', $groupe) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Confirmer ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-500">Aucun groupe</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $groupes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
