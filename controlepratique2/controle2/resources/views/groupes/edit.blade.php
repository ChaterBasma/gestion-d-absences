<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier un groupe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('groupes.update', $groupe) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="CodeG" class="block text-sm font-medium mb-2">Code (lecture seule)</label>
                            <input type="text" id="CodeG" value="{{ $groupe->CodeG }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 bg-gray-100"
                                disabled>
                        </div>

                        <div class="mb-4">
                            <label for="CodeF" class="block text-sm font-medium mb-2">Filière *</label>
                            <select id="CodeF" name="CodeF"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                @foreach($filieres as $filiere)
                                    <option value="{{ $filiere->CodeF }}" {{ old('CodeF', $groupe->CodeF) == $filiere->CodeF ? 'selected' : '' }}>
                                        {{ $filiere->Libelle }}
                                    </option>
                                @endforeach
                            </select>
                            @error('CodeF')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="Libelle" class="block text-sm font-medium mb-2">Libellé *</label>
                            <input type="text" id="Libelle" name="Libelle" value="{{ old('Libelle', $groupe->Libelle) }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                            @error('Libelle')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Mettre à jour
                            </button>
                            <a href="{{ route('groupes.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
