<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Formateurs') }}
            </h2>
            <a href="{{ route('formateurs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Ajouter un formateur
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($formateurs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="border px-4 py-2 text-left">Matricule</th>
                                        <th class="border px-4 py-2 text-left">Nom</th>
                                        <th class="border px-4 py-2 text-left">Prénom</th>
                                        <th class="border px-4 py-2 text-left">Email</th>
                                        <th class="border px-4 py-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formateurs as $formateur)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="border px-4 py-2">{{ $formateur->Matricule }}</td>
                                            <td class="border px-4 py-2">{{ $formateur->Nom }}</td>
                                            <td class="border px-4 py-2">{{ $formateur->Prenom }}</td>
                                            <td class="border px-4 py-2">{{ $formateur->email }}</td>
                                            <td class="border px-4 py-2 text-center">
                                                <a href="{{ route('seances.avancement', $formateur) }}" class="text-purple-600 hover:text-purple-900 mr-2" title="Voir l'avancement">📊</a>
                                                <a href="{{ route('formateurs.show', $formateur) }}" class="text-blue-600 hover:text-blue-900 mr-2">Voir</a>
                                                <a href="{{ route('formateurs.edit', $formateur) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Modifier</a>
                                                <form method="POST" action="{{ route('formateurs.destroy', $formateur) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $formateurs->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600 dark:text-gray-400">Aucun formateur n'a été créé.</p>
                            <a href="{{ route('formateurs.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Créer le premier formateur
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
