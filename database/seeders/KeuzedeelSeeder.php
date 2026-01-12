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
                'wat_leer_je' => 'Je leert hoe je duurzame keuzes maakt in technische projecten. Je ontwikkelt kennis over circulaire economie, levenscyclusanalyse en CO2-reductie. Je kunt milieuvriendelijke materialen selecteren en energiebesparende oplossingen implementeren in je werk.',
                'code' => 'K0877',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 25,
                'actief' => true,
            ],
            [
                'naam' => 'Ondernemend gedrag',
                'beschrijving' => 'Ontwikkel ondernemersvaardigheden die je nodig hebt om succesvol te zijn in je carrière. Van businessplannen schrijven tot netwerken en presenteren.',
                'wat_leer_je' => 'Je ontwikkelt een ondernemende mindset en leert kansen herkennen. Je kunt een businessplan opstellen, effectief netwerken en overtuigend presenteren. Je leert omgaan met risico\'s en ontwikkelt vaardigheden om innovatieve ideeën te realiseren.',
                'code' => 'K0205',
                'studiepunten' => 240,
                'niveau' => 'MBO 3-4',
                'max_studenten' => 30,
                'actief' => true,
            ],
            [
                'naam' => 'Digitale vaardigheden gevorderd',
                'beschrijving' => 'Verbeter je digitale skills met geavanceerde software, data-analyse en digitale communicatie. Essentieel voor de moderne werkomgeving.',
                'wat_leer_je' => 'Je beheerst geavanceerde software voor data-analyse en visualisatie. Je leert werken met spreadsheets op expert niveau, databases beheren en digitale samenwerkingstools effectief inzetten. Je kunt data interpreteren en presenteren aan collega\'s.',
                'code' => '25604K0059',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 20,
                'actief' => true,
            ],
            [
                'naam' => 'ARBO, kwaliteitszorg en hulpverlening',
                'beschrijving' => 'Leer alles over veilig werken, kwaliteitsmanagement en EHBO. Belangrijke kennis voor elke technische professional.',
                'wat_leer_je' => 'Je leert risico\'s herkennen en veilig werken volgens ARBO-wetgeving. Je kunt kwaliteitssystemen toepassen en verbeterprocessen initiëren. Je bent in staat om eerste hulp te verlenen en noodsituaties adequaat af te handelen.',
                'code' => '25604K0080',
                'studiepunten' => 240,
                'niveau' => 'MBO 3-4',
                'max_studenten' => 35,
                'actief' => true,
            ],
            [
                'naam' => 'Verdieping software',
                'beschrijving' => 'Verdiep je in softwareontwikkeling met moderne programmeertalen en frameworks. Van web development tot mobile apps.',
                'wat_leer_je' => 'Je leert programmeren in moderne talen zoals Python, JavaScript of C#. Je kunt webapplicaties en mobile apps ontwikkelen met actuele frameworks. Je beheerst versiebeheer met Git en kunt samenwerken in development teams.',
                'code' => '25604K0210',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 20,
                'actief' => true,
            ],
            [
                'naam' => 'Assembleren van producten',
                'beschrijving' => 'Word expert in het assembleren van technische producten. Leer werken met technische tekeningen en kwaliteitscontrole.',
                'wat_leer_je' => 'Je leert technische tekeningen lezen en interpreteren. Je kunt producten nauwkeurig assembleren volgens specificaties en kwaliteitsnormen. Je beheerst meetinstrumenten en kunt kwaliteitscontroles uitvoeren en documenteren.',
                'code' => '25604K0497',
                'studiepunten' => 240,
                'niveau' => 'MBO 3',
                'max_studenten' => 25,
                'actief' => true,
            ],
            [
                'naam' => 'Industriële automatisering',
                'beschrijving' => 'Ontdek de wereld van industriële automatisering met PLC-programmering, sensoren en actuatoren. De toekomst van de maakindustrie.',
                'wat_leer_je' => 'Je leert PLC\'s programmeren en industriële besturingssystemen configureren. Je kunt sensoren en actuatoren aansluiten en kalibreren. Je beheerst het troubleshooten van automatiseringsproblemen en kunt productieprocessen optimaliseren.',
                'code' => '25604K0505',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 18,
                'actief' => true,
            ],
            [
                'naam' => 'Elektrotechniek basis',
                'beschrijving' => 'Basiskennis elektrotechniek voor de technische professional. Schakelingen, metingen en veilig werken met elektriciteit.',
                'wat_leer_je' => 'Je leert elektrische schakelingen ontwerpen en bouwen. Je kunt metingen uitvoeren met multimeters en oscilloscopen. Je beheerst de basisprincipes van elektriciteit en kunt veilig werken met elektrische installaties.',
                'code' => '25604K0722',
                'studiepunten' => 240,
                'niveau' => 'MBO 3',
                'max_studenten' => 28,
                'actief' => true,
            ],
            [
                'naam' => 'Installeren van systemen',
                'beschrijving' => 'Leer technische systemen installeren en in bedrijf stellen. Van klimaatinstallaties tot beveiligingssystemen.',
                'wat_leer_je' => 'Je leert technische systemen installeren volgens voorschriften en handleidingen. Je kunt installaties in bedrijf stellen en testen. Je beheerst het maken van installatiedocumentatie en kunt klanten instrueren over het gebruik.',
                'code' => '25604K0730',
                'studiepunten' => 240,
                'niveau' => 'MBO 3-4',
                'max_studenten' => 22,
                'actief' => true,
            ],
            [
                'naam' => 'Werken aan smart industry',
                'beschrijving' => 'Maak kennis met Industrie 4.0, IoT en smart manufacturing. De digitale transformatie van de industrie.',
                'wat_leer_je' => 'Je leert werken met IoT-sensoren en data-acquisitie systemen. Je kunt productiedata analyseren en visualiseren. Je beheerst de principes van Industrie 4.0 en kunt bijdragen aan de digitale transformatie van productieprocessen.',
                'code' => '25998K0497',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 20,
                'actief' => true,
            ],
            [
                'naam' => 'Data en cyber security',
                'beschrijving' => 'Bescherm systemen tegen cyberdreigingen. Leer over netwerkveiligheid, encryptie en ethisch hacken.',
                'wat_leer_je' => 'Je leert netwerken beveiligen tegen cyberaanvallen. Je kunt kwetsbaarheden identificeren en beveiligingsmaatregelen implementeren. Je beheerst encryptietechnieken en kunt security audits uitvoeren volgens ethische richtlijnen.',
                'code' => '25998K0722',
                'studiepunten' => 240,
                'niveau' => 'MBO 4',
                'max_studenten' => 15,
                'actief' => true,
            ],
            [
                'naam' => 'Energietransitie en duurzaamheid',
                'beschrijving' => 'De energietransitie vraagt om nieuwe vaardigheden. Leer over zonne-energie, warmtepompen en energieopslag.',
                'wat_leer_je' => 'Je leert werken met zonnepanelen, warmtepompen en batterijsystemen. Je kunt energieverbruik analyseren en besparingsadviezen geven. Je beheerst de installatie en onderhoud van duurzame energiesystemen.',
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
