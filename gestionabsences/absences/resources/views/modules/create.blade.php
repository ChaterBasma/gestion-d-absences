<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer un module') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('modules.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="CodeM" class="block text-sm font-medium mb-2">Code *</label>
                            <input type="text" id="CodeM" name="CodeM" value="{{ old('CodeM') }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                            @error('CodeM')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="CodeF" class="block text-sm font-medium mb-2">Filière *</label>
                            <select id="CodeF" name="CodeF"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->CodeF }}" {{ old('CodeF') == $filiere->CodeF ? 'selected' : '' }}>
                                        {{ $filiere->Libelle }}
                                    </option>
                                @endforeach
                            </select>
                            @error('CodeF')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div>
                                <label for="MHP" class="block text-sm font-medium mb-2">MHP (heures) *</label>
                                <input type="number" id="MHP" name="MHP" value="{{ old('MHP', 0) }}" min="0" step="0.5"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                    oninput="calculerMHG()"
                                    required>
                                @error('MHP')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="MHD" class="block text-sm font-medium mb-2">MHD (heures) *</label>
                                <input type="number" id="MHD" name="MHD" value="{{ old('MHD', 0) }}" min="0" step="0.5"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                    oninput="calculerMHG()"
                                    required>
                                @error('MHD')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="MHG" class="block text-sm font-medium mb-2">MHG (heures) - Calculée</label>
                                <input type="number" id="MHG" name="MHG" value="{{ old('MHG', 0) }}" step="0.5" readonly
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 bg-gray-100 dark:bg-gray-600">
                                @error('MHG')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="coef" class="block text-sm font-medium mb-2">Coefficient *</label>
                            <select id="coef" name="coef"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner --</option>
                                <option value="1" {{ old('coef') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('coef') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('coef') == '3' ? 'selected' : '' }}>3</option>
                            </select>
                            @error('coef')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Créer
                            </button>
                            <a href="{{ route('modules.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculerMHG() {
            const mhp = parseInt(document.getElementById('MHP').value) || 0;
            const mhd = parseInt(document.getElementById('MHD').value) || 0;
            document.getElementById('MHG').value = mhp + mhd;
        }
    </script>
</x-app-layout>
