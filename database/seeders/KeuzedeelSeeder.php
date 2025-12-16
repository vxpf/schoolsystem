<?php

namespace Database\Seeders;

use App\Models\Keuzedeel;
use Illuminate\Database\Seeder;

class KeuzedeelSeeder extends Seeder
{
    public function run(): void
    {
        $keuzedelen = [
            [
                'naam' => 'Duurzaamheid in de techniek',
                'beschrijving' => 'Leer over duurzame technologieën en hoe je als technicus kunt bijdragen aan een groenere toekomst. Je maakt kennis met circulaire economie, energiebesparing en milieuvriendelijke materialen.',
                'code' => 'K0877',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 25,
                'actief' => true,
            ],
            [
                'naam' => 'Ondernemend gedrag',
                'beschrijving' => 'Ontwikkel ondernemersvaardigheden die je nodig hebt om succesvol te zijn in je carrière. Van businessplannen schrijven tot netwerken en presenteren.',
                'code' => 'K0205',
                'studiepunten' => 240,
                'niveau' => 'MBO 3-4',
                'max_studenten' => 30,
                'actief' => true,
            ],
            [
                'naam' => 'Digitale vaardigheden gevorderd',
                'beschrijving' => 'Verbeter je digitale skills met geavanceerde software, data-analyse en digitale communicatie. Essentieel voor de moderne werkomgeving.',
                'code' => '25604K0059',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 20,
                'actief' => true,
            ],
            [
                'naam' => 'ARBO, kwaliteitszorg en hulpverlening',
                'beschrijving' => 'Leer alles over veilig werken, kwaliteitsmanagement en EHBO. Belangrijke kennis voor elke technische professional.',
                'code' => '25604K0080',
                'studiepunten' => 240,
                'niveau' => 'MBO 3-4',
                'max_studenten' => 35,
                'actief' => true,
            ],
            [
                'naam' => 'Verdieping software',
                'beschrijving' => 'Verdiep je in softwareontwikkeling met moderne programmeertalen en frameworks. Van web development tot mobile apps.',
                'code' => '25604K0210',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 20,
                'actief' => true,
            ],
            [
                'naam' => 'Assembleren van producten',
                'beschrijving' => 'Word expert in het assembleren van technische producten. Leer werken met technische tekeningen en kwaliteitscontrole.',
                'code' => '25604K0497',
                'studiepunten' => 240,
                'niveau' => 'MBO 3',
                'max_studenten' => 25,
                'actief' => true,
            ],
            [
                'naam' => 'Industriële automatisering',
                'beschrijving' => 'Ontdek de wereld van industriële automatisering met PLC-programmering, sensoren en actuatoren. De toekomst van de maakindustrie.',
                'code' => '25604K0505',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 18,
                'actief' => true,
            ],
            [
                'naam' => 'Elektrotechniek basis',
                'beschrijving' => 'Basiskennis elektrotechniek voor de technische professional. Schakelingen, metingen en veilig werken met elektriciteit.',
                'code' => '25604K0722',
                'studiepunten' => 240,
                'niveau' => 'MBO 3',
                'max_studenten' => 28,
                'actief' => true,
            ],
            [
                'naam' => 'Installeren van systemen',
                'beschrijving' => 'Leer technische systemen installeren en in bedrijf stellen. Van klimaatinstallaties tot beveiligingssystemen.',
                'code' => '25604K0730',
                'studiepunten' => 240,
                'niveau' => 'MBO 3-4',
                'max_studenten' => 22,
                'actief' => true,
            ],
            [
                'naam' => 'Werken aan smart industry',
                'beschrijving' => 'Maak kennis met Industrie 4.0, IoT en smart manufacturing. De digitale transformatie van de industrie.',
                'code' => '25998K0497',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 20,
                'actief' => true,
            ],
            [
                'naam' => 'Data en cyber security',
                'beschrijving' => 'Bescherm systemen tegen cyberdreigingen. Leer over netwerkveiligheid, encryptie en ethisch hacken.',
                'code' => '25998K0722',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 15,
                'actief' => true,
            ],
            [
                'naam' => 'Energietransitie en duurzaamheid',
                'beschrijving' => 'De energietransitie vraagt om nieuwe vaardigheden. Leer over zonne-energie, warmtepompen en energieopslag.',
                'code' => '25998K0788',
                'studiepunten' => 240,
                'niveau' => 'MBO 3-4',
                'max_studenten' => 25,
                'actief' => true,
            ],
        ];

        foreach ($keuzedelen as $keuzedeel) {
            Keuzedeel::create($keuzedeel);
        }
    }
}
