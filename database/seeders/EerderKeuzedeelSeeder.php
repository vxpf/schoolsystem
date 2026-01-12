<?php

namespace Database\Seeders;

use App\Models\Keuzedeel;
use App\Models\User;
use Illuminate\Database\Seeder;

class EerderKeuzedeelSeeder extends Seeder
{
    public function run(): void
    {
        $eerderKeuzedelen = [
            '1234567' => [
                ['code' => '25604K0080', 'markering' => 'x'],
                ['code' => '25604K0497', 'markering' => 'x'],
                ['code' => '25604K0722', 'markering' => 'x'],
            ],
            '1234569' => [
                ['code' => '25604K0722', 'markering' => 'pv'],
            ],
            '1234572' => [
                ['code' => '25604K0059', 'markering' => 'x'],
            ],
            '1234573' => [
                ['code' => '25604K0059', 'markering' => 'x'],
                ['code' => '25604K0497', 'markering' => 'x'],
                ['code' => '25604K0722', 'markering' => 'x'],
            ],
            '1234584' => [
                ['code' => '25604K0059', 'markering' => 'x'],
                ['code' => '25604K0497', 'markering' => 'x'],
            ],
            '1234587' => [
                ['code' => '25604K0210', 'markering' => 'x'],
            ],
        ];

        foreach ($eerderKeuzedelen as $studentNumber => $keuzedelen) {
            $user = User::where('student_number', $studentNumber)->first();
            
            if (!$user) {
                continue;
            }

            foreach ($keuzedelen as $keuzedeel) {
                $keuzedeelModel = Keuzedeel::where('code', $keuzedeel['code'])->first();
                
                if (!$keuzedeelModel) {
                    continue;
                }

                $user->keuzedelen()->attach($keuzedeelModel->id, [
                    'status' => 'voltooid',
                    'eerder_gedaan' => true,
                    'eerder_markering' => $keuzedeel['markering'],
                ]);
            }
        }
    }
}
