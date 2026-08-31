<?php

namespace Tests\Feature;

use App\Models\Groupe;
use App\Models\Stagiaire;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbsenceSeanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['role' => 'admin']));
    }

    public function test_api_returns_stagiaires_for_groupe()
    {
        $groupe = Groupe::factory()->create();
        $stagiaires = Stagiaire::factory()->count(3)->create(['CodeG' => $groupe->CodeG]);

        $response = $this->getJson("/api/groupes/{$groupe->CodeG}/stagiaires");

        $response->assertOk();
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            '*' => ['CodeS', 'Prenom', 'Nom', 'email']
        ]);
    }

    public function test_absences_are_created_with_seance()
    {
        $groupe = Groupe::factory()->create();
        $stagiaires = Stagiaire::factory()->count(3)->create(['CodeG' => $groupe->CodeG]);
        $formateur = \App\Models\Formateur::factory()->create();
        $module = \App\Models\Module::factory()->create();

        $response = $this->post(route('seances.store'), [
            'NumS' => 'S001',
            'Matricule' => $formateur->Matricule,
            'CodeG' => $groupe->CodeG,
            'CodeM' => $module->CodeM,
            'TypeCours' => 'P',
            'Jour' => '2026-01-21',
            'HeureD' => '09:00',
            'HeureF' => '11:00',
            'Duree' => 120,
            'EffAbsent' => 2,
            'absences' => [
                $stagiaires[0]->CodeS,
                $stagiaires[1]->CodeS,
            ]
        ]);

        $response->assertRedirect(route('seances.index'));

        // Vérifier que les absences ont été créées
        $this->assertDatabaseCount('absences', 2);
        $this->assertDatabaseHas('absences', [
            'CodeS' => $stagiaires[0]->CodeS,
            'NumS' => 'S001',
            'Duree' => 120
        ]);
    }

    public function test_absences_are_updated_with_seance()
    {
        $groupe = Groupe::factory()->create();
        $stagiaires = Stagiaire::factory()->count(4)->create(['CodeG' => $groupe->CodeG]);
        $seance = \App\Models\Seance::factory()->create(['CodeG' => $groupe->CodeG]);

        // Créer des absences initiales
        \App\Models\Absence::create([
            'CodeS' => $stagiaires[0]->CodeS,
            'NumS' => $seance->NumS,
            'Jour' => $seance->Jour,
            'Duree' => $seance->Duree
        ]);

        // Mettre à jour avec de nouvelles absences
        $response = $this->put(route('seances.update', $seance), [
            'NumS' => $seance->NumS,
            'Matricule' => $seance->Matricule,
            'CodeG' => $seance->CodeG,
            'CodeM' => $seance->CodeM,
            'TypeCours' => $seance->TypeCours,
            'Jour' => $seance->Jour,
            'HeureD' => $seance->HeureD,
            'HeureF' => $seance->HeureF,
            'Duree' => $seance->Duree,
            'EffAbsent' => 3,
            'absences' => [
                $stagiaires[1]->CodeS,
                $stagiaires[2]->CodeS,
                $stagiaires[3]->CodeS,
            ]
        ]);

        // Vérifier que les anciennes absences ont été supprimées et remplacées
        $this->assertDatabaseCount('absences', 3);
        $this->assertDatabaseMissing('absences', [
            'CodeS' => $stagiaires[0]->CodeS,
            'NumS' => $seance->NumS,
        ]);
        $this->assertDatabaseHas('absences', [
            'CodeS' => $stagiaires[1]->CodeS,
            'NumS' => $seance->NumS,
        ]);
    }
}
