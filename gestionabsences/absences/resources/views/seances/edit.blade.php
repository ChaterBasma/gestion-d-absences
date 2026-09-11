<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier la séance') }} {{ $seance->NumS }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('seances.update', $seance) }}">
                        @csrf
                        @method('PUT')

                        <!-- N° Séance -->
                        <div class="mb-4">
                            <label for="NumS" class="block text-sm font-medium mb-2">N° Séance *</label>
                            <input type="text" id="NumS" name="NumS" value="{{ old('NumS', $seance->NumS) }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                            @error('NumS')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Formateur -->
                        <div class="mb-4">
                            <label for="Matricule" class="block text-sm font-medium mb-2">Formateur *</label>
                            <select id="Matricule" name="Matricule"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner un formateur --</option>
                                @foreach($formateurs as $formateur)
                                    <option value="{{ $formateur->Matricule }}"
                                        {{ old('Matricule', $seance->Matricule) == $formateur->Matricule ? 'selected' : '' }}>
                                        {{ $formateur->Nom }} {{ $formateur->Prenom }} ({{ $formateur->Matricule }})
                                    </option>
                                @endforeach
                            </select>
                            @error('Matricule')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Groupe -->
                        <div class="mb-4">
                            <label for="CodeG" class="block text-sm font-medium mb-2">Groupe *</label>
                            <select id="CodeG" name="CodeG"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner un groupe --</option>
                                @foreach($groupes as $groupe)
                                    <option value="{{ $groupe->CodeG }}"
                                        {{ old('CodeG', $seance->CodeG) == $groupe->CodeG ? 'selected' : '' }}>
                                        {{ $groupe->Libelle }} ({{ $groupe->CodeG }})
                                    </option>
                                @endforeach
                            </select>
                            @error('CodeG')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Module -->
                        <div class="mb-4">
                            <label for="CodeM" class="block text-sm font-medium mb-2">Module *</label>
                            <select id="CodeM" name="CodeM"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                required>
                                <option value="">-- Sélectionner un module --</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->CodeM }}"
                                        {{ old('CodeM', $seance->CodeM) == $module->CodeM ? 'selected' : '' }}>
                                        {{ $module->CodeM }}
                                    </option>
                                @endforeach
                            </select>
                            @error('CodeM')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Type de cours -->
                        <div class="mb-4">
                            <label for="TypeCours" class="block text-sm font-medium mb-2">Type de cours *</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="TypeCours" value="P" {{ old('TypeCours', $seance->TypeCours) == 'P' ? 'checked' : '' }} required>
                                    <span class="ml-2">Présentielle</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="TypeCours" value="D" {{ old('TypeCours', $seance->TypeCours) == 'D' ? 'checked' : '' }} required>
                                    <span class="ml-2">Distancielle</span>
                                </label>
                            </div>
                            @error('TypeCours')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Jour -->
                        <div class="mb-4">
                            <label for="Jour" class="block text-sm font-medium mb-2">Jour *</label>
                            <input type="text" id="Jour" name="Jour" value="{{ old('Jour', $seance->Jour) }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                placeholder="ex: Lundi 15/01/2026"
                                required>
                            @error('Jour')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Heures -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="HeureD" class="block text-sm font-medium mb-2">Heure de début *</label>
                                <input type="time" id="HeureD" name="HeureD" value="{{ old('HeureD', $seance->HeureD) }}"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                    required>
                                @error('HeureD')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="HeureF" class="block text-sm font-medium mb-2">Heure de fin *</label>
                                <input type="time" id="HeureF" name="HeureF" value="{{ old('HeureF', $seance->HeureF) }}"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700"
                                    required>
                                @error('HeureF')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Durée (calculée automatiquement en heures) -->
                        <div class="mb-4">
                            <label for="DureeHeures" class="block text-sm font-medium mb-2">Durée (heures) - Calculée automatiquement</label>
                            <input type="number" id="DureeHeures" name="DureeHeures" value="{{ old('DureeHeures', round($seance->Duree / 60, 2)) }}" step="0.25"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 bg-gray-100 dark:bg-gray-600"
                                readonly>
                            <!-- Champ caché pour stocker les minutes -->
                            <input type="hidden" id="Duree" name="Duree" value="{{ old('Duree', $seance->Duree) }}">
                            @error('Duree')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nombre d'absents -->
                        <div class="mb-4">
                            <label for="EffAbsent" class="block text-sm font-medium mb-2">Nombre d'absents</label>
                            <input type="number" id="EffAbsent" name="EffAbsent" value="{{ old('EffAbsent', $seance->EffAbsent) }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700">
                            @error('EffAbsent')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Sélection des stagiaires absents -->
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600">
                            <label class="block text-sm font-medium mb-4">Sélectionner les stagiaires absents</label>
                            
                            <div id="stagiaires-container" class="space-y-2 max-h-64 overflow-y-auto">
                                <p class="text-gray-500 dark:text-gray-400 text-sm italic">
                                    Chargement...
                                </p>
                            </div>

                            @error('absences')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                Mettre à jour
                            </button>
                            <a href="{{ route('seances.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Stockage des absences actuelles
        const currentAbsences = {!! json_encode($seance->absences()->pluck('CodeS')->toArray()) !!};

        // Calculer automatiquement la durée en fonction de HeureD et HeureF
        function calculerDuree() {
            const heureD = document.getElementById('HeureD').value;
            const heureF = document.getElementById('HeureF').value;
            const dureeHeuresInput = document.getElementById('DureeHeures');
            const dureeInput = document.getElementById('Duree');

            if (heureD && heureF) {
                // Convertir les heures en minutes
                const [hD, mD] = heureD.split(':').map(Number);
                const [hF, mF] = heureF.split(':').map(Number);
                
                const minutesD = hD * 60 + mD;
                const minutesF = hF * 60 + mF;
                
                // Calculer la différence
                let duree = minutesF - minutesD;
                
                // Si la durée est négative, ajouter 24 heures (pour les cours qui se terminent le lendemain)
                if (duree < 0) {
                    duree += 24 * 60;
                }
                
                // Stocker les minutes dans le champ caché
                dureeInput.value = Math.round(duree);
                
                // Afficher les heures à l'utilisateur
                const heures = Math.round(duree) / 60;
                dureeHeuresInput.value = Math.round(heures * 100) / 100;  // Arrondir à 2 décimales
            }
        }

        // Charger les stagiaires du groupe sélectionné
        async function chargerStagiaires() {
            const codeG = document.getElementById('CodeG').value;
            const container = document.getElementById('stagiaires-container');
            
            if (!codeG) {
                container.innerHTML = '<p class="text-gray-500 dark:text-gray-400 text-sm italic">Veuillez sélectionner un groupe pour voir la liste des stagiaires.</p>';
                return;
            }
            
            try {
                const response = await fetch(`/api/groupes/${codeG}/stagiaires`);
                const stagiaires = await response.json();
                
                if (stagiaires.length === 0) {
                    container.innerHTML = '<p class="text-gray-500 dark:text-gray-400 text-sm italic">Aucun stagiaire dans ce groupe.</p>';
                    return;
                }
                
                let html = '';
                stagiaires.forEach(stagiaire => {
                    const isChecked = currentAbsences.includes(stagiaire.CodeS) ? 'checked' : '';
                    html += `
                        <label class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 rounded cursor-pointer">
                            <input type="checkbox" name="absences[]" value="${stagiaire.CodeS}" ${isChecked}
                                class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500"
                                data-duree="${document.getElementById('Duree').value || 0}">
                            <span class="ml-3 text-sm">${stagiaire.Prenom} ${stagiaire.Nom} (${stagiaire.CodeS})</span>
                        </label>
                    `;
                });
                
                container.innerHTML = html;
            } catch (error) {
                console.error('Erreur lors du chargement des stagiaires:', error);
                container.innerHTML = '<p class="text-red-500 text-sm">Erreur lors du chargement des stagiaires.</p>';
            }
        }

        // Mettre à jour le nombre d'absents automatiquement
        function mettreAJourEffAbsent() {
            const checkboxes = document.querySelectorAll('input[name="absences[]"]:checked');
            document.getElementById('EffAbsent').value = checkboxes.length;
        }

        // Ajouter les listeners
        document.getElementById('HeureD').addEventListener('change', calculerDuree);
        document.getElementById('HeureF').addEventListener('change', calculerDuree);
        document.getElementById('CodeG').addEventListener('change', chargerStagiaires);
        document.addEventListener('change', function(e) {
            if (e.target.name === 'absences[]') {
                mettreAJourEffAbsent();
            }
        });

        // Charger les stagiaires au chargement de la page
        window.addEventListener('DOMContentLoaded', function() {
            chargerStagiaires();
        });
    </script>
</x-app-layout>
