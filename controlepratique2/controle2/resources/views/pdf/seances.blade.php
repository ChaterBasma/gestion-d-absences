<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapport des séances validées</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #1a1a1a;
        }
        .header p {
            font-size: 10px;
            color: #666;
        }
        .period {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #333;
        }
        table td {
            padding: 8px;
            border: 1px solid #ddd;
            border-bottom: 1px solid #999;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f5f5f5;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 9px;
            color: #999;
        }
        .summary {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f0f0f0;
            border-left: 3px solid #4CAF50;
        }
        .summary p {
            margin: 5px 0;
            font-size: 10px;
        }
        .type-p {
            background-color: #e3f2fd;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 9px;
        }
        .type-d {
            background-color: #e8f5e9;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Rapport des Séances Validées</h1>
            <p>Établissement de Formation</p>
        </div>

        <div class="period">
            Période: {{ \Carbon\Carbon::parse($date1)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($date2)->format('d/m/Y') }}
        </div>

        <div class="summary">
            <p><strong>Nombre total de séances:</strong> {{ $seances->count() }}</p>
            <p><strong>Durée totale:</strong> {{ $seances->sum('Duree') }} minutes ({{ round($seances->sum('Duree') / 60, 2) }} heures)</p>
            <p><strong>Date du rapport:</strong> {{ now()->format('d/m/Y à H:i') }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="8%">N° Séance</th>
                    <th width="12%">Formateur</th>
                    <th width="10%">Groupe</th>
                    <th width="8%">Module</th>
                    <th width="7%">Type</th>
                    <th width="12%">Jour</th>
                    <th width="12%">Horaires</th>
                    <th width="8%">Durée</th>
                    <th width="7%">Absents</th>
                </tr>
            </thead>
            <tbody>
                @forelse($seances as $seance)
                    <tr>
                        <td>{{ $seance->NumS }}</td>
                        <td>
                            {{ $seance->formateur->Nom ?? '—' }}
                            <br/>
                            <span style="font-size: 9px; color: #666;">{{ $seance->formateur->Prenom ?? '—' }}</span>
                        </td>
                        <td>{{ $seance->groupe->Libelle ?? '—' }}</td>
                        <td>{{ $seance->module->CodeM ?? '—' }}</td>
                        <td>
                            <span class="{{ $seance->TypeCours === 'P' ? 'type-p' : 'type-d' }}">
                                {{ $seance->TypeCours === 'P' ? 'Présentielle' : 'Distancielle' }}
                            </span>
                        </td>
                        <td>{{ $seance->Jour }}</td>
                        <td>{{ $seance->HeureD }} - {{ $seance->HeureF }}</td>
                        <td style="text-align: center;">{{ $seance->Duree }} min</td>
                        <td style="text-align: center;">{{ $seance->EffAbsent ?? 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 20px; color: #999;">
                            Aucune séance validée pour cette période
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>Ce document a été généré automatiquement le {{ now()->format('d/m/Y à H:i:s') }}</p>
            <p>Seules les séances validées par la Direction sont affichées</p>
        </div>
    </div>
</body>
</html>
