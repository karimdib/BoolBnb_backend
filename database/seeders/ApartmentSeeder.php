<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $json = File::get("database/data/convertedAddressList.json");
        $apartments = json_decode($json);

        $apartmentsArray = [
            [
                'nome' => 'Villa Serenità',
                'descrizione' => 'Una lussuosa villa con ampi giardini, piscina privata e vista mozzafiato sulle montagne. Un rifugio di pace e comfort.',
                'stanze' => 5,
                'letti' => 8,
                'bagni' => 4,
                'metriQuadrati' => 400,
            ],
            [
                'nome' => 'Appartamento Charme',
                'descrizione' => 'Un elegante appartamento urbano con arredi raffinati e dettagli di charme. L\'ambiente perfetto per un soggiorno chic e confortevole.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 2,
                'metriQuadrati' => 120,
            ],
            [
                'nome' => 'Suite Panoramica',
                'descrizione' => 'Una suite di lusso con finestre a tutta altezza che offrono una vista spettacolare sulla città. Atmosfera raffinata e servizi esclusivi.',
                'stanze' => 3,
                'letti' => 6,
                'bagni' => 3,
                'metriQuadrati' => 180,
            ],
            [
                'nome' => 'Casa del Sole',
                'descrizione' => 'Una casa accogliente e luminosa, ideale per chi cerca un rifugio sereno. Interni soleggiati e atmosfera calorosa.',
                'stanze' => 4,
                'letti' => 5,
                'bagni' => 2,
                'metriQuadrati' => 150,
            ],
            [
                'nome' => 'Residenza Elegante',
                'descrizione' => 'Una residenza di classe con arredi sofisticati e servizi di alta qualità. Il luogo perfetto per un soggiorno di lusso e raffinatezza.',
                'stanze' => 6,
                'letti' => 10,
                'bagni' => 5,
                'metriQuadrati' => 500,
            ],
            [
                'nome' => 'Chalet Montano',
                'descrizione' => 'Un affascinante chalet di montagna con caminetto, arredi in legno e una calda atmosfera alpina. Un\'esperienza accogliente e autentica.',
                'stanze' => 3,
                'letti' => 6,
                'bagni' => 2,
                'metriQuadrati' => 160,
            ],
            [
                'nome' => 'Loft Artistico',
                'descrizione' => 'Uno spazio aperto e moderno, decorato con opere d\'arte uniche e design contemporaneo. Ideale per gli amanti dell\'arte e della creatività.',
                'stanze' => 1,
                'letti' => 2,
                'bagni' => 1,
                'metriQuadrati' => 80,
            ],
            [
                'nome' => 'Dimora del Mare',
                'descrizione' => 'Una splendida dimora fronte mare con accesso diretto alla spiaggia e interni eleganti. Un\'oasi di relax e romanticismo.',
                'stanze' => 4,
                'letti' => 7,
                'bagni' => 3,
                'metriQuadrati' => 220,
            ],
            [
                'nome' => 'Reggia Raffinata',
                'descrizione' => 'Una regale dimora con interni sontuosi, dettagli dorati e comfort regali. Per chi cerca un\'esperienza di soggiorno regale e indimenticabile.',
                'stanze' => 7,
                'letti' => 12,
                'bagni' => 6,
                'metriQuadrati' => 600,
            ],
            [
                'nome' => 'Attico di Lusso',
                'descrizione' => 'Un attico esclusivo con terrazza panoramica, jacuzzi privata e arredi di lusso. Un rifugio di prestigio con vista sulla città.',
                'stanze' => 2,
                'letti' => 3,
                'bagni' => 2,
                'metriQuadrati' => 130,
            ],
            [
                'nome' => 'Bungalow Zen',
                'descrizione' => 'Un rifugio tranquillo immerso nella natura, con giardino zen e spazi per la meditazione. Perfetto per chi cerca calma e serenità.',
                'stanze' => 1,
                'letti' => 1,
                'bagni' => 1,
                'metriQuadrati' => 60,
            ],
            [
                'nome' => 'Rifugio Tranquillo',
                'descrizione' => 'Un rifugio sereno circondato dalla natura, ideale per una fuga dal caos quotidiano. Atmosfera rilassante e contatto diretto con la natura.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 1,
                'metriQuadrati' => 100,
            ],
            [
                'nome' => 'Palazzo del Giardino',
                'descrizione' => 'Un elegante palazzo con giardini lussureggianti, fontane e angoli romantici. Un\'oasi di bellezza e tranquillità in città.',
                'stanze' => 8,
                'letti' => 14,
                'bagni' => 5,
                'metriQuadrati' => 700,
            ],
            [
                'nome' => 'Oasi Urbana',
                'descrizione' => 'Un\'oasi di pace nel cuore della città, con interni moderni e servizi di prima classe. La combinazione perfetta tra comfort urbano e relax.',
                'stanze' => 3,
                'letti' => 5,
                'bagni' => 2,
                'metriQuadrati' => 140,
            ],
            [
                'nome' => 'Mansarda Chic',
                'descrizione' => 'Una mansarda alla moda con dettagli di design, ampi lucernari e atmosfera chic. L\'ideale per chi cerca un soggiorno elegante e contemporaneo.',
                'stanze' => 1,
                'letti' => 2,
                'bagni' => 1,
                'metriQuadrati' => 90,
            ],
            [
                'nome' => 'Casetta Romantica',
                'descrizione' => 'Una casetta dall\'atmosfera romantica con camino, arredi accoglienti e dettagli shabby-chic. Perfetta per fuga romantica e intimità.',
                'stanze' => 2,
                'letti' => 3,
                'bagni' => 1,
                'metriQuadrati' => 70,
            ],
            [
                'nome' => 'Nido d\'Amore',
                'descrizione' => 'Un rifugio intimo per coppie, con dettagli romantici e atmosfera calorosa. Il luogo perfetto per celebrare l\'amore e la complicità.',
                'stanze' => 1,
                'letti' => 1,
                'bagni' => 1,
                'metriQuadrati' => 50,
            ],
            [
                'nome' => 'Stanza con Vista',
                'descrizione' => 'Una confortevole stanza con vista panoramica sulla città o sulla campagna circostante. Un soggiorno con una vista mozzafiato.',
                'stanze' => 1,
                'letti' => 2,
                'bagni' => 1,
                'metriQuadrati' => 60,
            ],
            [
                'nome' => 'Cottage di Campagna',
                'descrizione' => 'Un cottage affascinante immerso nella campagna con soffitti a travi, camino e mobili rustici. Un ritiro accogliente e pittoresco.',
                'stanze' => 3,
                'letti' => 5,
                'bagni' => 2,
                'metriQuadrati' => 120,
            ],
            [
                'nome' => 'Appartamento Vintage',
                'descrizione' => 'Un appartamento dal fascino retrò con arredi vintage e dettagli d\'epoca. Per chi ama lo stile del passato con comfort moderni.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 2,
                'metriQuadrati' => 110,
            ],
            [
                'nome' => 'Chalet Rustico',
                'descrizione' => 'Un chalet di montagna con atmosfera rustica, travi a vista e camino a legna. Il luogo ideale per un\'esperienza montana autentica.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 1,
                'metriQuadrati' => 100,
            ],
            [
                'nome' => 'Suite del Bosco',
                'descrizione' => 'Una suite immersa nella natura con viste boschive, arredi ispirati alla natura e tranquillità assoluta. Il rifugio perfetto per gli amanti della natura.',
                'stanze' => 1,
                'letti' => 2,
                'bagni' => 1,
                'metriQuadrati' => 80,
            ],
            [
                'nome' => 'Monolocale Moderno',
                'descrizione' => 'Un monolocale dal design contemporaneo con attrezzature moderne e atmosfera minimalista. Perfetto per chi cerca uno spazio moderno e funzionale.',
                'stanze' => 1,
                'letti' => 1,
                'bagni' => 1,
                'metriQuadrati' => 50,
            ],
            [
                'nome' => 'Villetta sul Lago',
                'descrizione' => 'Una villetta affacciata su un pittoresco lago con terrazza privata e accesso diretto all\'acqua. Un paradiso per gli amanti della vista sul lago.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 2,
                'metriQuadrati' => 120,
            ],
            [
                'nome' => 'Appartamento di Design',
                'descrizione' => 'Un appartamento progettato con cura, con arredi di design e dettagli innovativi. L\'ideale per chi apprezza la creatività e lo stile moderno.',
                'stanze' => 2,
                'letti' => 3,
                'bagni' => 2,
                'metriQuadrati' => 110,
            ],
            [
                'nome' => 'Casale Autentico',
                'descrizione' => 'Un casale di campagna autentico con cortile interno, giardino e arredi tradizionali. Un ritorno alle radici in un ambiente accogliente.',
                'stanze' => 4,
                'letti' => 6,
                'bagni' => 3,
                'metriQuadrati' => 180,
            ],
            [
                'nome' => 'Penthouse Esclusivo',
                'descrizione' => 'Un penthouse di lusso con terrazza panoramica, piscina privata e servizi di prima classe. Una dimora di prestigio con vista sulla città.',
                'stanze' => 3,
                'letti' => 5,
                'bagni' => 3,
                'metriQuadrati' => 200,
            ],
            [
                'nome' => 'Villa di Campagna',
                'descrizione' => 'Una villa elegante nella campagna con ampi giardini, piscina e interni raffinati. Il luogo ideale per una vacanza rilassante in campagna.',
                'stanze' => 5,
                'letti' => 9,
                'bagni' => 4,
                'metriQuadrati' => 300,
            ],
            [
                'nome' => 'Soggiorno Zenith',
                'descrizione' => 'Un rifugio zen con spazi aperti, dettagli ispirati alla natura e tranquillità totale. Perfetto per rigenerare corpo e mente.',
                'stanze' => 1,
                'letti' => 2,
                'bagni' => 1,
                'metriQuadrati' => 70,
            ],
            [
                'nome' => 'Resort Paradiso',
                'descrizione' => 'Un resort di lusso con piscine, spa e servizi esclusivi per una vacanza paradisiaca. Un\'esperienza di relax e divertimento senza precedenti.',
                'stanze' => 6,
                'letti' => 10,
                'bagni' => 5,
                'metriQuadrati' => 500,
            ],
            [
                'nome' => 'Suite Silenziosa',
                'descrizione' => 'Una suite tranquilla e raffinata con servizi di alta qualità, ideale per il relax. L\'ambiente perfetto per una fuga dallo stress quotidiano.',
                'stanze' => 2,
                'letti' => 3,
                'bagni' => 2,
                'metriQuadrati' => 140,
            ],
            [
                'nome' => 'Dimora del Cielo',
                'descrizione' => 'Una dimora con interni celestiali, decorazioni eteree e una vista mozzafiato. Un rifugio magico per chi cerca un soggiorno unico.',
                'stanze' => 3,
                'letti' => 5,
                'bagni' => 3,
                'metriQuadrati' => 200,
            ],
            [
                'nome' => 'Loft di Lusso',
                'descrizione' => 'Un loft spazioso e di lusso con soffitti alti, finestre a tutta altezza e arredi eleganti. L\'ideale per chi cerca un soggiorno di alto livello.',
                'stanze' => 1,
                'letti' => 2,
                'bagni' => 1,
                'metriQuadrati' => 100,
            ],
            [
                'nome' => 'Casa d\'Artista',
                'descrizione' => 'Una casa che riflette il talento artistico, con opere d\'arte originali e design creativo. Il luogo perfetto per gli amanti dell\'arte e della creatività.',
                'stanze' => 4,
                'letti' => 7,
                'bagni' => 3,
                'metriQuadrati' => 180,
            ],
            [
                'nome' => 'Appartamento Zen',
                'descrizione' => 'Un appartamento progettato per la serenità, con arredi minimalisti e colori neutri. L\'ideale per un soggiorno rilassante e equilibrato.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 2,
                'metriQuadrati' => 120,
            ],
            [
                'nome' => 'Villa Maestosa',
                'descrizione' => 'Una villa imponente con giardini all\'italiana, fontane e interni sontuosi. Una dimora regale per chi cerca un soggiorno di prestigio.',
                'stanze' => 6,
                'letti' => 10,
                'bagni' => 5,
                'metriQuadrati' => 600,
            ],
            [
                'nome' => 'Suite Raffinata',
                'descrizione' => 'Una suite di classe con dettagli raffinati, servizi di lusso e comfort supremo. Un\'oasi di eleganza e relax per il viaggiatore esigente.',
                'stanze' => 3,
                'letti' => 5,
                'bagni' => 3,
                'metriQuadrati' => 250,
            ],
            [
                'nome' => 'Casetta Accogliente',
                'descrizione' => 'Una casetta accogliente con caminetto, coperte soffici e atmosfera familiare. Il rifugio perfetto per una vacanza confortevole e accogliente.',
                'stanze' => 2,
                'letti' => 3,
                'bagni' => 1,
                'metriQuadrati' => 90,
            ],
            [
                'nome' => 'Attico Moderno',
                'descrizione' => 'Un attico dal design moderno con vista panoramica sulla città e arredi all\'avanguardia. L\'ideale per chi cerca un soggiorno di stile e innovazione.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 2,
                'metriQuadrati' => 130,
            ],
            [
                'nome' => 'Rustico Relax',
                'descrizione' => 'Un rifugio rustico con atmosfera rilassante, circondato dalla natura e comfort accoglienti. Un luogo autentico per una fuga nella tranquillità.',
                'stanze' => 3,
                'letti' => 6,
                'bagni' => 2,
                'metriQuadrati' => 120,
            ],
            [
                'nome' => 'Chalet Tranquillo',
                'descrizione' => 'Un chalet immerso nella quiete della natura, con interni caldi e atmosfera tranquilla. Il rifugio ideale per una pausa rigenerante.',
                'stanze' => 2,
                'letti' => 4,
                'bagni' => 1,
                'metriQuadrati' => 100,
            ],
            [
                'nome' => 'Mansarda Splendida',
                'descrizione' => 'Una mansarda affascinante con soffitti a travi, finestre panoramiche e dettagli splendidi. L\'ideale per un soggiorno romantico e affascinante.',
                'stanze' => 1,
                'letti' => 2,
                'bagni' => 1,
                'metriQuadrati' => 80,
            ],
            [
                'nome' => 'Oasi Romantica',
                'descrizione' => 'Un\'oasi romantica con giardino segreto, gazebo e arredi delicati. Il rifugio perfetto per innamorati in cerca di momenti speciali.',
                'stanze' => 2,
                'letti' => 3,
                'bagni' => 1,
                'metriQuadrati' => 70,
            ],
            [
                'nome' => 'Reggia di Campagna',
                'descrizione' => 'Una regale reggia situata nella campagna, con giardini all\'italiana e interni sontuosi. Un luogo di prestigio immerso nella natura.',
                'stanze' => 5,
                'letti' => 9,
                'bagni' => 4,
                'metriQuadrati' => 350,
            ],
            [
                'nome' => 'Appartamento Stellare',
                'descrizione' => 'Un appartamento con un tocco celestiale, con dettagli ispirati alle stelle e atmosfera magica. L\'ideale per una fuga da sogno.',
                'stanze' => 2,
                'letti' => 3,
                'bagni' => 2,
                'metriQuadrati' => 110,
            ],
            [
                'nome' => 'Villetta Incantata',
                'descrizione' => 'Una villetta incantevole con giardino segreto, gazebo e arredi delicati. Ideale per fughe romantiche e momenti magici.',
                'stanze' => 3,
                'letti' => 5,
                'bagni' => 2,
                'metriQuadrati' => 150,
            ],
            // Continua con altri appartamenti e descrizioni...
        ];



        foreach ($apartments as $apartment) {
            // Current apartment
            $currentApartment = $faker->randomElement($apartmentsArray);


            // Create, name and assign to user
            $new_apartment = new Apartment();
            $new_apartment->cover_image = $faker->file('public\storage\apartment_images', 'public\storage\cover_images', false);
            $new_apartment->name = $currentApartment["nome"];
            // $new_apartment->slug = Str::slug($new_apartment->name);

            // Generate unique slug
            $slug =  Str::slug($new_apartment->name);
            $i = 1;

            while (Apartment::where('slug', $slug)->exists()) {
                $slug = Str::slug($new_apartment->name) . '-' . $i++;
            }
            $new_apartment->slug = $slug;

            $new_apartment->description = $currentApartment["descrizione"];
            $new_apartment->visible = $faker->boolean(80);
            $new_apartment->user_id = User::all()->random()->id;

            $new_apartment->rooms = $currentApartment["stanze"];
            $new_apartment->beds = $currentApartment["letti"];
            $new_apartment->bathrooms = $currentApartment["bagni"];
            $new_apartment->square_meters = $currentApartment["metriQuadrati"];

            //protected function prepareForValidation()
            // {
            //     $slug =  Str::slug($this->title);
            //     $i = 1;

            //     while (Project::where('slug', $slug)->exists()) {
            //         $slug = Str::slug($this->title) . '-' . $i++;
            //     }

            //     $this->merge(['slug' => $slug]);
            // }

            // Generate coherent rooms, beds, bathrooms, square meters
            // $new_apartment->rooms = $faker->numberBetween(1, 12);
            // if ($new_apartment->rooms <= 4) {
            //      = $faker->numberBetween(1, 2, 3);
            //     $new_apartment->bathrooms = 1;
            //     $new_apartment->square_meters = $faker->numberBetween(50, 80);
            // } elseif ($new_apartment->rooms > 4 && $new_apartment->rooms <= 8) {
            //     $new_apartment->bathrooms = 2;
            //     $new_apartment->beds = $faker->numberBetween(4, 5, 6);
            //     $new_apartment->square_meters = $faker->numberBetween(81, 120);
            // } else {
            //     $new_apartment->bathrooms = 3;
            //     $new_apartment->beds = $faker->numberBetween(7, 8, 9);
            //     $new_apartment->square_meters = $faker->numberBetween(121, 200);
            // }

            // Get address, latitude and longitude from json
            $new_apartment->address = $apartment->address->freeformAddress;
            $new_apartment->city = $apartment->address->municipality;
            $new_apartment->region = $apartment->address->countrySubdivision;
            $new_apartment->country = $apartment->address->country;
            $new_apartment->latitude = $apartment->position->lat;
            $new_apartment->longitude = $apartment->position->lon;


            // Save appartment
            $new_apartment->save();

            // Attach 3 random services
            $new_apartment->services()->attach(Service::all()->random(5));
        }
    }
}
