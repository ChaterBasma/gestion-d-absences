<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Détails de la séance') }} {{ $seance->NumS }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('seances.edit', $seance) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                    Modifier
                </a>
                <a href="{{ route('seances.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">N° Séance</p>
                            <p class="text-lg font-semibold">{{ $seance->NumS }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Formateur</p>
                            <p class="text-lg font-semibold">{{ $seance->formateur->Nom }} {{ $seance->formateur->Prenom }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Groupe</p>
                            <p class="text-lg font-semibold">{{ $seance->groupe->Libelle }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Module</p>
                            <p class="text-lg font-semibold">{{ $seance->module->CodeM }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Type de cours</p>
                            <p class="text-lg font-semibold">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    {{ $seance->TypeCours === 'P' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' }}">
                                    {{ $seance->TypeCours === 'P' ? 'Présentielle' : 'Distancielle' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Jour</p>
                            <p class="text-lg font-semibold">{{ $seance->Jour }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Heure de début</p>
                            <p class="text-lg font-semibold">{{ $seance->HeureD }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Heure de fin</p>
                            <p class="text-lg font-semibold">{{ $seance->HeureF }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Durée</p>
                            <p class="text-lg font-semibold">{{ $seance->duree_heures }} h</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Nombre d'absents</p>
                            <p class="text-lg font-semibold">{{ $seance->EffAbsent ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('seances.destroy', $seance) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')">
                                Supprimer cette séance
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
