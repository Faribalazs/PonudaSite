<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{Default_category, Default_subcategory, Default_pozicija, Units, Ponuda_Service};
 
class DataSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $categories = 
        [
            [
                'name' => [
                    'sr' => 'Rušenje',
                ]
            ],
            [
                'name' => [
                    'sr' => 'Demontaža'
                ]
            ],
            [
                'name' => [
                    'sr' => 'Pripremni i završni radovi'
                ]
            ],
            [
                'name' => [
                    'sr' => 'Zidarski radovi'
                ]
            ],
            [
                'name' => [
                    'sr' => 'Suvomontažni radovi'
                ]
            ],
            [
                'name' => [
                    'sr' => 'Keramičarski radovi'
                ]
            ],
            [
                'name' => [
                    'sr' => 'Podopolagački radovi'
                ]
            ],
            [
                'name' => [
                    'sr' => 'Parketarski radovi'
                ]
            ],
            [
                'name' => [
                    'sr' => 'Molersko farbarski radovi'
                ]
            ],
        ];

        $subcategories = 
        [
            [
                'category_id' => '9',
                'name' => [
                    'sr' => 'Pripremni i završni radovi'
                ]
            ],
            [
                'category_id' => '9',
                'name' => [
                    'sr' => 'Unutrašnji zidovi i plafoni'
                ]
            ],
            [
                'category_id' => '9',
                'name' => [
                    'sr' => 'Vrata i prozori'
                ]
            ],
            [
                'category_id' => '9',
                'name' => [
                    'sr' => 'Fasada'
                ]
            ],
            [
                'category_id' => '9',
                'name' => [
                    'sr' => 'Dekorativne tehnike'
                ]
            ],
            [
                'category_id' => '9',
                'name' => [
                    'sr' => 'Ukrasne tapete, bordure i aplikacije'
                ]
            ],
            [
                'category_id' => '5',
                'name' => [
                    'sr' => 'Pregradni zidovi'
                ]
            ],
            [
                'category_id' => '5',
                'name' => [
                    'sr' => 'Spusteni plafoni'
                ]
            ],
            [
                'category_id' => '5',
                'name' => [
                    'sr' => 'Suvo malterisanje'
                ]
            ],
            [
                'category_id' => '5',
                'name' => [
                    'sr' => 'Oblaganje instalacija'
                ]
            ],
            [
                'category_id' => '6',
                'name' => [
                    'sr' => 'Pripremni i završni radovi'
                ]
            ],
            [
                'category_id' => '6',
                'name' => [
                    'sr' => 'Zidovi'
                ]
            ],
            [
                'category_id' => '6',
                'name' => [
                    'sr' => 'Podovi'
                ]
            ],
            [
                'category_id' => '8',
                'name' => [
                    'sr' => 'Demontaža'
                ]
            ],
            [
                'category_id' => '8',
                'name' => [
                    'sr' => 'Priprema podloge'
                ]
            ],
            [
                'category_id' => '8',
                'name' => [
                    'sr' => 'Podovi'
                ]
            ],
            [
                'category_id' => '7',
                'name' => [
                    'sr' => 'Demontaža'
                ]
            ],
            [
                'category_id' => '7',
                'name' => [
                    'sr' => 'Priprema podloge'
                ]
            ],
            [
                'category_id' => '7',
                'name' => [
                    'sr' => 'Podovi'
                ]
            ],
            [
                'category_id' => '3',
                'name' => [
                    'sr' => 'Priprema i zaštita'
                ]
            ],
            [
                'category_id' => '3',
                'name' => [
                    'sr' => 'Čišćenje i pranje'
                ]
            ],
            [
                'category_id' => '3',
                'name' => [
                    'sr' => 'Otpad i šut'
                ]
            ],
            [
                'category_id' => '1',
                'name' => [
                    'sr' => 'Rušenje'
                ]
            ],
            [
                'category_id' => '2',
                'name' => [
                    'sr' => 'Demontaža'
                ]
            ],
            [
                'category_id' => '4',
                'name' => [
                    'sr' => 'Obijanje'
                ]
            ],
            [
                'category_id' => '4',
                'name' => [
                    'sr' => 'Zidovi'
                ]
            ],
            [
                'category_id' => '4',
                'name' => [
                    'sr' => 'Podovi'
                ]
            ],
            [
                'category_id' => '4',
                'name' => [
                    'sr' => 'Malterisanje'
                ]
            ],
        ];

        $units = 
        [
            [
                'name' => [
                    'sr' => 'm²'
                ]
            ],
            [
                'name' => [
                    'sr' => 'm³'
                ]
            ],
            [
                'name' => [
                    'sr' => 'kom'
                ]
            ],
            [
                'name' => [
                    'sr' => 'm¹'
                ],
            ],
            [
                'name' => [
                    'sr' => 'turi prevoza',
                ]
            ]
        ];

        $services = 
        [
            [
                'name_service' => [
                    'sr' => 'Cena pozicije sadrži vrednost materiala i usluge.'
                ]
            ],
            [
                'name_service' => [
                    'sr' => 'Cena pozicije sadrži vrednost uslugu (bez materiala).',
                ]
            ]
        ];

        $pozicija = 
        [
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Pomeranje postojećeg nameštaja iz prostora koji se adaptira.',
                ],
                'description' => [
                    'sr' => 'Nameštaj se po završenim radovima vraća na prvobitno mesto.'
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Iznošenje postojećeg nameštaja iz prostora koji se adaptira.',
                ],
                'description' => [
                    'sr' => 'Nameštaj se deponuje u okviru objekta.'
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Nabavka i postavljanje polietilenske folije preko otvora, vrata i prozora, radi zaštite.',
                ],
                'description' => [
                    'sr' => 'Folija se učvršćuje, vodeći računa da se ne ošteti postojeća stolarija.'
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Nabavka i postavljanje polietilenske folije preko nameštaja, radi zaštite.',
                ],
                'description' => [
                    'sr' => ''
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Nabavka i postavljanje deblje polietilenske folije za zaštitu podova.',
                ],
                'description' => [
                    'sr' => ''
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Montaža i demontaža pomoćne skele u objektu, za rad u prostorijama.',
                ],
                'description' => [
                    'sr' => 'Skela se izrađuje po svim propisima.'
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Čišćenje i pranje prozora i vrata po završetku radova.',
                ],
                'description' => [
                    'sr' => 'Pranje se obavlja vodom sa dodatkom odgovarajućih hemijskih sredstava.'
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Prikupljanje šuta i drugog otpadnog materijala sa objekta, utovar u kamion i odvoz na gradsku deponiju.',
                ],
                'description' => [
                    'sr' => ''
                ]
            ],
            [
                'subcategory_id' => '1',
                'unit_id' => '1',
                'title' => [
                    'sr' =>  'Detaljno čišćenje celog gradilišta, pranje svih staklenih površina, čišćenje i fino pranje svih unutrašnjih prostora i spoljnih površina.',
                ],
                'description' => [
                    'sr' => ''
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Gletovanje malterisanih zidova i plafona, disperzivnom glet masom.',
                ],
                'description' => [
                    'sr' => 'Površine se čiste i bruse pre gletovanja. Manja oštećenja i pukotine se kituju. Nakon gletovanja se vrši fino brušenje cele površine.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' =>  'Gletovanje starih ostruganih zidova i plafona.',
                ],
                'description' => [
                    'sr' => 'Površine se čiste i bruse pre gletovanja.  Manja oštećenja i pukotine se kituju. Nakon gletovanja se vrši fino brušenje cele površine.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Struganje i gletovanje starih zidova i plafona.',
                ],
                'description' => [
                    'sr' => 'Površine se stružu, peru, bruse, otprašuju i impregniraju. Manja oštećenja i pukotine se kituju. Nakon gletovanja se vrši fino brušenje cele površine.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Struganje uljane boje sa zidova.',
                ],
                'description' => [
                    'sr' => 'Sve površine se stružu i peru.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Skidanje postojeće uljane boje sa zidova, paljenjem.',
                ],
                'description' => [
                    'sr' => 'Površine obojene uljanom bojom se pomoću plina i brenera zagrevaju i špahtlama i drugim prigodnim alatkama se vrši uklanjanje boje. Postupak se ponavlja dok se boja ne skine.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje gletovanih zidova i plafona, bojama za unutrašnju upotrebu.',
                ],
                'description' => [
                    'sr' => 'Sve površine se bruse i čiste. Oštećenja se kituju toniranim disperzivnim kitom. Površine se zatim finalno boje u dva sloja, odnosno do potpunog pokrivanja.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje malterisanih zidova i plafona, bez gletovanja.',
                ],
                'description' => [
                    'sr' => 'Sve površine se bruse i impregniraju. Oštećenja se kituju toniranim disperzivnim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje sa gletovanjem zidova.',
                ],
                'description' => [
                    'sr' => 'Malterisani zidovi i plafoni se  gletuju disperzivnom glet masom u dva sloja. Površine se bruse i čiste. Manja oštećenja i pukotine se kituju. Gletovanje se vrši do potpune ravnosti, nakon čega se vrši fino brušenje cele površine. Sitne nepravilnosti se ispravljaju toniranim disperzionim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje gips kartonskih zidova i plafona.',
                ],
                'description' => [
                    'sr' => 'Fuge se bandažiraju i gletuju u dva sloja u širini koja obezbeđuje potpunu ravnost površine, nakon čega se vrši fino brušenje. Sitne nepravilnosti se ispravljaju toniranim disperzionim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Krečenje zidova i plafona četkom ili pumpom, rastvorenim odležalim gašenim krečom.',
                ],
                'description' => [
                    'sr' => 'Sve površine okrečiti četkom ili pumpom prvi put, brusiti i gipsovati manja oštećenja i pukotine, a zatim okrečiti drugi put.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje zidova uljanom bojom, sa lakiranjem.',
                ],
                'description' => [
                    'sr' => 'Vrši se osnovno bojenje zida, gletovanje i natapanje firnisom. Zatim se vrši kitovanje, brušenje, bojenje uljanom bojom u dva sloja, finalno brušenje i lakiranje u izabranoj boji i tonu.'
                ]
            ],
            [
                'subcategory_id' => '2',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obrada zidova plastičnim malterom (Bavalit) sa zaribavanjem.',
                ],
                'description' => [
                    'sr' => 'Podloga se čisti i impregnira izolacionom masom, radi bolje veze. Na osušenu podlogu se nanosi malter, napravljen i dobro izmešan da se dobije jednolična i konzistentna masa. Pripremljen materijal se nanosi glet hoblom u debljini sloja do maksimalne veličine zrna. Struktura maltera se postiže kružnim zaribavanjem gumenom glet hoblom ili vertikalnim ili horizontalnim zaribavanjem Stiroporom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Skidanje boje sa vrata i prozora hemijskim putem.',
                ],
                'description' => [
                    'sr' => 'Postojeći slojevi boje se skidaju nanošenjem hemijskog rastvarača i fizičkim skidanjem slojeva boje špahtlama i odgovarajućim alatkama. Postupak se ponavlja dok se ne skinu svi slojevi boje i ne dođe do zdravog i čistog drveta. Po izvršenom skidanju boje drvo se prebrusi finom šmirglom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Skidanje boje sa vrata i prozora upotrebom specijalnog fena za skidanje boje.',
                ],
                'description' => [
                    'sr' => 'Postojeći slojevi boje se skidaju grejanjem fenom i upotrebom špahtli i odgovarajućih alatki. Postupak se ponavlja dok se ne skinu svi slojevi boje i ne dođe do zdravog i čistog drveta. Po izvršenom skidanju boje drvo se  prebrusi finom šmirglom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje starih prozora i vrata, sa kojih je skinuta stara boja.',
                ],
                'description' => [
                    'sr' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje starih prozora i vrata preko postojeće boje.',
                ],
                'description' => [
                    'sr' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje novih prozora i vrata.',
                ],
                'description' => [
                    'sr' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje starih prozora i vrata lazurnim bojama, sa lakiranjem.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, površine se prelaze najfinijom šmirglom, pa boje treći put i lakiraju lakom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje novih prozora i vrata lazurnim bojama, sa lakiranjem.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, površine se prelaze najfinijom šmirglom, pa boje treći put i lakiraju lakom.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje osnovnom bojom metalnih prozora, sa prethodnim čišćenjem.',
                ],
                'description' => [
                    'sr' => 'Metalni prozori se pre bojenja čiste od korozije i prašine hemijskim i fizičkim sredstvima.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje osnovnom bojom metalne kapije, sa prethodnim čišćenjem.',
                ],
                'description' => [
                    'sr' => 'Metalna kapija se pre bojenja čisti od korozije i prašine hemijskim i fizičkim sredstvima.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje novih metalnih prozora, bojom za metal.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja sa metala se uklanja korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje starih metalnih prozora, bojom za metal.',
                ],
                'description' => [
                    'sr' => 'Sa prethodnim skidanjem stare boje. Pre bojenja sa metala se uklanja stara boja i korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje novih metalnih rešetki prozora, bojom za metal.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja sa metala se uklanja korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ]
            ],
            [
                'subcategory_id' => '3',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje starih metalnih rešetki prozora, bojom za metal.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja sa metala se uklanja stara boja i korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' =>  [
                    'sr' => 'Čišćenje slojeva stare boje sa ravnih površina fasade.',
                ],
                'description' =>  [
                    'sr' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga. Postupak se ponavlja do potpunog uklanjanja stare boje.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' =>  [
                    'sr' => 'Čišćenje slojeva stare boje sa ravnih površina fasade i vučenih profila.',
                ],
                'description' => [
                    'sr' =>  'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga i vučeni profili. Postupak se ponavlja do potpunog uklanjanja stare boje.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Čišćenje slojeva stare boje sa fasade sa ornamentima i vučenim profilima.',
                ],
                'description' => [
                    'sr' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga, ornamentalna plastika i vučeni profili. Postupak se ponavlja do potpunog uklanjanja stare boje.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Gletovanje fasade glet masom.',
                ],
                'description' => [
                    'sr' => 'Sve površine fasade se čiste od naslaga i impregniraju. Fasada se gletuje glet masom za spoljno gletovanje. Sve površine se bruse i čiste.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Gletovanje fasade glet masom, sa sanacijom pukotina.',
                ],
                'description' => [
                    'sr' => 'Sve površine fasade se čiste od naslaga i impregniraju. Sanacija pukotina se vrši njihovim otvaranjem, kitovanjem i lepljenjem staklene mreže preko saniranih pukotina. Fasada se gletuje glet masom za spoljno gletovanje. Sve površine se bruse i čiste.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' =>  [
                    'sr' => 'Bojenje malterisane fasade disperzionom bojom.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja fasadne površine se prelaze šmirglom i pajaju, a zatim grundiraju.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje sa gletovanjem malterisane fasade disperzionom bojom.',
                ],
                'description' => [
                    'sr' => 'Fasadne površine se prelaze šmirglom i pajaju, a zatim gletuju glet masom za spoljnu upotrebu. Pre bojenja fasadne površine se bruse i pajaju, a zatim impregniraju.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Zaštita bojenih fasadnih površina od uticaja vlage i atmosferilija silikonskim premazom.',
                ],
                'description' => [
                    'sr' => ''
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Zaštita fasadnih zidova od fasadne opeke od uticaja vlage i atmosferilija silikonskim premazom.',
                ],
                'description' => [
                    'sr' => ''
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje termoizolacionih ploča, Stiropor, odgovarajuće debljine i gustine.',
                ],
                'description' => [
                    'sr' => 'Stiropor ploče se postavljaju preko građevinskog lepka i ankerišu specijalnim tiplovima. Preko ploča se nanosi sloj građevinskog lepka, u koji se po celoj površini utiskuje odgovarajuća mrežica. Zatim se nanosi završni sloj građevinskog lepka.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje termoizolacionih ploča, Stirodur, odgovarajuće debljine i gustine.',
                ],
                'description' => [
                    'sr' => 'Stirdur ploče se postavljaju preko građevinskog lepka i ankerišu specijalnim tiplovima. Preko ploča se nanosi sloj građevinskog lepka, u koji se po celoj površini utiskuje odgovarajuća mrežica. Zatim se nanosi završni sloj građevinskog lepka.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje kamene vune u obliku mekih ploča, odgovarajuće debljine.',
                ],
                'description' => [
                    'sr' => 'Kamena vuna se postavlja kao termo i zvučna izolacija i protivpožarna zaštita fasadnih zidova, po detaljima i uputstvu projektanta.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje kamene vune u obliku polutvrdih ploča, odgovarajuće debljine.',
                ],
                'description' => [
                    'sr' => 'Kamena vuna se postavlja kao termo i zvučna izolacija i protivpožarna zaštita fasadnih zidova, po detaljima i uputstvu projektanta.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obrada fasade plastičnim malterom (Bavalit) sa zaribavanjem.',
                ],
                'description' => [
                    'sr' => 'Podloga se očistiti i impregnira radi bolje veze. Pripremljen materijal se nanosi  glet hoblom u debljini sloja do maksimalne veličine zrna. Struktura maltera se postiže kružnim zaribavanjem gumenom glet hoblom ili vertikalnim ili horizontalnim zaribavanjem Stiroporom.'
                ]
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje oluka i olučnih vertikala, bojom za metal.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja lim se odmašćuje i pere organskim rastvaračima. Na lim se nanosi antikorozivni premaz. Posle sušenja oluci olučne vertikale se boje bojom za metal.'
                ],
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje metalne ograde, bojom za metal.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja skida se korozija hemijskim i fizičkim sredstvima, brusi i očisti. Na ogradu se nanosi impregnacija i osnovna boja, a zatim se boji dva puta bojom za metal.'
                ],
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Skidanje stare boje i bojenje metalne ograde, bojom za metal.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja skida se stara boja i korozija hemijskim i fizičkim sredstvima, brusi i očisti. Na ogradu se nanosi impregnacija i osnovna boja, a zatim se boji dva puta bojom za metal.'
                ],
            ],
            [
                'subcategory_id' => '4',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Bojenje drvene ograde lazurnim bojama.',
                ],
                'description' => [
                    'sr' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, nakon čega se prelazi najfinijom šmirglom i boji po treći put.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike TRAVERTINO',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike OTTOCENTO',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike SAHARA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike SWAHILI',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike ARTECO',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike AFRICA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike SABULA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike ARABESQUE',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike HOBLIO',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike TUSCANIA ANTICA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],    
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike PERLESCENTE',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike VINTAGE',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ], 
            ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike SPACCANTE',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike KLONDIKE',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike POLISTOF',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike ETNIKA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                ],
            [
                'subcategory_id' => '5',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada dekorativne tehnike SPATULATO',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                ],
            [
                'subcategory_id' => '6',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Dekoracija zida UKRASNIM TAPETAMA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih tapeta.'
                ],
                ],
            [
                'subcategory_id' => '6',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Dekoracija zida UKRASNIM BORDURAMA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih bordura.'
                ],
                ],
            [
                'subcategory_id' => '6',
                'unit_id' => '3',
                'title' => [
                    'sr' => 'Dekoracija zida UKRASNIM APLIKACIJAMA',
                ],
                'description' => [
                    'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih aplikacija.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža i rušenje postojećih pregradnih gipskarton zidova',
                ],
                'description' => [
                    'sr' => 'Postojeći zidovi se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 80 mm - GKB15mm+CW50+GKB15mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 15mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 100 mm - GKB12,5mm+CW75+GKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 125 mm - GKB12,5mm+CW100+GKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog  pregradnog zida ukupne debljine 80 mm - GKF15mm+CW50+GKF15mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50),  koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 100 mm - GKF12,5mm+CW75+GKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - GKF12,5mm+CW100+GKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 100 mm - 2xGKB12,5mm+CW50+2xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 125 mm - 2xGKB12,5mm+CW75+2xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 150 mm - 2xGKB12,5mm+CW100+2xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 100 mm - 2xGKF12,5mm+CW50+2xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - 2xGKF12,5mm+CW75+2xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 150 mm - 2xGKF12,5mm+CW100+2xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 125 mm - 3xGKB12,5mm+CW50+3xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 150 mm - 3xGKB12,5mm+CW75+3xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 175 mm - 3xGKB12,5mm+CW100+3xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - 3xGKF12,5mm+CW50+3xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 150 mm - 3xGKF12,5mm+CW75+3xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 60mm (100kg/m3). Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 175 mm - 3xGKF12,5mm+CW100+3xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 60mm (100kg/m3). Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 155 mm - 2xGKB12,5mm+2xCW50+2xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 100mm (2xCW50), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 205 mm - 2xGKB12,5mm+2xCW75+2xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 150mm (2xCW75), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada pregradnog zida ukupne debljine 255 mm - 2xGKB12,5mm+2xCW100+2xGKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 200mm (2xCW100), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 155 mm - 2xGKF12,5mm+2xCW50+2xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 100mm (2xCW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 205 mm - 2xGKF12,5mm+2xCW75+2xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 150mm (2xCW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 255 mm - 2xGKF12,5mm+2xCW100+2xGKF12,5mm',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 200mm (2xCW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '7',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 215 mm - 2xGKF12,5mm+CW75+1xGKF12,5mm+CW75+2xGKF12,5mm - sa dodatom 5. pločom',
                ],
                'description' => [
                    'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 2x75mm (2xCW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Između CW profila se postavlja jednostruka protivpožarna gipskarton ploča (GKF). Debljina svih ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 2x75mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža i rušenje postojećih monolitnih plafona',
                ],
                'description' => [
                    'sr' => 'Postojeći monolitni plafoni se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža i rušenje postojećih kasetiranih plafona',
                ],
                'description' => [
                    'sr' => 'Postojeći kasetirani plafoni se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+1xGKB 12,5mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+2xGKB 12,5mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+3xGKB 12,5mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+1xGKB 15mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+2xGKB 15mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+3xGKB 15mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+1xGKB 12,5mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+2xGKB 12,5mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+3xGKB 12,5mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+1xGKB 15mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+2xGKB 15mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+3xGKB 15mm',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog kasetiranog spuštenog plafona „Armstrong“ na jednostrukoj metalnoj vidljivoj konstrukciji',
                ],  
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne „T“ konstrukcije koje je sastavljena od glavnih i poprečnih T-profila. U konstrukciju se postavljaju demontažne minealne ploče dimenzija 600x600mm sa ravnom ivicom i vidljivim T-profilima. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '8',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izrada horizontalnog kasetiranog spuštenog plafona „Armstrong“ na jednostrukoj metalnoj nevidljivoj konstrukciji',
                ],
                'description' => [
                    'sr' => 'Plafon se sastoji od jednostruke metalne „T“ konstrukcije koje je sastavljena od glavnih i poprečnih T-profila. U konstrukciju se postavljaju demontažne minealne ploče dimenzija 600x600mm sa ravnom ivicom i nevidljivim T-profilima. Spuštanje do 50cm.'
                ],
                ],
            [
                'subcategory_id' => '9',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Suvo malterisanje ravnih zidova',
                ],
                'description' => [
                    'sr' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove uz pomoć lepka (Fugenfüller) nanetog kao tankoslojni malter. Pre lepljenja, na zidove se nanosi prajmer, kako bi se poboljšalo prijanjanje. Lepak se nanosi po svim ivicama ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '9',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Suvo malterisanje zidova sa neravninama do 20mm',
                ],
                'description' => [
                    'sr' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove uz pomoć Perlfix lepka . Pre lepljenja, na zidove se nanosi prajme, kako bi se poboljšalo prijanjanje. Lepak se nanosi po ivicama i sredini ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '9',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Suvo malterisanje zidova sa neravninama preko 20mm',
                ],
                'description' => [
                    'sr' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove se vrši preko unapred zalepljenih traka od gipsanih ploča širine 100mm koje se lepe uz pomoć Perlfix lepka.  Ploče se za podlogu lepe uz pomoć lepka (Fugenfüller) nanetog kao tankoslojni malter.  Lepak se nanosi po ivicama i sredini ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '9',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Oblaganje zida na metalnoj podkonstrukciji - jednostruko oblaganje CW+GKB12,5mm',
                ],
                'description' => [
                    'sr' => 'Gipskarton ploče se u jednom sloju postavljeju preko pripremljene metalne podkonstrukcije od CW profila. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '9',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Oblaganje zida na metalnoj podkonstrukciji - dvostruko oblaganje CW+2xGKB12,5mm',
                ],  
                'description' => [
                    'sr' => 'Gipskarton ploče se u jednom sloju postavljeju preko pripremljene metalne podkonstrukcije od CW profila. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                ],
            [
                'subcategory_id' => '9',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Ugradnja termoizolacije u sistem obložnog zida',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '10',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Izrada obloge kablovskih regala - dvostrana',
                ],
                'description' => [
                    'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
            ],
            [
                'subcategory_id' => '10',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Izrada obloge kablovskih regala - trostrana',
                ],
                'description' => [
                    'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
            ],
            [
                'subcategory_id' => '10',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Izrada obloge kablovskih regala - četvorostrana',
                ],
                'description' => [
                    'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
            ],
            [
                'subcategory_id' => '10',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Izrada obloge ventilacionih kanala - trostrana',
                ],
                'description' => [
                    'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
            ],
            [
                'subcategory_id' => '10',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Izrada obloge ventilacionih kanala - četvorostrana',
                ],
                'description' => [
                    'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
            ],
            [
                'subcategory_id' => '11',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje pločica postavljenih u cementni malter sa zidova',
                ],
                'description' => [
                    'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
            ],
            [
                'subcategory_id' => '11',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje pločica postavljenih u lepak sa zidova',
                ],
                'description' => [
                    'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
            ],
            [
                'subcategory_id' => '11',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje pločica postavljenih u cementni malter sa podova',
                ],
                'description' => [
                    'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
            ],
            [
                'subcategory_id' => '11',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje pločica postavljenih u lepak sa podova',
                ],
                'description' => [
                    'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
            ],
            [
                'subcategory_id' => '11',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izravnavanje obijenih površina',
                ],
                'description' => [
                    'sr' => 'Obijene površine se izravnavaju upotrebom građevinskog lepka u cilju pripreme za postavljanje novih pločica.'
                ],
            ],
            [
                'subcategory_id' => '11',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Čišćenje gradilišta nakon završenih radova',
                ],
                'description' => [
                    'sr' => 'Sav otpadni materijal utovariti u kamion i odvesti na gradsku deponiju udaljenu do 10km.'
                ],
            ],
            [
                'subcategory_id' => '12',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje zidnih keramičkih pločica u cementnom malteru',
                ],
                'description' => [
                    'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '12',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje zidnih keramičkih pločica u lepku',
                ],
                'description' => [
                    'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '12',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje zidnog keramičkog mozaika',
                ],
                'description' => [
                    'sr' => 'Mozaik se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljeni mozaik se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenog mozaika.'
                ],
                ],
            [
                'subcategory_id' => '12',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje zidne keramičke bordure',
                ],
                'description' => [
                    'sr' => 'Bordura se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljena bordura se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljene bordure.'
                ],
                ],
            [
                'subcategory_id' => '12',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje zidnih keramičkih listela',
                ],
                'description' => [
                    'sr' => 'Listela se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene listele se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih listela.'
                ],
                ],
            [
                'subcategory_id' => '12',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje bazenskih zidnih keramičkih pločica',
                ],
                'description' => [
                    'sr' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '12',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Silikoniranje negativnih uglova na spojevima keramičkih pločica',
                ],  
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '12',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje prefabrikovanih lajsni na pozitivne uglove spojeva keramičkih pločica',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '12',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje prefabrikovanih lajsni na gornju ivicu ugrađenih sokli od keramičkih pločica',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '13',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje podnih keramičkih pločica u cementnom malteru',
                ],
                'description' => [
                    'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje podnih keramičkih pločica u lepku',
                ],
                'description' => [
                    'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje keramičke sokle visine do 15cm',
                ],
                'description' => [
                    'sr' => 'Sokla se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljena sokla  se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine sokle.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje podnog keramičkog mozaika',
                ],
                'description' => [
                    'sr' => 'Mozaik se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljeni mozaik se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenog mozaika.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje bazenskih podnih keramičkih pločica',
                ],
                'description' => [
                    'sr' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje protivkliznih podnih keramičkih pločica oko bazena',
                ],
                'description' => [
                    'sr' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje prefabrikovanih profilisanih keramičkih preliva po obimu bazena',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '13',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje prefabrikovanih profilisanih keramičkih prelivnih kanala po obimu bazena zajedno sa PVC ili prohrom rešetkama',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '13',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje keramičkih pločica na čelo stepenika',
                ],
                'description' => [
                    'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje keramičkih pločica na gazište stepenika',
                ],
                'description' => [
                    'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                ],
            [
                'subcategory_id' => '13',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje keramičkih pločica na stepenice (gazište i čelo stepenika)',
                ],
                'description' => [
                    'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica. '
                ],
                ],
            [
                'subcategory_id' => '14',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Iznošenje postojećeg nameštaja iz prostora u kome se vrše parketarski radovi',
                ],
                'description' => [
                    'sr' => 'Nameštaj se deponuje u okviru objekta.'
                ],
            ],
            [
                'subcategory_id' => '14',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Pomeranje nameštaja u prostoriji gde se vrše parketarski radovi',
                ],
                'description' => [
                    'sr' => 'Nameštaj se nakon izvršenih radova vraća na svoje prvobitno mesto'
                ],
            ],
            [
                'subcategory_id' => '14',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža stare podne obloge od parketa',
                ],
                'description' => [
                    'sr' => 'Parket i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                ],
            [
                'subcategory_id' => '14',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža stare podne obloge od parketa i slepog poda',
                ],
                'description' => [
                    'sr' => 'Parket, lajsne i gredice se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Pesak, šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                ],
            [
                'subcategory_id' => '14',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža stare podne obloge od brodskog poda',
                ],
                'description' => [
                    'sr' => 'Brodski pod i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                ],
            [
                'subcategory_id' => '14',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža stare podne obloge od brodskog poda sa slepim podom',
                ],  
                'description' => [
                    'sr' => 'Brodski pod, lajsne i gredice se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Pesak, šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                ],
            [
                'subcategory_id' => '14',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Sortiranje i povezivanje demontiranog parketa',
                ],
                'description' => [
                    'sr' => 'Demontirani parket se sortira i povezuje u buntove i odlaže u okviru gradilišta na mesto koje odredi investitor.'
                ],
            ],
            [
                'subcategory_id' => '15',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Delimično krpljenje velikih oštećenja u podlozi',
                ],
                'description' => [
                    'sr' => 'Oštećenja podloge se isecaju, obijaju, čiste, otprašuju i impregniraju radi boljeg prijanjanja, nakon čega se popunjavaju sitnozrnim betonom i nivelišu u odnosu na okolnu  površinu podloge. Finalno se perdaše radi postizanja potrebne glatkoće.'
                ],
                ],
            [
                'subcategory_id' => '15',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izravnavanje postojeće rapave podloge',
                ],
                'description' => [
                    'sr' => 'Kompletna površina postijeće podloge se otprašuje i impregnira radi boljeg prijanjanja, nakon čega se nanosi samonivelirajuća masa za izravnavanje. Nakon sušenja izravnavajuće mase, po potrebi se vrši mašinsko brušenje.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje hrastovog parketa d=22mm ukivanjem u podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje hrastovog parketa d=22mm lepljenjem za  podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje hrastovog parketa d=22mm preko vrućeg bitumena',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm ukivanjem u podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm lepljenjem za  podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm preko vrućeg bitumena',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje, hoblovanje i lakiranje hrastovog parketa d=22mm ukivanjem u podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje, hoblovanje i lakiranje hrastovog parketa d=22mm lepljenjem za  podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje,  hoblovanje i lakiranje hrastovog parketa d=22mm preko vrućeg bitumena',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje hrastovog lamel parketa lepljenjem za  podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje i hoblovanje hrastovog lamel parketa lepljenjem za  podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje, hoblovanjei lakiranje hrastovog lamel parketa lepljenjem za  podlogu',
                ],
                'description' => [
                    'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje, hoblovanjei lakiranje hrastovog lamel parketa kao „plivajućeg“ poda',
                ],
                'description' => [
                    'sr' => 'Preko očišćene podloge se postavlja PVC folija i filc. Parket se postavlja podužno, kao brodski pod. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                ],
            [
                'subcategory_id' => '16',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Hoblovanje i lakiranje postojećeg parketa sa sitnim popravkama',
                ],
                'description' => [
                    'sr' => 'Sitna oštećenja i otvorene fuge se kituju smesom pilotine i laka.'
                ],
            ],
            [
                'subcategory_id' => '16',
                'unit_id' => '3',
                'title' => [
                    'sr' => 'Krpljenje parketa na mestu demontirane peći',
                ],
                'description' => [
                    'sr' => ''
                ], 
            ],
            [
                'subcategory_id' => '16',
                'unit_id' => '3',
                'title' => [
                    'sr' => 'Krpljenje parketa na mestu probijanja otvora za vrata u zidu',
                ],
                'description' => [
                    'sr' => ''
                ], 
            ],
            [
                'subcategory_id' => '16',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Krpljenje parketa na mestu uklanjanja zida',
                ], 
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '16',
                'unit_id' => '3',
                'title' => [
                    'sr' => 'Postavljanje i lakiranje novih hrastovih pragova',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '17',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža poda od itisona u rolnama',
                ],
                'description' => [
                    'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
            ],
            [
                'subcategory_id' => '17',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža poda od itisona u pločama',
                ],
                'description' => [
                    'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
            ],
            [
                'subcategory_id' => '17',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža PVC poda u rolnama',
                ],
                'description' => [
                    'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
            ],
            [
                'subcategory_id' => '17',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža PVC poda u pločama',
                ],
                'description' => [
                    'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
            ],
            [
                'subcategory_id' => '17',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža poda od gume u rolnama',
                ],
                'description' => [
                    'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
            ],
            [
                'subcategory_id' => '17',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža poda od gume u pločama',
                ],
                'description' => [
                    'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
            ],
            [
                'subcategory_id' => '17',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Mašinsko i ručno obijanje postojećeg poda od samorazlivajućeg epoksidnog (sintetičkog) materijala',
                ],
                'description' => [
                    'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
            ],
            [
                'subcategory_id' => '18',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Delimično krpljenje velikih oštećenja u podlozi',
                ],
                'description' => [
                    'sr' => 'Oštećenja podloge se isecaju, obijaju, čiste, otprašuju i impregniraju radi boljeg prijanjanja, nakon čega se popunjavaju sitnozrnim betonom i nivelišu u odnosu na okolnu  površinu podloge. Finalno se perdaše radi postizanja potrebne glatkoće.'
                ],
                ],
            [
                'subcategory_id' => '18',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Izravnavanje postojeće rapave podloge',
                ],
                'description' => [
                    'sr' => 'Kompletna površina postijeće podloge se otprašuje i impregnira radi boljeg prijanjanja, nakon čega se nanosi samonivelirajuća masa za izravnavanje. Nakon sušenja izravnavajuće mase, po potrebi se vrši mašinsko brušenje.'
                ],
                ],
            [
                'subcategory_id' => '18',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Mašinsko brušenje neravne betonske podloge dijamantskim diskovima',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje tekstilne podne obloge – itisona u pločama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje tekstilne podne obloge – itisona u rolnama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje podne obloge od industrijske gume u pločama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje podne obloge od industrijske gume u rolnama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje PVC podne obloge u pločama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje PVC podne obloge u rolnama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje elektrootporne podne obloge u pločama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Postavljanje elektroprovodne podne obloge u pločama',
                ],
                'description' => [
                    'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem grafitnim lepkom preko mreže provodnika fiksiranih za podlogu'
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje tvrdih PVC  lajsni na spoju poda i zidova',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '19',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Postavljanje mekih PVC lajsni na spoju poda i zidova',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '20',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Pomeranje postojećeg nameštaja iz prostora koji se adaptira.',
                ],
                'description' => [
                    'sr' => 'Nameštaj se po završenim radovima vraća na prvobitno mesto.'
                ],
            ],
            [
                'subcategory_id' => '20',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Iznošenje postojećeg nameštaja iz prostora koji se adaptira.',
                ],
                'description' => [
                    'sr' => 'Nameštaj se deponuje u okviru objekta.'
                ],
            ],
            [
                'subcategory_id' => '20',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Nabavka i postavljanje polietilenske folije preko otvora, vrata i prozora, radi zaštite.',
                ],
                'description' => [
                    'sr' => 'Folija se učvršćuje, vodeći računa da se ne ošteti postojeća stolarija.'
                ],
            ],
            [
                'subcategory_id' => '20',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Nabavka i postavljanje polietilenske folije preko nameštaja, radi zaštite.',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '20',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Nabavka i postavljanje deblje polietilenske folije za zaštitu podova.',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '20',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Montaža i demontaža pomoćne skele u objektu, za rad u prostorijama.',
                ],
                'description' => [
                    'sr' => 'Skela se izrađuje po svim propisima.'
                ],
            ],
            [
                'subcategory_id' => '21',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Čišćenje i pranje prozora i vrata po završetku radova.',
                ],
                'description' => [
                    'sr' => 'Pranje se obavlja vodom sa dodatkom odgovarajućih hemijskih sredstava.'
                ],
            ],
            [
                'subcategory_id' => '21',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Detaljno čišćenje celog gradilišta, pranje svih staklenih površina, čišćenje i fino pranje svih unutrašnjih prostora i spoljnih površina.',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '21',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Periodično grubo čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '21',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Periodično grubo čišćenje gradilišta (u i oko objekta) od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '21',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Periodično grubo čišćenje trotoara oko objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '21',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Završno čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '21',
                'unit_id' => '5',
                'title' => [
                    'sr' => 'Utovar otpadnog materijala u kamion i odvoz na gradsku deponiju udaljenu do 10km.',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '22',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Periodično grubo čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '22',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Periodično grubo čišćenje gradilišta (u i oko objekta) od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '22',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Periodično grubo čišćenje trotoara oko objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '22',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Završno čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                ],
                'description' => [
                    'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.'
                ],
            ],
            [
                'subcategory_id' => '22',
                'unit_id' => '5',
                'title' => [
                    'sr' => 'Utovar otpadnog materijala u kamion i odvoz na gradsku deponiju udaljenu do 10km.',
                ],
                'description' => [
                    'sr' => ''
                ],
            ],
            [
                'subcategory_id' => '23',
                'unit_id' => '3',
                'title' => [
                    'sr' => 'Probijanje zida ili plafona za prolaz vodovodnih ili kanalizacionih cevi.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
            ],
            [
                'subcategory_id' => '23',
                'unit_id' => '4',
                'title' => [
                    'sr' => 'Izrada šliceva u zida od opeke za prolaz vodovodnih ili kanalizacionih cevi.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
            ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Probijanje pregradnog zida od opeke za izradu otvora za nova vrata.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km. U cenu je uračunato i podupiranje.'
                ],
            ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Probijanjenosećeg zida od opeke za izradu otvora za nova vrata.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km. U cenu je uračunato i podupiranje.'
                ],
            ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Probijanje armirano betonske ploče i formiranje otvora.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km. U cenu je uračunato i sečenje armatura i potrebna skela'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje krečnog maltera sa zidova.',
                ],
                'description' => [
                    'sr' => 'Nakon obijanja maltera, fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje produžnog maltera sa zidova.',
                ],
                'description' => [
                    'sr' => 'Nakon obijanja maltera, fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje cementnog  maltera sa zidova.',
                ],
                'description' => [
                    'sr' => 'Nakon obijanja maltera, fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Obijanje maltera sa plafona.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Čišćenje fuga od opeke.',
                ],
                'description' => [
                    'sr' => 'Fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Rušenje pregradnih zidova od opeke u produžnom malteru.',
                ],
                'description' => [
                    'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Opeku očistiti od maltera i složiti na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '2',
                'title' => [
                    'sr' => 'Rušenje nosećih zidova od opeke u produžnom malteru.',
                ],
                'description' => [
                    'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Opeka  se čisti od maltera i slaže na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '2',
                'title' => [
                    'sr' => 'Rušenje zidova od blokova.',
                ],
                'description' => [
                    'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Blokovi se  čiste od maltera i slažu na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '2',
                'title' => [
                    'sr' => 'Rušenje zidova od Ytong blokova.',
                ],
                'description' => [
                    'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Blokovi se  čiste od maltera i slažu na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Rušenje i demontaža zidova od gips-karton ploča.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '23',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Probijanje i isecanje otvora u  zidovima i plafonima od armiranog betona.',
                ],
                'description' => [
                    'sr' => 'U ceni je i sečenje armature.  Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
                ],
            [
                'subcategory_id' => '24',
                'unit_id' => '3',
                'title' => [
                    'sr' => 'Demontaža prozora.',
                ],
                'description' => [
                    'sr' => 'Prozori se demontiraju zajedno sa štokovima. Demontirani prozori se deponuju na gradilišnoj deponiji.'
                ],
                ],
            [
                'subcategory_id' => '24',
                'unit_id' => '3',
                'title' => [
                    'sr' => 'Demontaža vrata.',
                ],
                'description' => [
                    'sr' => 'Vrata se demontiraju zajedno sa štokovima. Demontirana vrata se deponuju na gradilišnoj deponiji.'
                ],
                ],
            [
                'subcategory_id' => '24',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža ugrađenih plakara.',
                ],
                'description' => [
                    'sr' => 'Demontirani plakari se deponuju na gradilišnoj deponiji.'
                ],
            ],
            [
                'subcategory_id' => '24',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža brodskog poda zajedno sa svim slojevima podkonstrukcije i lajsnama.',
                ],
                'description' => [
                    'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
            ],
            [
                'subcategory_id' => '24',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža poda od parketa zajedno sa lajsnama.',
                ],
                'description' => [
                    'sr' => 'Demontirani parket se slaže i povezuje. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
            ],
            [
                'subcategory_id' => '24',
                'unit_id' => '1',
                'title' => [
                    'sr' => 'Demontaža poda od itisona zajedno sa lajsnama.',
                ],
                'description' => [
                    'sr' => 'Demontirani itison se slaže i pakuje. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.'
                ],
            ],
        ];

        collect($units)->each(function ($units) { Units::create($units); });
        collect($services)->each(function ($services) { Ponuda_Service::create($services); });
        collect($categories)->each(function ($category) { Default_category::create($category); });
        collect($subcategories)->each(function ($subcategory) { Default_subcategory::create($subcategory); });
        collect($pozicija)->each(function ($poz) { Default_pozicija::create($poz); });

        //required: subcategory_id, unit_id, t_sr, d_sr
        $dataset = [
            [
                'subcategory_id' => 24,
                'unit_id' => 1,
                't_sr' => 'Demontaža poda od PVC podnih obloga zajedno sa lajsnama.',
                'd_sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje maltera sa unutrašnjih zidova.',
                'd_sr' => 'Malter sa zidova se obija ručno ili mašinski. Fuge se čiste do dubine od 2cm, a površina opeke čisti čeličnim četkama. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje maltera sa plafona.',
                'd_sr' => 'Malter sa plafona se obija ručno ili mašinski. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje zidnih keramičkih pločica.',
                'd_sr' => 'Pločice se sa zidova obijaju ručno ili mašinski. Fuge se čiste do dubine od 2cm, a površina opeke čisti čeličnim četkama. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje podnih keramičkih pločica.',
                'd_sr' => 'Pločice se sa podova obijaju ručno ili mašinski. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje maltera sa fasadnih zidova.',
                'd_sr' => 'Malter sa zidova se obija ručno ili mašinski. Fuge se čiste do dubine od 2cm, a površina opeke čisti čeličnim četkama. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km. U ceni je i trošak montaže i demontaže potrebne fasadne skele.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 2,
                't_sr' => 'Zidanje nosećih zidova, d=25 cm i više, punom opekom u produžnom malteru.',
                'd_sr' => 'Opeka se pre ugradnje kvasi vodom. Fuge se čiste do dubine od 2 cm. U cenu ulazi i pomoćna skela.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 2,
                't_sr' => 'Zidanje zidova, šupljim blokovima d=25 cm i više, u produžnom malteru.',
                'd_sr' => 'Blokovi se pre ugradnje kvase vodom. Fuge se čiste do dubine od 2 cm. U cenu ulazi i pomoćna skela. ',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 2,
                't_sr' => 'Zidanje zidova termo izolacionim (YTONG) blokovima, odgovarajućim lepkom. ',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 1,
                't_sr' => 'Zidanje pregradnih zidova debljine 6,5 cm, punom opekom u produžnom malteru.',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 1,
                't_sr' => 'Zidanje pregradnih zidova debljine 12 cm, punom opekom u produžnom malteru.',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 1,
                't_sr' => 'Zidanje pregradnih zidova, šupljim blokovima d=8 cm i više, u produžnom malteru.',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada perdašene cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Gornja površina košuljice se perdaši i neguje do očvršćavanja.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada gletovane cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Gornja površina košuljice se gletuje do crnog sjaja i neguje do očvršćavanja.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada rabicirane i perdašene cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira rabic pletivom, postavljenim u sredini sloja. Gornja površina košuljice se perdaši i neguje do očvršćavanja.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada rabicirane i gletovane cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira rabic pletivom, postavljenim u sredini sloja. Gornja površina košuljice se gletuje do crnog sjaja i neguje do očvršćavanja.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada armirane i perdašene cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira mrežom Ø 6 mm, sa okcima 15/15 cm, postavljenim u sredini sloja. Gornja površina košuljice se perdaši i neguje do očvršćavanja.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada armirane i gletovane cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira mrežom Ø 6 mm, sa okcima 15/15 cm, postavljenim u sredini sloja. Gornja površina košuljice se gletuje do crnog sjaja i neguje do očvršćavanja.',
            ],
            [
                'subcategory_id' => 28,
                'unit_id' => 1,
                't_sr' => 'Malterisanje krečnim malterom u dva sloja sa perdašenjem.',
                'd_sr' => 'Pre malterisanja površine se čiste  i prskaju razređenim malterom. Po završetku malterisanja, malter se kvasi da ne dođe do prebrzog sušenja. U cenu ulazi i pomoćna skela.',
            ],
            [
                'subcategory_id' => 28,
                'unit_id' => 1,
                't_sr' => 'Malterisanje produžnim malterom u dva sloja sa perdašenjem.',
                'd_sr' => 'Pre malterisanja površine se čiste  i prskaju razređenim malterom. Po završetku malterisanja, malter se kvasi da ne dođe do prebrzog sušenja. U cenu ulazi i pomoćna skela.',
            ],
            [
                'subcategory_id' => 28,
                'unit_id' => 1,
                't_sr' => 'Malterisanje cementnim malterom u dva sloja sa perdašenjem.',
                'd_sr' => 'Pre malterisanja površine se čiste  i prskaju razređenim malterom. Po završetku malterisanja, malter se kvasi da ne dođe do prebrzog sušenja. U cenu ulazi i pomoćna skela.',
            ],
            // [
            //     'subcategory_id' => 29,
            //     'unit_id' => 1,
            //     't_sr' => '',
            //     'd_sr' => '',
            // ],
        ];

        function poz($data)
        {     
            if(empty($data['d_sr']))
                $data['d_sr'] = '';
            $pozicija = Default_pozicija::create(
                [
                    'subcategory_id' => $data['subcategory_id'],
                    'unit_id' => $data['unit_id'],
                    'title' => ['sr' => $data['t_sr']],
                    'description' => ['sr' => $data['d_sr']],
                ]
            );

            if (isset($data['t_en'])) {
                $pozicija->setTranslations('title', ['en' => $data['t_en']]);
            }
        
            if (isset($data['t_hu'])) {
                $pozicija->setTranslations('title', ['hu' => $data['t_hu']]);
            }
        
            if (isset($data['d_en'])) {
                $pozicija->setTranslations('description', ['en' => $data['d_en']]);
            }
        
            if (isset($data['d_hu'])) {
                $pozicija->setTranslations('description', ['hu' => $data['d_hu']]);
            }

            $pozicija->save();
        }

        foreach ($dataset as $data) {
            poz($data);
        }
    }
}