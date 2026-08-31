<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Importer des données (CSV)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('warning') }}
                    @if(session('import_errors'))
                        <div class="mt-3 text-sm">
                            <strong>Erreurs détectées:</strong>
                            <ul class="mt-2 space-y-1">
                                @foreach(session('import_errors') as $error)
                                    <li class="text-xs">• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('import.process') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Type de données -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium mb-2">Type de données à importer *</label>
                            <select id="type" name="type"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                onchange="updateFormatInfo()"
                                required>
                                <option value="">-- Sélectionner --</option>
                                <option value="formateurs" {{ old('type') === 'formateurs' ? 'selected' : '' }}>
                                    Formateurs (Matricule, Nom, Prenom, Email)
                                </option>
                                <option value="seances" {{ old('type') === 'seances' ? 'selected' : '' }}>
                                    Séances (NumS, Matricule, CodeG, CodeM, TypeCours, Jour, HeureD, HeureF, Duree, EffAbsent)
                                </option>
                                <option value="affectations" {{ old('type') === 'affectations' ? 'selected' : '' }}>
                                    Affectations (Matricule, CodeG, CodeM, MHRealiseP*, MHRealiseD*)
                                </option>
                            </select>
                            @error('type')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fichier -->
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium mb-2">Fichier CSV *</label>
                            <input type="file" id="file" name="file" accept=".csv,.txt"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                                Format accepté: CSV ou TXT (max 10 MB)
                            </p>
                            @error('file')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Avertissement -->
                        <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900 rounded-lg border border-yellow-200 dark:border-yellow-700">
                            <p class="text-yellow-800 dark:text-yellow-200 text-sm">
                                ⚠️ <strong>Important:</strong> Assurez-vous que votre fichier CSV respecte le format attendu avec les bons séparateurs (virgules).
                                Les lignes en erreur seront ignorées et un rapport sera affiché.
                            </p>
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Importer
                            </button>
                            <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Annuler
                            </a>
                        </div>
                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFormatInfo() {
            // Le format est déjà affiché statiquement, pas besoin d'update
        }
    </script>
</x-app-layout>
