<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une affectation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('affectations.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="Matricule" class="block text-sm font-medium mb-2">Formateur *</label>
                            <select id="Matricule" name="Matricule"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($formateurs as $formateur)
                                    <option value="{{ $formateur->Matricule }}" {{ old('Matricule') == $formateur->Matricule ? 'selected' : '' }}>
                                        {{ $formateur->Nom }} {{ $formateur->Prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Matricule')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="CodeG" class="block text-sm font-medium mb-2">Groupe *</label>
                            <select id="CodeG" name="CodeG"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($groupes as $groupe)
                                    <option value="{{ $groupe->CodeG }}" {{ old('CodeG') == $groupe->CodeG ? 'selected' : '' }}>
                                        {{ $groupe->Libelle }}
                                    </option>
                                @endforeach
                            </select>
                            @error('CodeG')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="CodeM" class="block text-sm font-medium mb-2">Module *</label>
                            <select id="CodeM" name="CodeM"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->CodeM }}" {{ old('CodeM') == $module->CodeM ? 'selected' : '' }}>
                                        {{ $module->CodeM }}
                                    </option>
                                @endforeach
                            </select>
                            @error('CodeM')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="MHRealiseP" class="block text-sm font-medium mb-2">MH Réalisée Pratique *</label>
                                <input type="number" id="MHRealiseP" name="MHRealiseP" value="{{ old('MHRealiseP') }}" step="0.01" min="0"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                    required>
                                @error('MHRealiseP')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="MHRealiseD" class="block text-sm font-medium mb-2">MH Réalisée Dirigée *</label>
                                <input type="number" id="MHRealiseD" name="MHRealiseD" value="{{ old('MHRealiseD') }}" step="0.01" min="0"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                    required>
                                @error('MHRealiseD')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Créer
                            </button>
                            <a href="{{ route('affectations.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
