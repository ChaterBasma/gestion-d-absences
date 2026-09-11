<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">
                        Bienvenue, {{ Auth::user()->name }}!
                    </h3>
                    <p class="mb-6 text-gray-600 dark:text-gray-400">
                        Vous êtes connecté en tant que 
                        <strong>
                            @if(Auth::user()->role === 'admin')
                                Administrateur
                            @elseif(Auth::user()->role === 'F')
                                Formateur
                            @elseif(Auth::user()->role === 'D')
                                Direction
                            @endif
                        </strong>
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'D')
                            <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg border border-blue-200 dark:border-blue-700">
                                <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Filieres</h4>
                                <p class="text-blue-700 dark:text-blue-300 mb-4">Gérez les filières de formation</p>
                                <a href="{{ route('filieres.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Accéder
                                </a>
                            </div>

                            <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg border border-green-200 dark:border-green-700">
                                <h4 class="font-semibold text-green-900 dark:text-green-100 mb-2">Groupes</h4>
                                <p class="text-green-700 dark:text-green-300 mb-4">Gérez les groupes d'étudiants</p>
                                <a href="{{ route('groupes.index') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                                    Accéder
                                </a>
                            </div>

                            <div class="bg-purple-50 dark:bg-purple-900 p-6 rounded-lg border border-purple-200 dark:border-purple-700">
                                <h4 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">Modules</h4>
                                <p class="text-purple-700 dark:text-purple-300 mb-4">Gérez les modules de formation</p>
                                <a href="{{ route('modules.index') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                                    Accéder
                                </a>
                            </div>

                            <div class="bg-orange-50 dark:bg-orange-900 p-6 rounded-lg border border-orange-200 dark:border-orange-700">
                                <h4 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">Formateurs</h4>
                                <p class="text-orange-700 dark:text-orange-300 mb-4">Gérez les formateurs</p>
                                <a href="{{ route('formateurs.index') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded">
                                    Accéder
                                </a>
                            </div>
                        @endif

                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'F' || Auth::user()->role === 'D')
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-6 rounded-lg border border-indigo-200 dark:border-indigo-700">
                                <h4 class="font-semibold text-indigo-900 dark:text-indigo-100 mb-2">Séances</h4>
                                <p class="text-indigo-700 dark:text-indigo-300 mb-4">Gérez les séances de formation</p>
                                <a href="{{ route('seances.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                                    Accéder
                                </a>
                            </div>

                            <div class="bg-red-50 dark:bg-red-900 p-6 rounded-lg border border-red-200 dark:border-red-700">
                                <h4 class="font-semibold text-red-900 dark:text-red-100 mb-2">Affectations</h4>
                                <p class="text-red-700 dark:text-red-300 mb-4">Gérez les affectations</p>
                                <a href="{{ route('affectations.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                    Accéder
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
