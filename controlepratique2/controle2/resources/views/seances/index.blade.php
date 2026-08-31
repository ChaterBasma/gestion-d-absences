<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Séances') }}
            </h2>
            @if(auth()->user()->role === 'F')
                <a href="{{ route('seances.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    + Ajouter une séance
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filtre pour Direction -->
            @if(auth()->user()->role === 'D')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Filtrer les séances</h3>
                        <div class="flex gap-4 mb-6">
                            <a href="{{ route('seances.index', ['filter' => 'non-validees']) }}" 
                               class="px-4 py-2 rounded-lg {{ request('filter', 'non-validees') === 'non-validees' ? 'bg-red-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600' }}">
                                Séances non validées
                            </a>
                            <a href="{{ route('seances.index', ['filter' => 'validees']) }}" 
                               class="px-4 py-2 rounded-lg {{ request('filter') === 'validees' ? 'bg-green-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600' }}">
                                Séances validées
                            </a>
                        </div>

                        <!-- Formulaire d'export PDF -->
                        <div class="border-t pt-4">
                            <h4 class="font-semibold mb-3">📄 Générer un rapport PDF</h4>
                            <form method="POST" action="{{ route('seances.export-pdf') }}" class="flex gap-4 items-end">
                                @csrf
                                <div>
                                    <label for="date1" class="block text-sm font-medium mb-1">Date de début</label>
                                    <input type="date" id="date1" name="date1" required
                                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                        value="{{ now()->startOfMonth()->format('Y-m-d') }}">
                                    @error('date1')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="date2" class="block text-sm font-medium mb-1">Date de fin</label>
                                    <input type="date" id="date2" name="date2" required
                                        class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                        value="{{ now()->format('Y-m-d') }}">
                                    @error('date2')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                                    Générer PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($seances->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="border px-4 py-2 text-left">N° Séance</th>
                                        <th class="border px-4 py-2 text-left">Formateur</th>
                                        <th class="border px-4 py-2 text-left">Groupe</th>
                                        <th class="border px-4 py-2 text-left">Module</th>
                                        <th class="border px-4 py-2 text-left">Type</th>
                                        <th class="border px-4 py-2 text-left">Jour</th>
                                        <th class="border px-4 py-2 text-left">Heures</th>
                                        <th class="border px-4 py-2 text-left">Durée</th>
                                        <th class="border px-4 py-2 text-left">Absents</th>
                                        @if(auth()->user()->role === 'D')
                                            <th class="border px-4 py-2 text-left">Statut</th>
                                        @endif
                                        <th class="border px-4 py-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seances as $seance)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="border px-4 py-2">{{ $seance->NumS }}</td>
                                            <td class="border px-4 py-2">{{ $seance->formateur->Nom }} {{ $seance->formateur->Prenom }}</td>
                                            <td class="border px-4 py-2">{{ $seance->groupe->Libelle }}</td>
                                            <td class="border px-4 py-2">{{ $seance->module->CodeM }}</td>
                                            <td class="border px-4 py-2">
                                                <span class="px-2 py-1 rounded text-xs font-semibold
                                                    {{ $seance->TypeCours === 'P' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' }}">
                                                    {{ $seance->TypeCours === 'P' ? 'Présentielle' : 'Distancielle' }}
                                                </span>
                                            </td>
                                            <td class="border px-4 py-2">{{ $seance->Jour }}</td>
                                            <td class="border px-4 py-2">{{ $seance->HeureD }} - {{ $seance->HeureF }}</td>
                                            <td class="border px-4 py-2">{{ $seance->duree_heures }} h</td>
                                            <td class="border px-4 py-2">{{ $seance->EffAbsent ?? 0 }}</td>
                                            @if(auth()->user()->role === 'D')
                                                <td class="border px-4 py-2">
                                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                                        {{ $seance->Valide ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100' }}">
                                                        {{ $seance->Valide ? 'Validée' : 'En attente' }}
                                                    </span>
                                                </td>
                                            @endif
                                            <td class="border px-4 py-2 text-center">
                                                <a href="{{ route('seances.show', $seance) }}" class="text-blue-600 hover:text-blue-900 mr-2">Voir</a>
                                                @if(auth()->user()->role === 'D' && !$seance->Valide)
                                                    <form method="POST" action="{{ route('seances.approve', $seance) }}" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Valider</button>
                                                    </form>
                                                @endif
                                                @if(auth()->user()->role === 'F' || auth()->user()->role === 'admin')
                                                    <a href="{{ route('seances.edit', $seance) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Modifier</a>
                                                    <form method="POST" action="{{ route('seances.destroy', $seance) }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $seances->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            @if(auth()->user()->role === 'D')
                                <p class="text-gray-600 dark:text-gray-400">
                                    @if(request('filter') === 'validees')
                                        Aucune séance validée.
                                    @else
                                        Aucune séance en attente de validation.
                                    @endif
                                </p>
                            @else
                                <p class="text-gray-600 dark:text-gray-400">Aucune séance n'a été créée.</p>
                            @endif
                            @if(auth()->user()->role === 'F')
                                <a href="{{ route('seances.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                    Créer la première séance
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
