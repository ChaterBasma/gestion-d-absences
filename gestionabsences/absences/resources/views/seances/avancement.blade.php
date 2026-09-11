<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Avancement') }} - {{ $formateur->Nom }} {{ $formateur->Prenom }}
            </h2>
            <a href="{{ route('formateurs.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Avancement par groupe -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                    Avancement par Groupe
                </h3>

                @if(count($avancementParGroupe) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($avancementParGroupe as $codeG => $data)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h4 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-4">
                                        {{ $data['groupe']->Libelle }}
                                    </h4>

                                    <div class="space-y-3 mb-4">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600 dark:text-gray-400">Total Séances:</span>
                                            <span class="font-semibold text-blue-600">{{ $data['total_seances'] }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600 dark:text-gray-400">Total Heures:</span>
                                            <span class="font-semibold text-green-600">{{ $data['total_heures'] }}h</span>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Détail des séances:</p>
                                        <div class="space-y-2 max-h-48 overflow-y-auto">
                                            @foreach($data['seances'] as $seance)
                                                <div class="text-xs bg-gray-50 dark:bg-gray-700 p-2 rounded">
                                                    <p class="font-medium">{{ $seance->NumS }}</p>
                                                    <p class="text-gray-600 dark:text-gray-400">
                                                        {{ $seance->Jour }} - {{ $seance->HeureD }} à {{ $seance->HeureF }} ({{ $seance->duree_heures }}h)
                                                        <span class="px-1 py-0.5 rounded
                                                            {{ $seance->TypeCours === 'P' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' }}">
                                                            {{ $seance->TypeCours === 'P' ? 'P' : 'D' }}
                                                        </span>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <p class="text-gray-600 dark:text-gray-400 text-center">Aucune séance par groupe pour ce formateur.</p>
                    </div>
                @endif
            </div>

            <!-- Avancement par module -->
            <div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                    Avancement par Module
                </h3>

                @if(count($avancementParModule) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($avancementParModule as $codeM => $data)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h4 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-4">
                                        {{ $data['module']->CodeM }}
                                    </h4>

                                    <div class="space-y-3 mb-4">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600 dark:text-gray-400">Total Séances:</span>
                                            <span class="font-semibold text-blue-600">{{ $data['total_seances'] }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600 dark:text-gray-400">Total Heures:</span>
                                            <span class="font-semibold text-green-600">{{ $data['total_heures'] }}h</span>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Détail des séances:</p>
                                        <div class="space-y-2 max-h-48 overflow-y-auto">
                                            @foreach($data['seances'] as $seance)
                                                <div class="text-xs bg-gray-50 dark:bg-gray-700 p-2 rounded">
                                                    <p class="font-medium">{{ $seance->NumS }}</p>
                                                    <p class="text-gray-600 dark:text-gray-400">
                                                        {{ $seance->Jour }} - {{ $seance->HeureD }} à {{ $seance->HeureF }} ({{ $seance->duree_heures }}h)
                                                        <span class="px-1 py-0.5 rounded
                                                            {{ $seance->TypeCours === 'P' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' }}">
                                                            {{ $seance->TypeCours === 'P' ? 'P' : 'D' }}
                                                        </span>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <p class="text-gray-600 dark:text-gray-400 text-center">Aucune séance par module pour ce formateur.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
