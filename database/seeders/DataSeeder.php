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
                        'rs-cyrl' => 'Рушење',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Demontaža',
                        'rs-cyrl' => 'Демонтажа',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Pripremni i završni radovi',
                        'rs-cyrl' => 'Припремни и завршни радови',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Zidarski radovi',
                        'rs-cyrl' => 'Зидарски радови',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Suvomontažni radovi',
                        'rs-cyrl' => 'Сувомонтажни радови',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Keramičarski radovi',
                        'rs-cyrl' => 'Керамичарски радови',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Podopolagački radovi',
                        'rs-cyrl' => 'Подополагачки радови',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Parketarski radovi',
                        'rs-cyrl' => 'Паркетарски радови',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'Molersko farbarski radovi',
                        'rs-cyrl' => 'Молерско фарбарски радови',
                    ]
                ],
            ];

        $subcategories =
            [
                [
                    'category_id' => '9',
                    'name' => [
                        'sr' => 'Pripremni i završni radovi',
                        'rs-cyrl' => 'Припремни и завршни радови',
                    ]
                ],
                [
                    'category_id' => '9',
                    'name' => [
                        'sr' => 'Unutrašnji zidovi i plafoni',
                        'rs-cyrl' => 'Унутрашњи зидови и плафони',
                    ]
                ],
                [
                    'category_id' => '9',
                    'name' => [
                        'sr' => 'Vrata i prozori',
                        'rs-cyrl' => 'Врата и прозори',
                    ]
                ],
                [
                    'category_id' => '9',
                    'name' => [
                        'sr' => 'Fasada',
                        'rs-cyrl' => 'Фасада',
                    ]
                ],
                [
                    'category_id' => '9',
                    'name' => [
                        'sr' => 'Dekorativne tehnike',
                        'rs-cyrl' => 'Декоративне технике',
                    ]
                ],
                [
                    'category_id' => '9',
                    'name' => [
                        'sr' => 'Ukrasne tapete, bordure i aplikacije',
                        'rs-cyrl' => 'Украсне тапете, бордуре и апликације',
                    ]
                ],
                [
                    'category_id' => '5',
                    'name' => [
                        'sr' => 'Pregradni zidovi',
                        'rs-cyrl' => 'Преградни зидови',
                    ]
                ],
                [
                    'category_id' => '5',
                    'name' => [
                        'sr' => 'Spusteni plafoni',
                        'rs-cyrl' => 'Спуштени плафони',
                    ]
                ],
                [
                    'category_id' => '5',
                    'name' => [
                        'sr' => 'Suvo malterisanje',
                        'rs-cyrl' => 'Суво малтерисање',
                    ]
                ],
                [
                    'category_id' => '5',
                    'name' => [
                        'sr' => 'Oblaganje instalacija',
                        'rs-cyrl' => 'Облагање инсталација',
                    ]
                ],
                [
                    'category_id' => '6',
                    'name' => [
                        'sr' => 'Pripremni i završni radovi',
                        'rs-cyrl' => 'Припремни и завршни радови',
                    ]
                ],
                [
                    'category_id' => '6',
                    'name' => [
                        'sr' => 'Zidovi',
                        'rs-cyrl' => 'Зидови',
                    ]
                ],
                [
                    'category_id' => '6',
                    'name' => [
                        'sr' => 'Podovi',
                        'rs-cyrl' => 'Подови',
                    ]
                ],
                [
                    'category_id' => '8',
                    'name' => [
                        'sr' => 'Demontaža',
                        'rs-cyrl' => 'Демонтажа',
                    ]
                ],
                [
                    'category_id' => '8',
                    'name' => [
                        'sr' => 'Priprema podloge',
                        'rs-cyrl' => 'Припрема подлоге',
                    ]
                ],
                [
                    'category_id' => '8',
                    'name' => [
                        'sr' => 'Podovi',
                        'rs-cyrl' => 'Подови',
                    ]
                ],
                [
                    'category_id' => '7',
                    'name' => [
                        'sr' => 'Demontaža',
                        'rs-cyrl' => 'Демонтажа',
                    ]
                ],
                [
                    'category_id' => '7',
                    'name' => [
                        'sr' => 'Priprema podloge',
                        'rs-cyrl' => 'Припрема подлоге',
                    ]
                ],
                [
                    'category_id' => '7',
                    'name' => [
                        'sr' => 'Podovi',
                        'rs-cyrl' => 'Подови',
                    ]
                ],
                [
                    'category_id' => '3',
                    'name' => [
                        'sr' => 'Priprema i zaštita',
                        'rs-cyrl' => 'Припрема и заштита',
                    ]
                ],
                [
                    'category_id' => '3',
                    'name' => [
                        'sr' => 'Čišćenje i pranje',
                        'rs-cyrl' => 'Чишћење и прање',
                    ]
                ],
                [
                    'category_id' => '3',
                    'name' => [
                        'sr' => 'Otpad i šut',
                        'rs-cyrl' => 'Отпад и шут',
                    ]
                ],
                [
                    'category_id' => '1',
                    'name' => [
                        'sr' => 'Rušenje',
                        'rs-cyrl' => 'Рушење',
                    ]
                ],
                [
                    'category_id' => '2',
                    'name' => [
                        'sr' => 'Demontaža',
                        'rs-cyrl' => 'Демонтажа',
                    ]
                ],
                [
                    'category_id' => '4',
                    'name' => [
                        'sr' => 'Obijanje',
                        'rs-cyrl' => 'Обијање',
                    ]
                ],
                [
                    'category_id' => '4',
                    'name' => [
                        'sr' => 'Zidovi',
                        'rs-cyrl' => 'Зидови',
                    ]
                ],
                [
                    'category_id' => '4',
                    'name' => [
                        'sr' => 'Podovi',
                        'rs-cyrl' => 'Подови',
                    ]
                ],
                [
                    'category_id' => '4',
                    'name' => [
                        'sr' => 'Malterisanje',
                        'rs-cyrl' => 'Малтерисање',
                    ]
                ],
                [
                    'category_id' => '4',
                    'name' => [
                        'sr' => 'Ugradnja stolarije',
                        'rs-cyrl' => 'Уградња столарије',
                    ]
                ],

            ];

        $units =
            [
                [
                    'name' => [
                        'sr' => 'm²',
                        'rs-cyrl' => 'м²',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'm³',
                        'rs-cyrl' => 'м³',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'kom',
                        'rs-cyrl' => 'ком',
                    ]
                ],
                [
                    'name' => [
                        'sr' => 'm¹',
                        'rs-cyrl' => 'м¹',
                    ],
                ],
                [
                    'name' => [
                        'sr' => 'turi prevoza',
                        'rs-cyrl' => 'тури превоза',
                    ]
                ]
            ];

        $services =
            [
                [
                    'name_service' => [
                        'sr' => 'Cena pozicije sadrži vrednost materijala i usluge.',
                        'rs-cyrl' => 'Цена позиције садржи вредност материјала и услуге.',
                    ]
                ],
                [
                    'name_service' => [
                        'sr' => 'Cena pozicije sadrži vrednost usluge (bez materijala).',
                        'rs-cyrl' => 'Цена позиције садржи вредност услуге (без материјала).',
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
                'rs-cyrl' => 'Померање постојећег намештаја из простора који се адаптира.',
              ],
              'description' => [
                'sr' => 'Nameštaj se po završenim radovima vraća na prvobitno mesto.',
                'rs-cyrl' => 'Намештај се по завршеним радовима враћа на првобитно место.',
              ],
            ],
            1 => [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Iznošenje postojećeg nameštaja iz prostora koji se adaptira.',
                'rs-cyrl' => 'Изношење постојећег намештаја из простора који се адаптира.',
              ],
              'description' => [
                'sr' => 'Nameštaj se deponuje u okviru objekta.',
                'rs-cyrl' => 'Намештај се депонује у оквиру објекта.',
              ],
            ],
            [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Nabavka i postavljanje polietilenske folije preko otvora, vrata i prozora, radi zaštite.',
                'rs-cyrl' => 'Набавка и постављање полиетиленске фолије преко отвора, врата и прозора, ради заштите.',
              ],
              'description' => [
                'sr' => 'Folija se učvršćuje, vodeći računa da se ne ošteti postojeća stolarija.',
                'rs-cyrl' => 'Фолија се учвршћује, водећи рачуна да се не оштети постојећа столарија.',
              ],
            ],
            [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Nabavka i postavljanje polietilenske folije preko nameštaja, radi zaštite.',
                'rs-cyrl' => 'Набавка и постављање полиетиленске фолије преко намештаја, ради заштите.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Nabavka i postavljanje deblje polietilenske folije za zaštitu podova.',
                'rs-cyrl' => 'Набавка и постављање дебље полиетиленске фолије за заштиту подова.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Montaža i demontaža pomoćne skele u objektu, za rad u prostorijama.',
                'rs-cyrl' => 'Монтажа и демонтажа помоћне скеле у објекту, за рад у просторијама.',
              ],
              'description' => [
                'sr' => 'Skela se izrađuje po svim propisima.',
                'rs-cyrl' => 'Скела се израђује по свим прописима.',
              ],
            ],
            [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Čišćenje i pranje prozora i vrata po završetku radova.',
                'rs-cyrl' => 'Чишћење и прање прозора и врата по завршетку радова.',
              ],
              'description' => [
                'sr' => 'Pranje se obavlja vodom sa dodatkom odgovarajućih hemijskih sredstava.',
                'rs-cyrl' => 'Прање се обавља водом са додатком одговарајућих хемијских средстава.',
              ],
            ],
            [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Prikupljanje šuta i drugog otpadnog materijala sa objekta, utovar u kamion i odvoz na gradsku deponiju.',
                'rs-cyrl' => 'Прикупљање шута и другог отпадног материјала са објекта, утовар у камион и одвоз на градску депонију.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '1',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Detaljno čišćenje celog gradilišta, pranje svih staklenih površina, čišćenje i fino pranje svih unutrašnjih prostora i spoljnih površina.',
                'rs-cyrl' => 'Детаљно чишћење целог градилишта, прање свих стаклених површина, чишћење и фино прање свих унутрашњих простора и спољних површина.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Gletovanje malterisanih zidova i plafona, disperzivnom glet masom.',
                'rs-cyrl' => 'Глетовање малтерисаних зидова и плафона, дисперзивном глет масом.',
              ],
              'description' => [
                'sr' => 'Površine se čiste i bruse pre gletovanja. Manja oštećenja i pukotine se kituju. Nakon gletovanja se vrši fino brušenje cele površine.',
                'rs-cyrl' => 'Површине се чисте и брусе пре глетовања. Мања оштећења и пукотине се китују. Након глетовања се врши фино брушење целе површине.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Gletovanje starih ostruganih zidova i plafona.',
                'rs-cyrl' => 'Глетовање старих оструганих зидова и плафона.',
              ],
              'description' => [
                'sr' => 'Površine se čiste i bruse pre gletovanja.  Manja oštećenja i pukotine se kituju. Nakon gletovanja se vrši fino brušenje cele površine.',
                'rs-cyrl' => 'Површине се чисте и брусе пре глетовања.  Мања оштећења и пукотине се китују. Након глетовања се врши фино брушење целе површине.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Struganje i gletovanje starih zidova i plafona.',
                'rs-cyrl' => 'Стругање и глетовање старих зидова и плафона.',
              ],
              'description' => [
                'sr' => 'Površine se stružu, peru, bruse, otprašuju i impregniraju. Manja oštećenja i pukotine se kituju. Nakon gletovanja se vrši fino brušenje cele površine.',
                'rs-cyrl' => 'Површине се стружу, перу, брусе, отпрашују и импрегнирају. Мања оштећења и пукотине се китују. Након глетовања се врши фино брушење целе површине.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Struganje uljane boje sa zidova.',
                'rs-cyrl' => 'Стругање уљане боје са зидова.',
              ],
              'description' => [
                'sr' => 'Sve površine se stružu i peru.',
                'rs-cyrl' => 'Све површине се стружу и перу.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Skidanje postojeće uljane boje sa zidova, paljenjem.',
                'rs-cyrl' => 'Скидање постојеће уљане боје са зидова, паљењем.',
              ],
              'description' => [
                'sr' => 'Površine obojene uljanom bojom se pomoću plina i brenera zagrevaju i špahtlama i drugim prigodnim alatkama se vrši uklanjanje boje. Postupak se ponavlja dok se boja ne skine.',
                'rs-cyrl' => 'Површине обојене уљаном бојом се помоћу плина и бренера загревају и шпахтлама и другим пригодним алаткама се врши уклањање боје. Поступак се понавља док се боја не скине.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje gletovanih zidova i plafona, bojama za unutrašnju upotrebu.',
                'rs-cyrl' => 'Бојење глетованих зидова и плафона, бојама за унутрашњу употребу.',
              ],
              'description' => [
                'sr' => 'Sve površine se bruse i čiste. Oštećenja se kituju toniranim disperzivnim kitom. Površine se zatim finalno boje u dva sloja, odnosno do potpunog pokrivanja.',
                'rs-cyrl' => 'Све површине се брусе и чисте. Оштећења се китују тонираним дисперзивним китом. Површине се затим финално боје у два слоја, односно до потпуног покривања.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje malterisanih zidova i plafona, bez gletovanja.',
                'rs-cyrl' => 'Бојење малтерисаних зидова и плафона, без глетовања.',
              ],
              'description' => [
                'sr' => 'Sve površine se bruse i impregniraju. Oštećenja se kituju toniranim disperzivnim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.',
                'rs-cyrl' => 'Све површине се брусе и импрегнирају. Оштећења се китују тонираним дисперзивним китом. Комплетна површина се затим боји одговарајућом бојом у два слоја у траженој боји и тону, односно до потпуног покривања.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje sa gletovanjem zidova.',
                'rs-cyrl' => 'Бојење са глетовањем зидова.',
              ],
              'description' => [
                'sr' => 'Malterisani zidovi i plafoni se  gletuju disperzivnom glet masom u dva sloja. Površine se bruse i čiste. Manja oštećenja i pukotine se kituju. Gletovanje se vrši do potpune ravnosti, nakon čega se vrši fino brušenje cele površine. Sitne nepravilnosti se ispravljaju toniranim disperzionim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.',
                'rs-cyrl' => 'Малтерисани зидови и плафони се  глетују дисперзивном глет масом у два слоја. Површине се брусе и чисте. Мања оштећења и пукотине се китују. Глетовање се врши до потпуне равности, након чега се врши фино брушење целе површине. Ситне неправилности се исправљају тонираним дисперзионим китом. Комплетна површина се затим боји одговарајућом бојом у два слоја у траженој боји и тону, односно до потпуног покривања.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje gips kartonskih zidova i plafona.',
                'rs-cyrl' => 'Бојење гипс картонских зидова и плафона.',
              ],
              'description' => [
                'sr' => 'Fuge se bandažiraju i gletuju u dva sloja u širini koja obezbeđuje potpunu ravnost površine, nakon čega se vrši fino brušenje. Sitne nepravilnosti se ispravljaju toniranim disperzionim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.',
                'rs-cyrl' => 'Фуге се бандажирају и глетују у два слоја у ширини која обезбеђује потпуну равност површине, након чега се врши фино брушење. Ситне неправилности се исправљају тонираним дисперзионим китом. Комплетна површина се затим боји одговарајућом бојом у два слоја у траженој боји и тону, односно до потпуног покривања.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Krečenje zidova i plafona četkom ili pumpom, rastvorenim odležalim gašenim krečom.',
                'rs-cyrl' => 'Кречење зидова и плафона четком или пумпом, раствореним одлежалим гашеним кречом.',
              ],
              'description' => [
                'sr' => 'Sve površine okrečiti četkom ili pumpom prvi put, brusiti i gipsovati manja oštećenja i pukotine, a zatim okrečiti drugi put.',
                'rs-cyrl' => 'Све површине окречити четком или пумпом први пут, брусити и гипсовати мања оштећења и пукотине, а затим окречити други пут.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje zidova uljanom bojom, sa lakiranjem.',
                'rs-cyrl' => 'Бојење зидова уљаном бојом, са лакирањем.',
              ],
              'description' => [
                'sr' => 'Vrši se osnovno bojenje zida, gletovanje i natapanje firnisom. Zatim se vrši kitovanje, brušenje, bojenje uljanom bojom u dva sloja, finalno brušenje i lakiranje u izabranoj boji i tonu.',
                'rs-cyrl' => 'Врши се основно бојење зида, глетовање и натапање фирнисом. Затим се врши китовање, брушење, бојење уљаном бојом у два слоја, финално брушење и лакирање у изабраној боји и тону.',
              ],
            ],
            [
              'subcategory_id' => '2',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obrada zidova plastičnim malterom (Bavalit) sa zaribavanjem.',
                'rs-cyrl' => 'Обрада зидова пластичним малтером (Бавалит) са зарибавањем.',
              ],
              'description' => [
                'sr' => 'Podloga se čisti i impregnira izolacionom masom, radi bolje veze. Na osušenu podlogu se nanosi malter, napravljen i dobro izmešan da se dobije jednolična i konzistentna masa. Pripremljen materijal se nanosi glet hoblom u debljini sloja do maksimalne veličine zrna. Struktura maltera se postiže kružnim zaribavanjem gumenom glet hoblom ili vertikalnim ili horizontalnim zaribavanjem Stiroporom.',
                'rs-cyrl' => 'Подлога се чисти и импрегнира изолационом масом, ради боље везе. На осушену подлогу се наноси малтер, направљен и добро измешан да се добије једнолична и конзистентна маса. Припремљен материјал се наноси глет хоблом у дебљини слоја до максималне величине зрна. Структура малтера се постиже кружним зарибавањем гуменом глет хоблом или вертикалним или хоризонталним зарибавањем Стиропором.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Skidanje boje sa vrata i prozora hemijskim putem.',
                'rs-cyrl' => 'Скидање боје са врата и прозора хемијским путем.',
              ],
              'description' => [
                'sr' => 'Postojeći slojevi boje se skidaju nanošenjem hemijskog rastvarača i fizičkim skidanjem slojeva boje špahtlama i odgovarajućim alatkama. Postupak se ponavlja dok se ne skinu svi slojevi boje i ne dođe do zdravog i čistog drveta. Po izvršenom skidanju boje drvo se prebrusi finom šmirglom.',
                'rs-cyrl' => 'Постојећи слојеви боје се скидају наношењем хемијског растварача и физичким скидањем слојева боје шпахтлама и одговарајућим алаткама. Поступак се понавља док се не скину сви слојеви боје и не дође до здравог и чистог дрвета. По извршеном скидању боје дрво се пребруси фином шмирглом.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Skidanje boje sa vrata i prozora upotrebom specijalnog fena za skidanje boje.',
                'rs-cyrl' => 'Скидање боје са врата и прозора употребом специјалног фена за скидање боје.',
              ],
              'description' => [
                'sr' => 'Postojeći slojevi boje se skidaju grejanjem fenom i upotrebom špahtli i odgovarajućih alatki. Postupak se ponavlja dok se ne skinu svi slojevi boje i ne dođe do zdravog i čistog drveta. Po izvršenom skidanju boje drvo se  prebrusi finom šmirglom.',
                'rs-cyrl' => 'Постојећи слојеви боје се скидају грејањем феном и употребом шпахтли и одговарајућих алатки. Поступак се понавља док се не скину сви слојеви боје и не дође до здравог и чистог дрвета. По извршеном скидању боје дрво се  пребруси фином шмирглом.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje starih prozora i vrata, sa kojih je skinuta stara boja.',
                'rs-cyrl' => 'Бојење старих прозора и врата, са којих је скинута стара боја.',
              ],
              'description' => [
                'sr' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.',
                'rs-cyrl' => 'Приликом бојења изводе се све фазе које су предвиђене нормативима за ову врсту радова, заједно са финалним лакирањем емајл лаком.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje starih prozora i vrata preko postojeće boje.',
                'rs-cyrl' => 'Бојење старих прозора и врата преко постојеће боје.',
              ],
              'description' => [
                'sr' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.',
                'rs-cyrl' => 'Приликом бојења изводе се све фазе које су предвиђене нормативима за ову врсту радова, заједно са финалним лакирањем емајл лаком.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje novih prozora i vrata.',
                'rs-cyrl' => 'Бојење нових прозора и врата.',
              ],
              'description' => [
                'sr' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.',
                'rs-cyrl' => 'Приликом бојења изводе се све фазе које су предвиђене нормативима за ову врсту радова, заједно са финалним лакирањем емајл лаком.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje starih prozora i vrata lazurnim bojama, sa lakiranjem.',
                'rs-cyrl' => 'Бојење старих прозора и врата лазурним бојама, са лакирањем.',
              ],
              'description' => [
                'sr' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, površine se prelaze najfinijom šmirglom, pa boje treći put i lakiraju lakom.',
                'rs-cyrl' => 'Пре бојења све површине се прелазе фином шмирглом. Бојење се врши два пута са размаком за сушење од 24 х, површине се прелазе најфинијом шмирглом, па боје трећи пут и лакирају лаком.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje novih prozora i vrata lazurnim bojama, sa lakiranjem.',
                'rs-cyrl' => 'Бојење нових прозора и врата лазурним бојама, са лакирањем.',
              ],
              'description' => [
                'sr' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, površine se prelaze najfinijom šmirglom, pa boje treći put i lakiraju lakom.',
                'rs-cyrl' => 'Пре бојења све површине се прелазе фином шмирглом. Бојење се врши два пута са размаком за сушење од 24 х, површине се прелазе најфинијом шмирглом, па боје трећи пут и лакирају лаком.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje osnovnom bojom metalnih prozora, sa prethodnim čišćenjem.',
                'rs-cyrl' => 'Бојење основном бојом металних прозора, са претходним чишћењем.',
              ],
              'description' => [
                'sr' => 'Metalni prozori se pre bojenja čiste od korozije i prašine hemijskim i fizičkim sredstvima.',
                'rs-cyrl' => 'Метални прозори се пре бојења чисте од корозије и прашине хемијским и физичким средствима.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje osnovnom bojom metalne kapije, sa prethodnim čišćenjem.',
                'rs-cyrl' => 'Бојење основном бојом металне капије, са претходним чишћењем.',
              ],
              'description' => [
                'sr' => 'Metalna kapija se pre bojenja čisti od korozije i prašine hemijskim i fizičkim sredstvima.',
                'rs-cyrl' => 'Метална капија се пре бојења чисти од корозије и прашине хемијским и физичким средствима.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje novih metalnih prozora, bojom za metal.',
                'rs-cyrl' => 'Бојење нових металних прозора, бојом за метал.',
              ],
              'description' => [
                'sr' => 'Pre bojenja sa metala se uklanja korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.',
                'rs-cyrl' => 'Пре бојења са метала се уклања корозија хемијским и физичким средствима, а затим све изводе све фазе у складу са нормативима за ову врсту радова.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje starih metalnih prozora, bojom za metal.',
                'rs-cyrl' => 'Бојење старих металних прозора, бојом за метал.',
              ],
              'description' => [
                'sr' => 'Sa prethodnim skidanjem stare boje. Pre bojenja sa metala se uklanja stara boja i korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.',
                'rs-cyrl' => 'Са претходним скидањем старе боје. Пре бојења са метала се уклања стара боја и корозија хемијским и физичким средствима, а затим све изводе све фазе у складу са нормативима за ову врсту радова.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje novih metalnih rešetki prozora, bojom za metal.',
                'rs-cyrl' => 'Бојење нових металних решетки прозора, бојом за метал.',
              ],
              'description' => [
                'sr' => 'Pre bojenja sa metala se uklanja korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.',
                'rs-cyrl' => 'Пре бојења са метала се уклања корозија хемијским и физичким средствима, а затим све изводе све фазе у складу са нормативима за ову врсту радова.',
              ],
            ],
            [
              'subcategory_id' => '3',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje starih metalnih rešetki prozora, bojom za metal.',
                'rs-cyrl' => 'Бојење старих металних решетки прозора, бојом за метал.',
              ],
              'description' => [
                'sr' => 'Pre bojenja sa metala se uklanja stara boja i korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.',
                'rs-cyrl' => 'Пре бојења са метала се уклања стара боја и корозија хемијским и физичким средствима, а затим све изводе све фазе у складу са нормативима за ову врсту радова.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Čišćenje slojeva stare boje sa ravnih površina fasade.',
                'rs-cyrl' => 'Чишћење слојева старе боје са равних површина фасаде.',
              ],
              'description' => [
                'sr' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga. Postupak se ponavlja do potpunog uklanjanja stare boje.',
                'rs-cyrl' => 'Стари слојеви боје се чисте механичким и хемијским путем. Приликом чишћења се води рачуна да се не оштети подлога. Поступак се понавља до потпуног уклањања старе боје.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Čišćenje slojeva stare boje sa ravnih površina fasade i vučenih profila.',
                'rs-cyrl' => 'Чишћење слојева старе боје са равних површина фасаде и вучених профила.',
              ],
              'description' => [
                'sr' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga i vučeni profili. Postupak se ponavlja do potpunog uklanjanja stare boje.',
                'rs-cyrl' => 'Стари слојеви боје се чисте механичким и хемијским путем. Приликом чишћења се води рачуна да се не оштети подлога и вучени профили. Поступак се понавља до потпуног уклањања старе боје.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Čišćenje slojeva stare boje sa fasade sa ornamentima i vučenim profilima.',
                'rs-cyrl' => 'Чишћење слојева старе боје са фасаде са орнаментима и вученим профилима.',
              ],
              'description' => [
                'sr' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga, ornamentalna plastika i vučeni profili. Postupak se ponavlja do potpunog uklanjanja stare boje.',
                'rs-cyrl' => 'Стари слојеви боје се чисте механичким и хемијским путем. Приликом чишћења се води рачуна да се не оштети подлога, орнаментална пластика и вучени профили. Поступак се понавља до потпуног уклањања старе боје.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Gletovanje fasade glet masom.',
                'rs-cyrl' => 'Глетовање фасаде глет масом.',
              ],
              'description' => [
                'sr' => 'Sve površine fasade se čiste od naslaga i impregniraju. Fasada se gletuje glet masom za spoljno gletovanje. Sve površine se bruse i čiste.',
                'rs-cyrl' => 'Све површине фасаде се чисте од наслага и импрегнирају. Фасада се глетује глет масом за спољно глетовање. Све површине се брусе и чисте.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Gletovanje fasade glet masom, sa sanacijom pukotina.',
                'rs-cyrl' => 'Глетовање фасаде глет масом, са санацијом пукотина.',
              ],
              'description' => [
                'sr' => 'Sve površine fasade se čiste od naslaga i impregniraju. Sanacija pukotina se vrši njihovim otvaranjem, kitovanjem i lepljenjem staklene mreže preko saniranih pukotina. Fasada se gletuje glet masom za spoljno gletovanje. Sve površine se bruse i čiste.',
                'rs-cyrl' => 'Све површине фасаде се чисте од наслага и импрегнирају. Санација пукотина се врши њиховим отварањем, китовањем и лепљењем стаклене мреже преко санираних пукотина. Фасада се глетује глет масом за спољно глетовање. Све површине се брусе и чисте.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje malterisane fasade disperzionom bojom.',
                'rs-cyrl' => 'Бојење малтерисане фасаде дисперзионом бојом.',
              ],
              'description' => [
                'sr' => 'Pre bojenja fasadne površine se prelaze šmirglom i pajaju, a zatim grundiraju.',
                'rs-cyrl' => 'Пре бојења фасадне површине се прелазе шмирглом и пајају, а затим грундирају.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje sa gletovanjem malterisane fasade disperzionom bojom.',
                'rs-cyrl' => 'Бојење са глетовањем малтерисане фасаде дисперзионом бојом.',
              ],
              'description' => [
                'sr' => 'Fasadne površine se prelaze šmirglom i pajaju, a zatim gletuju glet masom za spoljnu upotrebu. Pre bojenja fasadne površine se bruse i pajaju, a zatim impregniraju.',
                'rs-cyrl' => 'Фасадне површине се прелазе шмирглом и пајају, а затим глетују глет масом за спољну употребу. Пре бојења фасадне површине се брусе и пајају, а затим импрегнирају.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Zaštita bojenih fasadnih površina od uticaja vlage i atmosferilija silikonskim premazom.',
                'rs-cyrl' => 'Заштита бојених фасадних површина од утицаја влаге и атмосферилија силиконским премазом.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Zaštita fasadnih zidova od fasadne opeke od uticaja vlage i atmosferilija silikonskim premazom.',
                'rs-cyrl' => 'Заштита фасадних зидова од фасадне опеке од утицаја влаге и атмосферилија силиконским премазом.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje termoizolacionih ploča, Stiropor, odgovarajuće debljine i gustine.',
                'rs-cyrl' => 'Постављање термоизолационих плоча, Стиропор, одговарајуће дебљине и густине.',
              ],
              'description' => [
                'sr' => 'Stiropor ploče se postavljaju preko građevinskog lepka i ankerišu specijalnim tiplovima. Preko ploča se nanosi sloj građevinskog lepka, u koji se po celoj površini utiskuje odgovarajuća mrežica. Zatim se nanosi završni sloj građevinskog lepka.',
                'rs-cyrl' => 'Стиропор плоче се постављају преко грађевинског лепка и анкеришу специјалним типловима. Преко плоча се наноси слој грађевинског лепка, у који се по целој површини утискује одговарајућа мрежица. Затим се наноси завршни слој грађевинског лепка.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje termoizolacionih ploča, Stirodur, odgovarajuće debljine i gustine.',
                'rs-cyrl' => 'Постављање термоизолационих плоча, Стиродур, одговарајуће дебљине и густине.',
              ],
              'description' => [
                'sr' => 'Stirdur ploče se postavljaju preko građevinskog lepka i ankerišu specijalnim tiplovima. Preko ploča se nanosi sloj građevinskog lepka, u koji se po celoj površini utiskuje odgovarajuća mrežica. Zatim se nanosi završni sloj građevinskog lepka.',
                'rs-cyrl' => 'Стирдур плоче се постављају преко грађевинског лепка и анкеришу специјалним типловима. Преко плоча се наноси слој грађевинског лепка, у који се по целој површини утискује одговарајућа мрежица. Затим се наноси завршни слој грађевинског лепка.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje kamene vune u obliku mekih ploča, odgovarajuće debljine.',
                'rs-cyrl' => 'Постављање камене вуне у облику меких плоча, одговарајуће дебљине.',
              ],
              'description' => [
                'sr' => 'Kamena vuna se postavlja kao termo i zvučna izolacija i protivpožarna zaštita fasadnih zidova, po detaljima i uputstvu projektanta.',
                'rs-cyrl' => 'Камена вуна се поставља као термо и звучна изолација и противпожарна заштита фасадних зидова, по детаљима и упутству пројектанта.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje kamene vune u obliku polutvrdih ploča, odgovarajuće debljine.',
                'rs-cyrl' => 'Постављање камене вуне у облику полутврдих плоча, одговарајуће дебљине.',
              ],
              'description' => [
                'sr' => 'Kamena vuna se postavlja kao termo i zvučna izolacija i protivpožarna zaštita fasadnih zidova, po detaljima i uputstvu projektanta.',
                'rs-cyrl' => 'Камена вуна се поставља као термо и звучна изолација и противпожарна заштита фасадних зидова, по детаљима и упутству пројектанта.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obrada fasade plastičnim malterom (Bavalit) sa zaribavanjem.',
                'rs-cyrl' => 'Обрада фасаде пластичним малтером (Бавалит) са зарибавањем.',
              ],
              'description' => [
                'sr' => 'Podloga se očistiti i impregnira radi bolje veze. Pripremljen materijal se nanosi  glet hoblom u debljini sloja do maksimalne veličine zrna. Struktura maltera se postiže kružnim zaribavanjem gumenom glet hoblom ili vertikalnim ili horizontalnim zaribavanjem Stiroporom.',
                'rs-cyrl' => 'Подлога се очистити и импрегнира ради боље везе. Припремљен материјал се наноси  глет хоблом у дебљини слоја до максималне величине зрна. Структура малтера се постиже кружним зарибавањем гуменом глет хоблом или вертикалним или хоризонталним зарибавањем Стиропором.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje oluka i olučnih vertikala, bojom za metal.',
                'rs-cyrl' => 'Бојење олука и олучних вертикала, бојом за метал.',
              ],
              'description' => [
                'sr' => 'Pre bojenja lim se odmašćuje i pere organskim rastvaračima. Na lim se nanosi antikorozivni premaz. Posle sušenja oluci olučne vertikale se boje bojom za metal.',
                'rs-cyrl' => 'Пре бојења лим се одмашћује и пере органским растварачима. На лим се наноси антикорозивни премаз. После сушења олуци олучне вертикале се боје бојом за метал.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje metalne ograde, bojom za metal.',
                'rs-cyrl' => 'Бојење металне ограде, бојом за метал.',
              ],
              'description' => [
                'sr' => 'Pre bojenja skida se korozija hemijskim i fizičkim sredstvima, brusi i očisti. Na ogradu se nanosi impregnacija i osnovna boja, a zatim se boji dva puta bojom za metal.',
                'rs-cyrl' => 'Пре бојења скида се корозија хемијским и физичким средствима, бруси и очисти. На ограду се наноси импрегнација и основна боја, а затим се боји два пута бојом за метал.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Skidanje stare boje i bojenje metalne ograde, bojom za metal.',
                'rs-cyrl' => 'Скидање старе боје и бојење металне ограде, бојом за метал.',
              ],
              'description' => [
                'sr' => 'Pre bojenja skida se stara boja i korozija hemijskim i fizičkim sredstvima, brusi i očisti. Na ogradu se nanosi impregnacija i osnovna boja, a zatim se boji dva puta bojom za metal.',
                'rs-cyrl' => 'Пре бојења скида се стара боја и корозија хемијским и физичким средствима, бруси и очисти. На ограду се наноси импрегнација и основна боја, а затим се боји два пута бојом за метал.',
              ],
            ],
            [
              'subcategory_id' => '4',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Bojenje drvene ograde lazurnim bojama.',
                'rs-cyrl' => 'Бојење дрвене ограде лазурним бојама.',
              ],
              'description' => [
                'sr' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, nakon čega se prelazi najfinijom šmirglom i boji po treći put.',
                'rs-cyrl' => 'Пре бојења све површине се прелазе фином шмирглом. Бојење се врши два пута са размаком за сушење од 24 х, након чега се прелази најфинијом шмирглом и боји по трећи пут.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike TRAVERTINO',
                'rs-cyrl' => 'Израда декоративне технике ТРАВЕРТИНО',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike OTTOCENTO',
                'rs-cyrl' => 'Израда декоративне технике ОТТОЦЕНТО',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike SAHARA',
                'rs-cyrl' => 'Израда декоративне технике САХАРА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike SWAHILI',
                'rs-cyrl' => 'Израда декоративне технике СWАХИЛИ',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike ARTECO',
                'rs-cyrl' => 'Израда декоративне технике АРТЕЦО',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike AFRICA',
                'rs-cyrl' => 'Израда декоративне технике АФРИЦА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike SABULA',
                'rs-cyrl' => 'Израда декоративне технике САБУЛА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike ARABESQUE',
                'rs-cyrl' => 'Израда декоративне технике АРАБЕСQУЕ',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike HOBLIO',
                'rs-cyrl' => 'Израда декоративне технике ХОБЛИО',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike TUSCANIA ANTICA',
                'rs-cyrl' => 'Израда декоративне технике ТУСЦАНИА АНТИЦА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike PERLESCENTE',
                'rs-cyrl' => 'Израда декоративне технике ПЕРЛЕСЦЕНТЕ',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike VINTAGE',
                'rs-cyrl' => 'Израда декоративне технике ВИНТАГЕ',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike SPACCANTE',
                'rs-cyrl' => 'Израда декоративне технике СПАЦЦАНТЕ',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike KLONDIKE',
                'rs-cyrl' => 'Израда декоративне технике КЛОНДИКЕ',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike POLISTOF',
                'rs-cyrl' => 'Израда декоративне технике ПОЛИСТОФ',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike ETNIKA',
                'rs-cyrl' => 'Израда декоративне технике ЕТНИКА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '5',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada dekorativne tehnike SPATULATO',
                'rs-cyrl' => 'Израда декоративне технике СПАТУЛАТО',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално наношење декоративног материјала у траженом тону.',
              ],
            ],
            [
              'subcategory_id' => '6',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Dekoracija zida UKRASNIM TAPETAMA',
                'rs-cyrl' => 'Декорација зида УКРАСНИМ ТАПЕТАМА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih tapeta.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално лепљење одабраних украсних тапета.',
              ],
            ],
            [
              'subcategory_id' => '6',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Dekoracija zida UKRASNIM BORDURAMA',
                'rs-cyrl' => 'Декорација зида УКРАСНИМ БОРДУРАМА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih bordura.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално лепљење одабраних украсних бордура.',
              ],
            ],
            [
              'subcategory_id' => '6',
              'unit_id' => '3',
              'title' => [
                'sr' => 'Dekoracija zida UKRASNIM APLIKACIJAMA',
                'rs-cyrl' => 'Декорација зида УКРАСНИМ АПЛИКАЦИЈАМА',
              ],
              'description' => [
                'sr' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih aplikacija.',
                'rs-cyrl' => 'Цена садржи комплетну припрему подлоге у зависности од њеног тренутног стања и потребних фаза рада, као и финално лепљење одабраних украсних апликација.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža i rušenje postojećih pregradnih gipskarton zidova',
                'rs-cyrl' => 'Демонтажа и рушење постојећих преградних гипскартон зидова',
              ],
              'description' => [
                'sr' => 'Postojeći zidovi se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.',
                'rs-cyrl' => 'Постојећи зидови се у потпуности уклањају, укључујући и комплетну подконструкцију. Демонтирани материјал се износи ван објекта и депонује на унапед предвиђено место. Хоризонтални и вертикални транспорт шута и смећа се организује у складу са условима градилишта.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 80 mm - GKB15mm+CW50+GKB15mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 80 мм - ГКБ15мм+ЦW50+ГКБ15мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 15mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 50мм (ЦW50), која се обострано облаже обичним гипскартон плочама у једном слоју (ГКБ). Дебљина плоча износи 15мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 100 mm - GKB12,5mm+CW75+GKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 100 мм - ГКБ12,5мм+ЦW75+ГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 75мм (ЦW75), која се обострано облаже обичним гипскартон плочама у једном слоју (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 125 mm - GKB12,5mm+CW100+GKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 125 мм - ГКБ12,5мм+ЦW100+ГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 100мм (ЦW100), која се обострано облаже обичним гипскартон плочама у једном слоју (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog  pregradnog zida ukupne debljine 80 mm - GKF15mm+CW50+GKF15mm',
                'rs-cyrl' => 'Израда противпожарног  преградног зида укупне дебљине 80 мм - ГКФ15мм+ЦW50+ГКФ15мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50),  koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 50мм (ЦW50),  која се обострано облаже противпожарним гипскартон плочама у једном слоју (ГКФ). Дебљина плоча износи 15мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 100 mm - GKF12,5mm+CW75+GKB12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 100 мм - ГКФ12,5мм+ЦW75+ГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 75мм (ЦW75), која се обострано облаже противпожарним гипскартон плочама у једном слоју (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - GKF12,5mm+CW100+GKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 125 мм - ГКФ12,5мм+ЦW100+ГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 100мм (ЦW100), која се обострано облаже противпожарним гипскартон плочама у једном слоју (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 100 mm - 2xGKB12,5mm+CW50+2xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 100 мм - 2xГКБ12,5мм+ЦW50+2xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 50мм (ЦW50), која се обострано облаже обичним гипскартон плочама у два слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 125 mm - 2xGKB12,5mm+CW75+2xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 125 мм - 2xГКБ12,5мм+ЦW75+2xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 50мм (ЦW75), која се обострано облаже обичним гипскартон плочама у два слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 150 mm - 2xGKB12,5mm+CW100+2xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 150 мм - 2xГКБ12,5мм+ЦW100+2xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 100мм (ЦW100), која се обострано облаже обичним гипскартон плочама у два слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 100 mm - 2xGKF12,5mm+CW50+2xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 100 мм - 2xГКФ12,5мм+ЦW50+2xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 50мм (ЦW50), која се обострано облаже противпожарним  гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - 2xGKF12,5mm+CW75+2xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 125 мм - 2xГКФ12,5мм+ЦW75+2xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 75мм (ЦW75), која се обострано облаже противпожарним  гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 150 mm - 2xGKF12,5mm+CW100+2xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 150 мм - 2xГКФ12,5мм+ЦW100+2xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 100мм (ЦW100), која се обострано облаже противпожарним  гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 125 mm - 3xGKB12,5mm+CW50+3xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 125 мм - 3xГКБ12,5мм+ЦW50+3xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 50мм (ЦW50), која се обострано облаже обичним гипскартон плочама у три слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 150 mm - 3xGKB12,5mm+CW75+3xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 150 мм - 3xГКБ12,5мм+ЦW75+3xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 75мм (ЦW75), која се обострано облаже обичним гипскартон плочама у три слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 175 mm - 3xGKB12,5mm+CW100+3xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 175 мм - 3xГКБ12,5мм+ЦW100+3xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 100мм (ЦW100), која се обострано облаже обичним гипскартон плочама у три слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - 3xGKF12,5mm+CW50+3xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 125 мм - 3xГКФ12,5мм+ЦW50+3xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 50мм (ЦW50), која се обострано облаже противпожарним  гипскартон плочама у три слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 150 mm - 3xGKF12,5mm+CW75+3xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 150 мм - 3xГКФ12,5мм+ЦW75+3xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 60mm (100kg/m3). Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 75мм (ЦW75), која се обострано облаже противпожарним  гипскартон плочама у три слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 60мм (100кг/м3). Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 175 mm - 3xGKF12,5mm+CW100+3xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 175 мм - 3xГКФ12,5мм+ЦW100+3xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 60mm (100kg/m3). Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од једноструке металне подконструкције ширине 100мм (ЦW100), која се обострано облаже противпожарним  гипскартон плочама у три слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 60мм (100кг/м3). Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 155 mm - 2xGKB12,5mm+2xCW50+2xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 155 мм - 2xГКБ12,5мм+2xЦW50+2xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 100mm (2xCW50), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од двоструке металне подконструкције ширине 100мм (2xЦW50), која се обострано облаже обичним гипскартон плочама у два слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 205 mm - 2xGKB12,5mm+2xCW75+2xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 205 мм - 2xГКБ12,5мм+2xЦW75+2xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 150mm (2xCW75), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од двоструке металне подконструкције ширине 150мм (2xЦW75), која се обострано облаже обичним гипскартон плочама у два слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada pregradnog zida ukupne debljine 255 mm - 2xGKB12,5mm+2xCW100+2xGKB12,5mm',
                'rs-cyrl' => 'Израда преградног зида укупне дебљине 255 мм - 2xГКБ12,5мм+2xЦW100+2xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 200mm (2xCW100), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од двоструке металне подконструкције ширине 200мм (2xЦW100), која се обострано облаже обичним гипскартон плочама у два слоја (ГКБ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 155 mm - 2xGKF12,5mm+2xCW50+2xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 155 мм - 2xГКФ12,5мм+2xЦW50+2xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 100mm (2xCW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од двоструке металне подконструкције ширине 100мм (2xЦW50), која се обострано облаже противпожарним  гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 205 mm - 2xGKF12,5mm+2xCW75+2xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 205 мм - 2xГКФ12,5мм+2xЦW75+2xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 150mm (2xCW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од двоструке металне подконструкције ширине 150мм (2xЦW75), која се обострано облаже противпожарним  гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 255 mm - 2xGKF12,5mm+2xCW100+2xGKF12,5mm',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 255 мм - 2xГКФ12,5мм+2xЦW100+2xГКФ12,5мм',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 200mm (2xCW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од двоструке металне подконструкције ширине 200мм (2xЦW100), која се обострано облаже противпожарним  гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 50мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '7',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 215 mm - 2xGKF12,5mm+CW75+1xGKF12,5mm+CW75+2xGKF12,5mm - sa dodatom 5. pločom',
                'rs-cyrl' => 'Израда противпожарног преградног зида укупне дебљине 215 мм - 2xГКФ12,5мм+ЦW75+1xГКФ12,5мм+ЦW75+2xГКФ12,5мм - са додатом 5. плочом',
              ],
              'description' => [
                'sr' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 2x75mm (2xCW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Između CW profila se postavlja jednostruka protivpožarna gipskarton ploča (GKF). Debljina svih ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 2x75mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Зид се састоји од двоструке металне подконструкције ширине 2x75мм (2xЦW75), која се обострано облаже противпожарним  гипскартон плочама у два слоја (ГКФ). Између ЦW профила се поставља једнострука противпожарна гипскартон плоча (ГКФ). Дебљина свих плоча износи 12,5мм. Унутрашњост зида се попуњава каменом вуном дебљине 2x75мм. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža i rušenje postojećih monolitnih plafona',
                'rs-cyrl' => 'Демонтажа и рушење постојећих монолитних плафона',
              ],
              'description' => [
                'sr' => 'Postojeći monolitni plafoni se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.',
                'rs-cyrl' => 'Постојећи монолитни плафони се у потпуности уклањају, укључујући и комплетну подконструкцију. Демонтирани материјал се износи ван објекта и депонује на унапед предвиђено место. Хоризонтални и вертикални транспорт шута и смећа се организује у складу са условима градилишта.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža i rušenje postojećih kasetiranih plafona',
                'rs-cyrl' => 'Демонтажа и рушење постојећих касетираних плафона',
              ],
              'description' => [
                'sr' => 'Postojeći kasetirani plafoni se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.',
                'rs-cyrl' => 'Постојећи касетирани плафони се у потпуности уклањају, укључујући и комплетну подконструкцију. Демонтирани материјал се износи ван објекта и депонује на унапед предвиђено место. Хоризонтални и вертикални транспорт шута и смећа се организује у складу са условима градилишта.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+1xGKB 12,5mm',
                'rs-cyrl' => 'Израда хоризонталног монолитног спуштеног плафона на једнострукој металној подконструкцији ЦД+1xГКБ 12,5мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне подконструкције ЦД, која се облаже обичним гипскартон плочама у једном слоју (ГКБ). Дебљина плоча износи 12,5мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+2xGKB 12,5mm',
                'rs-cyrl' => 'Израда хоризонталног монолитног спуштеног плафона на једнострукој металној подконструкцији ЦД+2xГКБ 12,5мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне подконструкције ЦД, која се облаже обичним гипскартон плочама у једном слоју (ГКБ). Дебљина плоча износи 12,5мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+3xGKB 12,5mm',
                'rs-cyrl' => 'Израда хоризонталног монолитног спуштеног плафона на једнострукој металној подконструкцији ЦД+3xГКБ 12,5мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне подконструкције ЦД, која се облаже обичним гипскартон плочама у једном слоју (ГКБ). Дебљина плоча износи 12,5мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+1xGKB 15mm',
                'rs-cyrl' => 'Израда противпожарног хоризонталног монолитног спуштеног плафона на једнострукој металној подконструкцији ЦД+1xГКБ 15мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне подконструкције ЦД, која се облаже противпожарним гипскартон плочама у једном слоју (ГКФ). Дебљина плоча износи 15мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+2xGKB 15mm',
                'rs-cyrl' => 'Израда противпожарног хоризонталног монолитног спуштеног плафона на једнострукој металној подконструкцији ЦД+2xГКБ 15мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне подконструкције ЦД, која се облаже противпожарним гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 15мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+3xGKB 15mm',
                'rs-cyrl' => 'Израда противпожарног хоризонталног монолитног спуштеног плафона на једнострукој металној подконструкцији ЦД+3xГКБ 15мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне подконструкције ЦД, која се облаже противпожарним гипскартон плочама у три слоја (ГКФ). Дебљина плоча износи 15мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+1xGKB 12,5mm',
                'rs-cyrl' => 'Израда хоризонталног монолитног спуштеног плафона на двострукој металној подконструкцији 2xЦД+1xГКБ 12,5мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од двоструке металне подконструкције ЦД, која се облаже обичним гипскартон плочама у једном слоју (ГКБ). Дебљина плоча износи 12,5мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+2xGKB 12,5mm',
                'rs-cyrl' => 'Израда хоризонталног монолитног спуштеног плафона на двострукој металној подконструкцији 2xЦД+2xГКБ 12,5мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од двоструке металне подконструкције ЦД, која се облаже обичним гипскартон плочама у два слоја (ГКБ). Дебљина плоча износи 12,5мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+3xGKB 12,5mm',
                'rs-cyrl' => 'Израда хоризонталног монолитног спуштеног плафона на двострукој металној подконструкцији 2xЦД+3xГКБ 12,5мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од двоструке металне подконструкције ЦД, која се облаже обичним гипскартон плочама у три слоја (ГКБ). Дебљина плоча износи 12,5мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+1xGKB 15mm',
                'rs-cyrl' => 'Израда противпожарног хоризонталног монолитног спуштеног плафона на двострукој металној подконструкцији 2xЦД+1xГКБ 15мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од двоструке металне подконструкције ЦД, која се облаже противпожарним гипскартон плочама у једном слоју (ГКФ). Дебљина плоча износи 15мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+2xGKB 15mm',
                'rs-cyrl' => 'Израда противпожарног хоризонталног монолитног спуштеног плафона на двострукој металној подконструкцији 2xЦД+2xГКБ 15мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од двоструке металне подконструкције ЦД, која се облаже противпожарним гипскартон плочама у два слоја (ГКФ). Дебљина плоча износи 15мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+3xGKB 15mm',
                'rs-cyrl' => 'Израда противпожарног хоризонталног монолитног спуштеног плафона на двострукој металној подконструкцији 2xЦД+3xГКБ 15мм',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од двоструке металне подконструкције ЦД, која се облаже противпожарним гипскартон плочама у три слоја (ГКФ). Дебљина плоча износи 15мм. Састави плоча се обрађују масом за испуну и бандаж траком. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog kasetiranog spuštenog plafona „Armstrong“ na jednostrukoj metalnoj vidljivoj konstrukciji',
                'rs-cyrl' => 'Израда хоризонталног касетираног спуштеног плафона „Армстронг“ на једнострукој металној видљивој конструкцији',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne „T“ konstrukcije koje je sastavljena od glavnih i poprečnih T-profila. U konstrukciju se postavljaju demontažne minealne ploče dimenzija 600x600mm sa ravnom ivicom i vidljivim T-profilima. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне „Т“ конструкције које је састављена од главних и попречних Т-профила. У конструкцију се постављају демонтажне минеалне плоче димензија 600x600мм са равном ивицом и видљивим Т-профилима. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '8',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izrada horizontalnog kasetiranog spuštenog plafona „Armstrong“ na jednostrukoj metalnoj nevidljivoj konstrukciji',
                'rs-cyrl' => 'Израда хоризонталног касетираног спуштеног плафона „Армстронг“ на једнострукој металној невидљивој конструкцији',
              ],
              'description' => [
                'sr' => 'Plafon se sastoji od jednostruke metalne „T“ konstrukcije koje je sastavljena od glavnih i poprečnih T-profila. U konstrukciju se postavljaju demontažne minealne ploče dimenzija 600x600mm sa ravnom ivicom i nevidljivim T-profilima. Spuštanje do 50cm.',
                'rs-cyrl' => 'Плафон се састоји од једноструке металне „Т“ конструкције које је састављена од главних и попречних Т-профила. У конструкцију се постављају демонтажне минеалне плоче димензија 600x600мм са равном ивицом и невидљивим Т-профилима. Спуштање до 50цм.',
              ],
            ],
            [
              'subcategory_id' => '9',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Suvo malterisanje ravnih zidova',
                'rs-cyrl' => 'Суво малтерисање равних зидова',
              ],
              'description' => [
                'sr' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove uz pomoć lepka (Fugenfüller) nanetog kao tankoslojni malter. Pre lepljenja, na zidove se nanosi prajmer, kako bi se poboljšalo prijanjanje. Lepak se nanosi po svim ivicama ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Лепљење гипсаних плоча дебљине 12,5мм (ГКБ) на постојеће зидове уз помоћ лепка (Фугенфüллер) нанетог као танкослојни малтер. Пре лепљења, на зидове се наноси прајмер, како би се побољшало пријањање. Лепак се наноси по свим ивицама плоче. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '9',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Suvo malterisanje zidova sa neravninama do 20mm',
                'rs-cyrl' => 'Суво малтерисање зидова са неравнинама до 20мм',
              ],
              'description' => [
                'sr' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove uz pomoć Perlfix lepka . Pre lepljenja, na zidove se nanosi prajme, kako bi se poboljšalo prijanjanje. Lepak se nanosi po ivicama i sredini ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Лепљење гипсаних плоча дебљине 12,5мм (ГКБ) на постојеће зидове уз помоћ Перлфиx лепка . Пре лепљења, на зидове се наноси прајме, како би се побољшало пријањање. Лепак се наноси по ивицама и средини плоче. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '9',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Suvo malterisanje zidova sa neravninama preko 20mm',
                'rs-cyrl' => 'Суво малтерисање зидова са неравнинама преко 20мм',
              ],
              'description' => [
                'sr' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove se vrši preko unapred zalepljenih traka od gipsanih ploča širine 100mm koje se lepe uz pomoć Perlfix lepka.  Ploče se za podlogu lepe uz pomoć lepka (Fugenfüller) nanetog kao tankoslojni malter.  Lepak se nanosi po ivicama i sredini ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Лепљење гипсаних плоча дебљине 12,5мм (ГКБ) на постојеће зидове се врши преко унапред залепљених трака од гипсаних плоча ширине 100мм које се лепе уз помоћ Перлфиx лепка.  Плоче се за подлогу лепе уз помоћ лепка (Фугенфüллер) нанетог као танкослојни малтер.  Лепак се наноси по ивицама и средини плоче. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '9',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Oblaganje zida na metalnoj podkonstrukciji - jednostruko oblaganje CW+GKB12,5mm',
                'rs-cyrl' => 'Облагање зида на металној подконструкцији - једноструко облагање ЦW+ГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Gipskarton ploče se u jednom sloju postavljeju preko pripremljene metalne podkonstrukcije od CW profila. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Гипскартон плоче се у једном слоју постављеју преко припремљене металне подконструкције од ЦW профила. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '9',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Oblaganje zida na metalnoj podkonstrukciji - dvostruko oblaganje CW+2xGKB12,5mm',
                'rs-cyrl' => 'Облагање зида на металној подконструкцији - двоструко облагање ЦW+2xГКБ12,5мм',
              ],
              'description' => [
                'sr' => 'Gipskarton ploče se u jednom sloju postavljeju preko pripremljene metalne podkonstrukcije od CW profila. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.',
                'rs-cyrl' => 'Гипскартон плоче се у једном слоју постављеју преко припремљене металне подконструкције од ЦW профила. Састави плоча се обрађују масом за испуну и бандаж траком.',
              ],
            ],
            [
              'subcategory_id' => '9',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Ugradnja termoizolacije u sistem obložnog zida',
                'rs-cyrl' => 'Уградња термоизолације у систем обложног зида',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '10',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Izrada obloge kablovskih regala - dvostrana',
                'rs-cyrl' => 'Израда облоге кабловских регала - двострана',
              ],
              'description' => [
                'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.',
                'rs-cyrl' => 'Облога се састоји од сопствене носеће металне конструкције преко које се по потреби поставља изолација од камене вуне и монтирају одговарајуће гипскартон плоче.',
              ],
            ],
            [
              'subcategory_id' => '10',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Izrada obloge kablovskih regala - trostrana',
                'rs-cyrl' => 'Израда облоге кабловских регала - тространа',
              ],
              'description' => [
                'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.',
                'rs-cyrl' => 'Облога се састоји од сопствене носеће металне конструкције преко које се по потреби поставља изолација од камене вуне и монтирају одговарајуће гипскартон плоче.',
              ],
            ],
            [
              'subcategory_id' => '10',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Izrada obloge kablovskih regala - četvorostrana',
                'rs-cyrl' => 'Израда облоге кабловских регала - четворострана',
              ],
              'description' => [
                'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.',
                'rs-cyrl' => 'Облога се састоји од сопствене носеће металне конструкције преко које се по потреби поставља изолација од камене вуне и монтирају одговарајуће гипскартон плоче.',
              ],
            ],
            [
              'subcategory_id' => '10',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Izrada obloge ventilacionih kanala - trostrana',
                'rs-cyrl' => 'Израда облоге вентилационих канала - тространа',
              ],
              'description' => [
                'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.',
                'rs-cyrl' => 'Облога се састоји од сопствене носеће металне конструкције преко које се по потреби поставља изолација од камене вуне и монтирају одговарајуће гипскартон плоче.',
              ],
            ],
            [
              'subcategory_id' => '10',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Izrada obloge ventilacionih kanala - četvorostrana',
                'rs-cyrl' => 'Израда облоге вентилационих канала - четворострана',
              ],
              'description' => [
                'sr' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.',
                'rs-cyrl' => 'Облога се састоји од сопствене носеће металне конструкције преко које се по потреби поставља изолација од камене вуне и монтирају одговарајуће гипскартон плоче.',
              ],
            ],
            [
              'subcategory_id' => '11',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje pločica postavljenih u cementni malter sa zidova',
                'rs-cyrl' => 'Обијање плочица постављених у цементни малтер са зидова',
              ],
              'description' => [
                'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.',
                'rs-cyrl' => 'Плочице се обијају ручно или машински. Шут се износи из објекта и депонује на градилишну депонију отпада.',
              ],
            ],
            [
              'subcategory_id' => '11',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje pločica postavljenih u lepak sa zidova',
                'rs-cyrl' => 'Обијање плочица постављених у лепак са зидова',
              ],
              'description' => [
                'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.',
                'rs-cyrl' => 'Плочице се обијају ручно или машински. Шут се износи из објекта и депонује на градилишну депонију отпада.',
              ],
            ],
            [
              'subcategory_id' => '11',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje pločica postavljenih u cementni malter sa podova',
                'rs-cyrl' => 'Обијање плочица постављених у цементни малтер са подова',
              ],
              'description' => [
                'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.',
                'rs-cyrl' => 'Плочице се обијају ручно или машински. Шут се износи из објекта и депонује на градилишну депонију отпада.',
              ],
            ],
            [
              'subcategory_id' => '11',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje pločica postavljenih u lepak sa podova',
                'rs-cyrl' => 'Обијање плочица постављених у лепак са подова',
              ],
              'description' => [
                'sr' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.',
                'rs-cyrl' => 'Плочице се обијају ручно или машински. Шут се износи из објекта и депонује на градилишну депонију отпада.',
              ],
            ],
            [
              'subcategory_id' => '11',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izravnavanje obijenih površina',
                'rs-cyrl' => 'Изравнавање обијених површина',
              ],
              'description' => [
                'sr' => 'Obijene površine se izravnavaju upotrebom građevinskog lepka u cilju pripreme za postavljanje novih pločica.',
                'rs-cyrl' => 'Обијене површине се изравнавају употребом грађевинског лепка у циљу припреме за постављање нових плочица.',
              ],
            ],
            [
              'subcategory_id' => '11',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Čišćenje gradilišta nakon završenih radova',
                'rs-cyrl' => 'Чишћење градилишта након завршених радова',
              ],
              'description' => [
                'sr' => 'Sav otpadni materijal utovariti u kamion i odvesti na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Сав отпадни материјал утоварити у камион и одвести на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje zidnih keramičkih pločica u cementnom malteru',
                'rs-cyrl' => 'Постављање зидних керамичких плочица у цементном малтеру',
              ],
              'description' => [
                'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje zidnih keramičkih pločica u lepku',
                'rs-cyrl' => 'Постављање зидних керамичких плочица у лепку',
              ],
              'description' => [
                'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje zidnog keramičkog mozaika',
                'rs-cyrl' => 'Постављање зидног керамичког мозаика',
              ],
              'description' => [
                'sr' => 'Mozaik se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljeni mozaik se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenog mozaika.',
                'rs-cyrl' => 'Мозаик се поставља у договореном распореду и слогу на припремљену подлогу. Постављени мозаик се фугује одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављеног мозаика.',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje zidne keramičke bordure',
                'rs-cyrl' => 'Постављање зидне керамичке бордуре',
              ],
              'description' => [
                'sr' => 'Bordura se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljena bordura se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljene bordure.',
                'rs-cyrl' => 'Бордура се поставља у договореном распореду и слогу на припремљену подлогу. Постављена бордура се фугује одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављене бордуре.',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje zidnih keramičkih listela',
                'rs-cyrl' => 'Постављање зидних керамичких листела',
              ],
              'description' => [
                'sr' => 'Listela se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene listele se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih listela.',
                'rs-cyrl' => 'Листела се поставља у договореном распореду и слогу на припремљену подлогу. Постављене листеле се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених листела.',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje bazenskih zidnih keramičkih pločica',
                'rs-cyrl' => 'Постављање базенских зидних керамичких плочица',
              ],
              'description' => [
                'sr' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се уз помоћ лепка одређеног од стране пројектанта постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Silikoniranje negativnih uglova na spojevima keramičkih pločica',
                'rs-cyrl' => 'Силиконирање негативних углова на спојевима керамичких плочица',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje prefabrikovanih lajsni na pozitivne uglove spojeva keramičkih pločica',
                'rs-cyrl' => 'Постављање префабрикованих лајсни на позитивне углове спојева керамичких плочица',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '12',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje prefabrikovanih lajsni na gornju ivicu ugrađenih sokli od keramičkih pločica',
                'rs-cyrl' => 'Постављање префабрикованих лајсни на горњу ивицу уграђених сокли од керамичких плочица',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje podnih keramičkih pločica u cementnom malteru',
                'rs-cyrl' => 'Постављање подних керамичких плочица у цементном малтеру',
              ],
              'description' => [
                'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje podnih keramičkih pločica u lepku',
                'rs-cyrl' => 'Постављање подних керамичких плочица у лепку',
              ],
              'description' => [
                'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje keramičke sokle visine do 15cm',
                'rs-cyrl' => 'Постављање керамичке сокле висине до 15цм',
              ],
              'description' => [
                'sr' => 'Sokla se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljena sokla  se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine sokle.',
                'rs-cyrl' => 'Сокла се поставља у договореном распореду и слогу на припремљену подлогу. Постављена сокла  се фугује одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине сокле.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje podnog keramičkog mozaika',
                'rs-cyrl' => 'Постављање подног керамичког мозаика',
              ],
              'description' => [
                'sr' => 'Mozaik se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljeni mozaik se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenog mozaika.',
                'rs-cyrl' => 'Мозаик се поставља у договореном распореду и слогу на припремљену подлогу. Постављени мозаик се фугује одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављеног мозаика.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje bazenskih podnih keramičkih pločica',
                'rs-cyrl' => 'Постављање базенских подних керамичких плочица',
              ],
              'description' => [
                'sr' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се уз помоћ лепка одређеног од стране пројектанта постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje protivkliznih podnih keramičkih pločica oko bazena',
                'rs-cyrl' => 'Постављање противклизних подних керамичких плочица око базена',
              ],
              'description' => [
                'sr' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се уз помоћ лепка одређеног од стране пројектанта постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje prefabrikovanih profilisanih keramičkih preliva po obimu bazena',
                'rs-cyrl' => 'Постављање префабрикованих профилисаних керамичких прелива по обиму базена',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje prefabrikovanih profilisanih keramičkih prelivnih kanala po obimu bazena zajedno sa PVC ili prohrom rešetkama',
                'rs-cyrl' => 'Постављање префабрикованих профилисаних керамичких преливних канала по обиму базена заједно са ПВЦ или прохром решеткама',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje keramičkih pločica na čelo stepenika',
                'rs-cyrl' => 'Постављање керамичких плочица на чело степеника',
              ],
              'description' => [
                'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje keramičkih pločica na gazište stepenika',
                'rs-cyrl' => 'Постављање керамичких плочица на газиште степеника',
              ],
              'description' => [
                'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.',
                'rs-cyrl' => 'Плочице се постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица.',
              ],
            ],
            [
              'subcategory_id' => '13',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje keramičkih pločica na stepenice (gazište i čelo stepenika)',
                'rs-cyrl' => 'Постављање керамичких плочица на степенице (газиште и чело степеника)',
              ],
              'description' => [
                'sr' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica. ',
                'rs-cyrl' => 'Плочице се постављају у договореном распореду и слогу на припремљену подлогу. Постављене плочице се фугују одабраном масом за фуговање. Након фуговања, врши се чишћење целокупне површине постављених плочица. ',
              ],
            ],
            [
              'subcategory_id' => '14',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Iznošenje postojećeg nameštaja iz prostora u kome se vrše parketarski radovi',
                'rs-cyrl' => 'Изношење постојећег намештаја из простора у коме се врше паркетарски радови',
              ],
              'description' => [
                'sr' => 'Nameštaj se deponuje u okviru objekta.',
                'rs-cyrl' => 'Намештај се депонује у оквиру објекта.',
              ],
            ],
            [
              'subcategory_id' => '14',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Pomeranje nameštaja u prostoriji gde se vrše parketarski radovi',
                'rs-cyrl' => 'Померање намештаја у просторији где се врше паркетарски радови',
              ],
              'description' => [
                'sr' => 'Nameštaj se nakon izvršenih radova vraća na svoje prvobitno mesto',
                'rs-cyrl' => 'Намештај се након извршених радова враћа на своје првобитно место',
              ],
            ],
            [
              'subcategory_id' => '14',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža stare podne obloge od parketa',
                'rs-cyrl' => 'Демонтажа старе подне облоге од паркета',
              ],
              'description' => [
                'sr' => 'Parket i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km',
                'rs-cyrl' => 'Паркет и лајсне се пажљиво демонтирају и депонују у оквиру градилишта на место које које одреди инвеститор. Шут и остали отпадни материјал се товари у превозно средство и одвози на градску депонију на удаљености до 10км',
              ],
            ],
            [
              'subcategory_id' => '14',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža stare podne obloge od parketa i slepog poda',
                'rs-cyrl' => 'Демонтажа старе подне облоге од паркета и слепог пода',
              ],
              'description' => [
                'sr' => 'Parket, lajsne i gredice se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Pesak, šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km',
                'rs-cyrl' => 'Паркет, лајсне и гредице се пажљиво демонтирају и депонују у оквиру градилишта на место које које одреди инвеститор. Песак, шут и остали отпадни материјал се товари у превозно средство и одвози на градску депонију на удаљености до 10км',
              ],
            ],
            [
              'subcategory_id' => '14',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža stare podne obloge od brodskog poda',
                'rs-cyrl' => 'Демонтажа старе подне облоге од бродског пода',
              ],
              'description' => [
                'sr' => 'Brodski pod i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km',
                'rs-cyrl' => 'Бродски под и лајсне се пажљиво демонтирају и депонују у оквиру градилишта на место које које одреди инвеститор. Шут и остали отпадни материјал се товари у превозно средство и одвози на градску депонију на удаљености до 10км',
              ],
            ],
            [
              'subcategory_id' => '14',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža stare podne obloge od brodskog poda sa slepim podom',
                'rs-cyrl' => 'Демонтажа старе подне облоге од бродског пода са слепим подом',
              ],
              'description' => [
                'sr' => 'Brodski pod, lajsne i gredice se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Pesak, šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km',
                'rs-cyrl' => 'Бродски под, лајсне и гредице се пажљиво демонтирају и депонују у оквиру градилишта на место које које одреди инвеститор. Песак, шут и остали отпадни материјал се товари у превозно средство и одвози на градску депонију на удаљености до 10км',
              ],
            ],
            [
              'subcategory_id' => '14',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Sortiranje i povezivanje demontiranog parketa',
                'rs-cyrl' => 'Сортирање и повезивање демонтираног паркета',
              ],
              'description' => [
                'sr' => 'Demontirani parket se sortira i povezuje u buntove i odlaže u okviru gradilišta na mesto koje odredi investitor.',
                'rs-cyrl' => 'Демонтирани паркет се сортира и повезује у бунтове и одлаже у оквиру градилишта на место које одреди инвеститор.',
              ],
            ],
            [
              'subcategory_id' => '15',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Delimično krpljenje velikih oštećenja u podlozi',
                'rs-cyrl' => 'Делимично крпљење великих оштећења у подлози',
              ],
              'description' => [
                'sr' => 'Oštećenja podloge se isecaju, obijaju, čiste, otprašuju i impregniraju radi boljeg prijanjanja, nakon čega se popunjavaju sitnozrnim betonom i nivelišu u odnosu na okolnu  površinu podloge. Finalno se perdaše radi postizanja potrebne glatkoće.',
                'rs-cyrl' => 'Оштећења подлоге се исецају, обијају, чисте, отпрашују и импрегнирају ради бољег пријањања, након чега се попуњавају ситнозрним бетоном и нивелишу у односу на околну  површину подлоге. Финално се пердаше ради постизања потребне глаткоће.',
              ],
            ],
            [
              'subcategory_id' => '15',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izravnavanje postojeće rapave podloge',
                'rs-cyrl' => 'Изравнавање постојеће рапаве подлоге',
              ],
              'description' => [
                'sr' => 'Kompletna površina postijeće podloge se otprašuje i impregnira radi boljeg prijanjanja, nakon čega se nanosi samonivelirajuća masa za izravnavanje. Nakon sušenja izravnavajuće mase, po potrebi se vrši mašinsko brušenje.',
                'rs-cyrl' => 'Комплетна површина постијеће подлоге се отпрашује и импрегнира ради бољег пријањања, након чега се наноси самонивелирајућа маса за изравнавање. Након сушења изравнавајуће масе, по потреби се врши машинско брушење.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje hrastovog parketa d=22mm ukivanjem u podlogu',
                'rs-cyrl' => 'Постављање храстовог паркета д=22мм укивањем у подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje hrastovog parketa d=22mm lepljenjem za podlogu',
                'rs-cyrl' => 'Постављање храстовог паркета д=22мм лепљењем за подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje hrastovog parketa d=22mm preko vrućeg bitumena',
                'rs-cyrl' => 'Постављање храстовог паркета д=22мм преко врућег битумена',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm ukivanjem u podlogu',
                'rs-cyrl' => 'Постављање и хобловање храстовог паркета д=22мм укивањем у подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm lepljenjem za  podlogu',
                'rs-cyrl' => 'Постављање и хобловање храстовог паркета д=22мм лепљењем за  подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm preko vrućeg bitumena',
                'rs-cyrl' => 'Постављање и хобловање храстовог паркета д=22мм преко врућег битумена',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje, hoblovanje i lakiranje hrastovog parketa d=22mm ukivanjem u podlogu',
                'rs-cyrl' => 'Постављање, хобловање и лакирање храстовог паркета д=22мм укивањем у подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje, hoblovanje i lakiranje hrastovog parketa d=22mm lepljenjem za  podlogu',
                'rs-cyrl' => 'Постављање, хобловање и лакирање храстовог паркета д=22мм лепљењем за  подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje,  hoblovanje i lakiranje hrastovog parketa d=22mm preko vrućeg bitumena',
                'rs-cyrl' => 'Постављање,  хобловање и лакирање храстовог паркета д=22мм преко врућег битумена',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje hrastovog lamel parketa lepljenjem za  podlogu',
                'rs-cyrl' => 'Постављање храстовог ламел паркета лепљењем за  подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje i hoblovanje hrastovog lamel parketa lepljenjem za  podlogu',
                'rs-cyrl' => 'Постављање и хобловање храстовог ламел паркета лепљењем за  подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje, hoblovanjei lakiranje hrastovog lamel parketa lepljenjem za  podlogu',
                'rs-cyrl' => 'Постављање, хобловањеи лакирање храстовог ламел паркета лепљењем за  подлогу',
              ],
              'description' => [
                'sr' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Паркет се поставља на очишћену подлогу. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje, hoblovanjei lakiranje hrastovog lamel parketa kao „plivajućeg“ poda',
                'rs-cyrl' => 'Постављање, хобловањеи лакирање храстовог ламел паркета као „пливајућег“ пода',
              ],
              'description' => [
                'sr' => 'Preko očišćene podloge se postavlja PVC folija i filc. Parket se postavlja podužno, kao brodski pod. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
                'rs-cyrl' => 'Преко очишћене подлоге се поставља ПВЦ фолија и филц. Паркет се поставља подужно, као бродски под. По обиму пода се постављају одговарајуће храстове лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Hoblovanje i lakiranje postojećeg parketa sa sitnim popravkama',
                'rs-cyrl' => 'Хобловање и лакирање постојећег паркета са ситним поправкама',
              ],
              'description' => [
                'sr' => 'Sitna oštećenja i otvorene fuge se kituju smesom pilotine i laka.',
                'rs-cyrl' => 'Ситна оштећења и отворене фуге се китују смесом пилотине и лака.',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '3',
              'title' => [
                'sr' => 'Krpljenje parketa na mestu demontirane peći',
                'rs-cyrl' => 'Крпљење паркета на месту демонтиране пећи',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '3',
              'title' => [
                'sr' => 'Krpljenje parketa na mestu probijanja otvora za vrata u zidu',
                'rs-cyrl' => 'Крпљење паркета на месту пробијања отвора за врата у зиду',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Krpljenje parketa na mestu uklanjanja zida',
                'rs-cyrl' => 'Крпљење паркета на месту уклањања зида',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '16',
              'unit_id' => '3',
              'title' => [
                'sr' => 'Postavljanje i lakiranje novih hrastovih pragova',
                'rs-cyrl' => 'Постављање и лакирање нових храстових прагова',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '17',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža poda od itisona u rolnama',
                'rs-cyrl' => 'Демонтажа пода од итисона у ролнама',
              ],
              'description' => [
                'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km',
                'rs-cyrl' => 'Отпад утоварити у превозно средство и одвести на градску депонију удаљену до 10км',
              ],
            ],
            [
              'subcategory_id' => '17',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža poda od itisona u pločama',
                'rs-cyrl' => 'Демонтажа пода од итисона у плочама',
              ],
              'description' => [
                'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km',
                'rs-cyrl' => 'Отпад утоварити у превозно средство и одвести на градску депонију удаљену до 10км',
              ],
            ],
            [
              'subcategory_id' => '17',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža PVC poda u rolnama',
                'rs-cyrl' => 'Демонтажа ПВЦ пода у ролнама',
              ],
              'description' => [
                'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km',
                'rs-cyrl' => 'Отпад утоварити у превозно средство и одвести на градску депонију удаљену до 10км',
              ],
            ],
            [
              'subcategory_id' => '17',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža PVC poda u pločama',
                'rs-cyrl' => 'Демонтажа ПВЦ пода у плочама',
              ],
              'description' => [
                'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km',
                'rs-cyrl' => 'Отпад утоварити у превозно средство и одвести на градску депонију удаљену до 10км',
              ],
            ],
            [
              'subcategory_id' => '17',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža poda od gume u rolnama',
                'rs-cyrl' => 'Демонтажа пода од гуме у ролнама',
              ],
              'description' => [
                'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km',
                'rs-cyrl' => 'Отпад утоварити у превозно средство и одвести на градску депонију удаљену до 10км',
              ],
            ],
            [
              'subcategory_id' => '17',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža poda od gume u pločama',
                'rs-cyrl' => 'Демонтажа пода од гуме у плочама',
              ],
              'description' => [
                'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km',
                'rs-cyrl' => 'Отпад утоварити у превозно средство и одвести на градску депонију удаљену до 10км',
              ],
            ],
            [
              'subcategory_id' => '17',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Mašinsko i ručno obijanje postojećeg poda od samorazlivajućeg epoksidnog (sintetičkog) materijala',
                'rs-cyrl' => 'Машинско и ручно обијање постојећег пода од саморазливајућег епоксидног (синтетичког) материјала',
              ],
              'description' => [
                'sr' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km',
                'rs-cyrl' => 'Отпад утоварити у превозно средство и одвести на градску депонију удаљену до 10км',
              ],
            ],
            [
              'subcategory_id' => '18',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Delimično krpljenje velikih oštećenja u podlozi',
                'rs-cyrl' => 'Делимично крпљење великих оштећења у подлози',
              ],
              'description' => [
                'sr' => 'Oštećenja podloge se isecaju, obijaju, čiste, otprašuju i impregniraju radi boljeg prijanjanja, nakon čega se popunjavaju sitnozrnim betonom i nivelišu u odnosu na okolnu  površinu podloge. Finalno se perdaše radi postizanja potrebne glatkoće.',
                'rs-cyrl' => 'Оштећења подлоге се исецају, обијају, чисте, отпрашују и импрегнирају ради бољег пријањања, након чега се попуњавају ситнозрним бетоном и нивелишу у односу на околну  површину подлоге. Финално се пердаше ради постизања потребне глаткоће.',
              ],
            ],
            [
              'subcategory_id' => '18',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Izravnavanje postojeće rapave podloge',
                'rs-cyrl' => 'Изравнавање постојеће рапаве подлоге',
              ],
              'description' => [
                'sr' => 'Kompletna površina postijeće podloge se otprašuje i impregnira radi boljeg prijanjanja, nakon čega se nanosi samonivelirajuća masa za izravnavanje. Nakon sušenja izravnavajuće mase, po potrebi se vrši mašinsko brušenje.',
                'rs-cyrl' => 'Комплетна површина постијеће подлоге се отпрашује и импрегнира ради бољег пријањања, након чега се наноси самонивелирајућа маса за изравнавање. Након сушења изравнавајуће масе, по потреби се врши машинско брушење.',
              ],
            ],
            [
              'subcategory_id' => '18',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Mašinsko brušenje neravne betonske podloge dijamantskim diskovima',
                'rs-cyrl' => 'Машинско брушење неравне бетонске подлоге дијамантским дисковима',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje tekstilne podne obloge – itisona u pločama',
                'rs-cyrl' => 'Постављање текстилне подне облоге – итисона у плочама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje tekstilne podne obloge – itisona u rolnama',
                'rs-cyrl' => 'Постављање текстилне подне облоге – итисона у ролнама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем.',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje podne obloge od industrijske gume u pločama',
                'rs-cyrl' => 'Постављање подне облоге од индустријске гуме у плочама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем.',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje podne obloge od industrijske gume u rolnama',
                'rs-cyrl' => 'Постављање подне облоге од индустријске гуме у ролнама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем.',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje PVC podne obloge u pločama',
                'rs-cyrl' => 'Постављање ПВЦ подне облоге у плочама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje PVC podne obloge u rolnama',
                'rs-cyrl' => 'Постављање ПВЦ подне облоге у ролнама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje elektrootporne podne obloge u pločama',
                'rs-cyrl' => 'Постављање електроотпорне подне облоге у плочама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Postavljanje elektroprovodne podne obloge u pločama',
                'rs-cyrl' => 'Постављање електропроводне подне облоге у плочама',
              ],
              'description' => [
                'sr' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem grafitnim lepkom preko mreže provodnika fiksiranih za podlogu',
                'rs-cyrl' => 'Подна облога се на припремљену, очишћену и суву подлогу причвршћује лепљењем графитним лепком преко мреже проводника фиксираних за подлогу',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje tvrdih PVC  lajsni na spoju poda i zidova',
                'rs-cyrl' => 'Постављање тврдих ПВЦ  лајсни на споју пода и зидова',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '19',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Postavljanje mekih PVC lajsni na spoju poda i zidova',
                'rs-cyrl' => 'Постављање меких ПВЦ лајсни на споју пода и зидова',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '20',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Pomeranje postojećeg nameštaja iz prostora koji se adaptira.',
                'rs-cyrl' => 'Померање постојећег намештаја из простора који се адаптира.',
              ],
              'description' => [
                'sr' => 'Nameštaj se po završenim radovima vraća na prvobitno mesto.',
                'rs-cyrl' => 'Намештај се по завршеним радовима враћа на првобитно место.',
              ],
            ],
            [
              'subcategory_id' => '20',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Iznošenje postojećeg nameštaja iz prostora koji se adaptira.',
                'rs-cyrl' => 'Изношење постојећег намештаја из простора који се адаптира.',
              ],
              'description' => [
                'sr' => 'Nameštaj se deponuje u okviru objekta.',
                'rs-cyrl' => 'Намештај се депонује у оквиру објекта.',
              ],
            ],
            [
              'subcategory_id' => '20',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Nabavka i postavljanje polietilenske folije preko otvora, vrata i prozora, radi zaštite.',
                'rs-cyrl' => 'Набавка и постављање полиетиленске фолије преко отвора, врата и прозора, ради заштите.',
              ],
              'description' => [
                'sr' => 'Folija se učvršćuje, vodeći računa da se ne ošteti postojeća stolarija.',
                'rs-cyrl' => 'Фолија се учвршћује, водећи рачуна да се не оштети постојећа столарија.',
              ],
            ],
            [
              'subcategory_id' => '20',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Nabavka i postavljanje polietilenske folije preko nameštaja, radi zaštite.',
                'rs-cyrl' => 'Набавка и постављање полиетиленске фолије преко намештаја, ради заштите.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '20',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Nabavka i postavljanje deblje polietilenske folije za zaštitu podova.',
                'rs-cyrl' => 'Набавка и постављање дебље полиетиленске фолије за заштиту подова.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '20',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Montaža i demontaža pomoćne skele u objektu, za rad u prostorijama.',
                'rs-cyrl' => 'Монтажа и демонтажа помоћне скеле у објекту, за рад у просторијама.',
              ],
              'description' => [
                'sr' => 'Skela se izrađuje po svim propisima.',
                'rs-cyrl' => 'Скела се израђује по свим прописима.',
              ],
            ],
            [
              'subcategory_id' => '21',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Čišćenje i pranje prozora i vrata po završetku radova.',
                'rs-cyrl' => 'Чишћење и прање прозора и врата по завршетку радова.',
              ],
              'description' => [
                'sr' => 'Pranje se obavlja vodom sa dodatkom odgovarajućih hemijskih sredstava.',
                'rs-cyrl' => 'Прање се обавља водом са додатком одговарајућих хемијских средстава.',
              ],
            ],
            [
              'subcategory_id' => '21',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Detaljno čišćenje celog gradilišta, pranje svih staklenih površina, čišćenje i fino pranje svih unutrašnjih prostora i spoljnih površina.',
                'rs-cyrl' => 'Детаљно чишћење целог градилишта, прање свих стаклених површина, чишћење и фино прање свих унутрашњих простора и спољних површина.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '21',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Periodično grubo čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Периодично грубо чишћење објекта од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '21',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Periodično grubo čišćenje gradilišta (u i oko objekta) od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Периодично грубо чишћење градилишта (у и око објекта) од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '21',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Periodično grubo čišćenje trotoara oko objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Периодично грубо чишћење тротоара око објекта од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '21',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Završno čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Завршно чишћење објекта од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '21',
              'unit_id' => '5',
              'title' => [
                'sr' => 'Utovar otpadnog materijala u kamion i odvoz na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Утовар отпадног материјала у камион и одвоз на градску депонију удаљену до 10км.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '22',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Periodično grubo čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Периодично грубо чишћење објекта од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '22',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Periodično grubo čišćenje gradilišta (u i oko objekta) od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Периодично грубо чишћење градилишта (у и око објекта) од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '22',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Periodično grubo čišćenje trotoara oko objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Периодично грубо чишћење тротоара око објекта од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '22',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Završno čišćenje objekta od građevinskog šuta i otpada sa prenosom otpadnog materijala na gradilišnu deponiju.',
                'rs-cyrl' => 'Завршно чишћење објекта од грађевинског шута и отпада са преносом отпадног материјала на градилишну депонију.',
              ],
              'description' => [
                'sr' => 'Plaća se jedanput bez obzira na broj čišćenja.',
                'rs-cyrl' => 'Плаћа се једанпут без обзира на број чишћења.',
              ],
            ],
            [
              'subcategory_id' => '22',
              'unit_id' => '5',
              'title' => [
                'sr' => 'Utovar otpadnog materijala u kamion i odvoz na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Утовар отпадног материјала у камион и одвоз на градску депонију удаљену до 10км.',
              ],
              'description' => [
                'sr' => '',
                'rs-cyrl' => '',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '3',
              'title' => [
                'sr' => 'Probijanje zida ili plafona za prolaz vodovodnih ili kanalizacionih cevi.',
                'rs-cyrl' => 'Пробијање зида или плафона за пролаз водоводних или канализационих цеви.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '4',
              'title' => [
                'sr' => 'Izrada šliceva u zida od opeke za prolaz vodovodnih ili kanalizacionih cevi.',
                'rs-cyrl' => 'Израда шлицева у зида од опеке за пролаз водоводних или канализационих цеви.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Probijanje pregradnog zida od opeke za izradu otvora za nova vrata.',
                'rs-cyrl' => 'Пробијање преградног зида од опеке за израду отвора за нова врата.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km. U cenu je uračunato i podupiranje.',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км. У цену је урачунато и подупирање.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Probijanjenosećeg zida od opeke za izradu otvora za nova vrata.',
                'rs-cyrl' => 'Пробијањеносећег зида од опеке за израду отвора за нова врата.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km. U cenu je uračunato i podupiranje.',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км. У цену је урачунато и подупирање.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Probijanje armirano betonske ploče i formiranje otvora.',
                'rs-cyrl' => 'Пробијање армирано бетонске плоче и формирање отвора.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km. U cenu je uračunato i sečenje armatura i potrebna skela',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км. У цену је урачунато и сечење арматура и потребна скела',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje krečnog maltera sa zidova.',
                'rs-cyrl' => 'Обијање кречног малтера са зидова.',
              ],
              'description' => [
                'sr' => 'Nakon obijanja maltera, fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Након обијања малтера, фуге се чисте кланфама до дубине од 2цм, а површина опеке се чисти челичним четкама. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje produžnog maltera sa zidova.',
                'rs-cyrl' => 'Обијање продужног малтера са зидова.',
              ],
              'description' => [
                'sr' => 'Nakon obijanja maltera, fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Након обијања малтера, фуге се чисте кланфама до дубине од 2цм, а површина опеке се чисти челичним четкама. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje cementnog  maltera sa zidova.',
                'rs-cyrl' => 'Обијање цементног  малтера са зидова.',
              ],
              'description' => [
                'sr' => 'Nakon obijanja maltera, fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Након обијања малтера, фуге се чисте кланфама до дубине од 2цм, а површина опеке се чисти челичним четкама. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Obijanje maltera sa plafona.',
                'rs-cyrl' => 'Обијање малтера са плафона.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Čišćenje fuga od opeke.',
                'rs-cyrl' => 'Чишћење фуга од опеке.',
              ],
              'description' => [
                'sr' => 'Fuge se čiste klanfama do dubine od 2cm, a površina opeke se čisti čeličnim četkama. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Фуге се чисте кланфама до дубине од 2цм, а површина опеке се чисти челичним четкама. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Rušenje pregradnih zidova od opeke u produžnom malteru.',
                'rs-cyrl' => 'Рушење преградних зидова од опеке у продужном малтеру.',
              ],
              'description' => [
                'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Opeku očistiti od maltera i složiti na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'У цени је и рушење серклажа, надвратника, надпрозорника и свим зидним облогама. Опеку очистити од малтера и сложити на градилишну депонију. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '2',
              'title' => [
                'sr' => 'Rušenje nosećih zidova od opeke u produžnom malteru.',
                'rs-cyrl' => 'Рушење носећих зидова од опеке у продужном малтеру.',
              ],
              'description' => [
                'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Opeka  se čisti od maltera i slaže na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'У цени је и рушење серклажа, надвратника, надпрозорника и свим зидним облогама. Опека  се чисти од малтера и слаже на градилишну депонију. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '2',
              'title' => [
                'sr' => 'Rušenje zidova od blokova.',
                'rs-cyrl' => 'Рушење зидова од блокова.',
              ],
              'description' => [
                'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Blokovi se  čiste od maltera i slažu na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'У цени је и рушење серклажа, надвратника, надпрозорника и свим зидним облогама. Блокови се  чисте од малтера и слажу на градилишну депонију. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '2',
              'title' => [
                'sr' => 'Rušenje zidova od Ytong blokova.',
                'rs-cyrl' => 'Рушење зидова од Yтонг блокова.',
              ],
              'description' => [
                'sr' => 'U ceni je i rušenje serklaža, nadvratnika, nadprozornika i svim zidnim oblogama. Blokovi se  čiste od maltera i slažu na gradilišnu deponiju. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'У цени је и рушење серклажа, надвратника, надпрозорника и свим зидним облогама. Блокови се  чисте од малтера и слажу на градилишну депонију. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Rušenje i demontaža zidova od gips-karton ploča.',
                'rs-cyrl' => 'Рушење и демонтажа зидова од гипс-картон плоча.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '23',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Probijanje i isecanje otvora u  zidovima i plafonima od armiranog betona.',
                'rs-cyrl' => 'Пробијање и исецање отвора у  зидовима и плафонима од армираног бетона.',
              ],
              'description' => [
                'sr' => 'U ceni je i sečenje armature.  Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'У цени је и сечење арматуре.  Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '24',
              'unit_id' => '3',
              'title' => [
                'sr' => 'Demontaža prozora.',
                'rs-cyrl' => 'Демонтажа прозора.',
              ],
              'description' => [
                'sr' => 'Prozori se demontiraju zajedno sa štokovima. Demontirani prozori se deponuju na gradilišnoj deponiji.',
                'rs-cyrl' => 'Прозори се демонтирају заједно са штоковима. Демонтирани прозори се депонују на градилишној депонији.',
              ],
            ],
            [
              'subcategory_id' => '24',
              'unit_id' => '3',
              'title' => [
                'sr' => 'Demontaža vrata.',
                'rs-cyrl' => 'Демонтажа врата.',
              ],
              'description' => [
                'sr' => 'Vrata se demontiraju zajedno sa štokovima. Demontirana vrata se deponuju na gradilišnoj deponiji.',
                'rs-cyrl' => 'Врата се демонтирају заједно са штоковима. Демонтирана врата се депонују на градилишној депонији.',
              ],
            ],
            [
              'subcategory_id' => '24',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža ugrađenih plakara.',
                'rs-cyrl' => 'Демонтажа уграђених плакара.',
              ],
              'description' => [
                'sr' => 'Demontirani plakari se deponuju na gradilišnoj deponiji.',
                'rs-cyrl' => 'Демонтирани плакари се депонују на градилишној депонији.',
              ],
            ],
            [
              'subcategory_id' => '24',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža brodskog poda zajedno sa svim slojevima podkonstrukcije i lajsnama.',
                'rs-cyrl' => 'Демонтажа бродског пода заједно са свим слојевима подконструкције и лајснама.',
              ],
              'description' => [
                'sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '24',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža poda od parketa zajedno sa lajsnama.',
                'rs-cyrl' => 'Демонтажа пода од паркета заједно са лајснама.',
              ],
              'description' => [
                'sr' => 'Demontirani parket se slaže i povezuje. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Демонтирани паркет се слаже и повезује. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
            [
              'subcategory_id' => '24',
              'unit_id' => '1',
              'title' => [
                'sr' => 'Demontaža poda od itisona zajedno sa lajsnama.',
                'rs-cyrl' => 'Демонтажа пода од итисона заједно са лајснама.',
              ],
              'description' => [
                'sr' => 'Demontirani itison se slaže i pakuje. Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                'rs-cyrl' => 'Демонтирани итисон се слаже и пакује. Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
              ],
            ],
        ];

        collect($units)->each(function ($units) {
            Units::create($units); });
        collect($services)->each(function ($services) {
            Ponuda_Service::create($services); });
        collect($categories)->each(function ($category) {
            Default_category::create($category); });
        collect($subcategories)->each(function ($subcategory) {
            Default_subcategory::create($subcategory); });
        collect($pozicija)->each(function ($poz) {
            Default_pozicija::create($poz); });

        //required: subcategory_id, unit_id, t_sr, d_sr
        $dataset = [
            [
                'subcategory_id' => 24,
                'unit_id' => 1,
                't_sr' => 'Demontaža poda od PVC podnih obloga zajedno sa lajsnama.',
                'd_sr' => 'Šut se iznosi van objekta, tovari u kamion i odvozii na gradsku deponiju udaljenu do 10km.',
                't_sr_c' => 'Демонтажа пода од ПВЦ подних облога заједно са лајснама.',
                'd_sr_c' => 'Шут се износи ван објекта, товари у камион и одвозии на градску депонију удаљену до 10км.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje maltera sa unutrašnjih zidova.',
                'd_sr' => 'Malter sa zidova se obija ručno ili mašinski. Fuge se čiste do dubine od 2cm, a površina opeke čisti čeličnim četkama. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
                't_sr_c' => 'Обијање малтера са унутрашњих зидова.',
                'd_sr_c' => 'Малтер са зидова се обија ручно или машински. Фуге се чисте до дубине од 2цм, а површина опеке чисти челичним четкама. Шут се износи из објекта и одвози на градску депонију удаљену до 10км.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje maltera sa plafona.',
                'd_sr' => 'Malter sa plafona se obija ručno ili mašinski. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
                't_sr_c' => 'Обијање малтера са плафона.',
                'd_sr_c' => 'Малтер са плафона се обија ручно или машински. Шут се износи из објекта и одвози на градску депонију удаљену до 10км.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje zidnih keramičkih pločica.',
                'd_sr' => 'Pločice se sa zidova obijaju ručno ili mašinski. Fuge se čiste do dubine od 2cm, a površina opeke čisti čeličnim četkama. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
                't_sr_c' => 'Обијање зидних керамичких плочица.',
                'd_sr_c' => 'Плочице се са зидова обијају ручно или машински. Фуге се чисте до дубине од 2цм, а површина опеке чисти челичним четкама. Шут се износи из објекта и одвози на градску депонију удаљену до 10км.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje podnih keramičkih pločica.',
                'd_sr' => 'Pločice se sa podova obijaju ručno ili mašinski. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km.',
                't_sr_c' => 'Обијање подних керамичких плочица.',
                'd_sr_c' => 'Плочице се са подова обијају ручно или машински. Шут се износи из објекта и одвози на градску депонију удаљену до 10км.',
            ],
            [
                'subcategory_id' => 25,
                'unit_id' => 1,
                't_sr' => 'Obijanje maltera sa fasadnih zidova.',
                'd_sr' => 'Malter sa zidova se obija ručno ili mašinski. Fuge se čiste do dubine od 2cm, a površina opeke čisti čeličnim četkama. Šut se iznosi iz objekta i odvozi na gradsku deponiju udaljenu do 10km. U ceni je i trošak montaže i demontaže potrebne fasadne skele.',
                't_sr_c' => 'Обијање малтера са фасадних зидова.',
                'd_sr_c' => 'Малтер са зидова се обија ручно или машински. Фуге се чисте до дубине од 2цм, а површина опеке чисти челичним четкама. Шут се износи из објекта и одвози на градску депонију удаљену до 10км. У цени је и трошак монтаже и демонтаже потребне фасадне скеле.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 2,
                't_sr' => 'Zidanje nosećih zidova, d=25 cm i više, punom opekom u produžnom malteru.',
                'd_sr' => 'Opeka se pre ugradnje kvasi vodom. Fuge se čiste do dubine od 2 cm. U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Зидање носећих зидова, д=25 цм и више, пуном опеком у продужном малтеру.',
                'd_sr_c' => 'Опека се пре уградње кваси водом. Фуге се чисте до дубине од 2 цм. У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 2,
                't_sr' => 'Zidanje zidova, šupljim blokovima d=25 cm i više, u produžnom malteru.',
                'd_sr' => 'Blokovi se pre ugradnje kvase vodom. Fuge se čiste do dubine od 2 cm. U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Зидање зидова, шупљим блоковима д=25 цм и више, у продужном малтеру.',
                'd_sr_c' => 'Блокови се пре уградње квасе водом. Фуге се чисте до дубине од 2 цм. У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 2,
                't_sr' => 'Zidanje zidova termo izolacionim (YTONG) blokovima, odgovarajućim lepkom.',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Зидање зидова термо изолационим (YTONG) блоковима, одговарајућим лепком.',
                'd_sr_c' => 'У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 1,
                't_sr' => 'Zidanje pregradnih zidova debljine 6,5 cm, punom opekom u produžnom malteru.',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Зидање преградних зидова дебљине 6,5 цм, пуном опеком у продужном малтеру.',
                'd_sr_c' => 'У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 1,
                't_sr' => 'Zidanje pregradnih zidova debljine 12 cm, punom opekom u produžnom malteru.',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Зидање преградних зидова дебљине 12 цм, пуном опеком у продужном малтеру.',
                'd_sr_c' => 'У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 26,
                'unit_id' => 1,
                't_sr' => 'Zidanje pregradnih zidova, šupljim blokovima d=8 cm i više, u produžnom malteru.',
                'd_sr' => 'U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Зидање преградних зидова, шупљим блоковима д=8 цм и више, у продужном малтеру.',
                'd_sr_c' => 'У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada perdašene cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Gornja površina košuljice se perdaši i neguje do očvršćavanja.',
                't_sr_c' => 'Израда пердашене цементне кошуљице.',
                'd_sr_c' => 'Пре израде кошуљице подлога се чисти. Горња површина кошуљице се пердаши и негује до очвршћавања.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada gletovane cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Gornja površina košuljice se gletuje do crnog sjaja i neguje do očvršćavanja.',
                't_sr_c' => 'Израда глетоване цементне кошуљице.',
                'd_sr_c' => 'Пре израде кошуљице подлога се чисти. Горња површина кошуљице се глетује до црног сјаја и негује до очвршћавања.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada rabicirane i perdašene cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira rabic pletivom, postavljenim u sredini sloja. Gornja površina košuljice se perdaši i neguje do očvršćavanja.',
                't_sr_c' => 'Израда рабициране и пердашене цементне кошуљице.',
                'd_sr_c' => 'Пре израде кошуљице подлога се чисти. Кошуљица се армира рабиц плетивом, постављеним у средини слоја. Горња површина кошуљице се пердаши и негује до очвршћавања.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada rabicirane i gletovane cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira rabic pletivom, postavljenim u sredini sloja. Gornja površina košuljice se gletuje do crnog sjaja i neguje do očvršćavanja.',
                't_sr_c' => 'Израда рабициране и глетоване цементне кошуљице.',
                'd_sr_c' => 'Пре израде кошуљице подлога се чисти. Кошуљица се армира рабиц плетивом, постављеним у средини слоја. Горња површина кошуљице се глетује до црног сјаја и негује до очвршћавања.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada armirane i perdašene cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira mrežom Ø 6 mm, sa okcima 15/15 cm, postavljenim u sredini sloja. Gornja površina košuljice se perdaši i neguje do očvršćavanja.',
                't_sr_c' => 'Израда армиране и пердашене цементне кошуљице.',
                'd_sr_c' => 'Пре израде кошуљице подлога се чисти. Кошуљица се армира мрежом Ø 6 мм, са окцима 15/15 цм, постављеним у средини слоја. Горња површина кошуљице се пердаши и негује до очвршћавања.',
            ],
            [
                'subcategory_id' => 27,
                'unit_id' => 1,
                't_sr' => 'Izrada armirane i gletovane cementne košuljice.',
                'd_sr' => 'Pre izrade košuljice podloga se čisti. Košuljica se armira mrežom Ø 6 mm, sa okcima 15/15 cm, postavljenim u sredini sloja. Gornja površina košuljice se gletuje do crnog sjaja i neguje do očvršćavanja.',
                't_sr_c' => 'Израда армиране и глетоване цементне кошуљице.',
                'd_sr_c' => 'Пре израде кошуљице подлога се чисти. Кошуљица се армира мрежом Ø 6 мм, са окцима 15/15 цм, постављеним у средини слоја. Горња површина кошуљице се глетује до црног сјаја и негује до очвршћавања.',
            ],
            [
                'subcategory_id' => 28,
                'unit_id' => 1,
                't_sr' => 'Malterisanje krečnim malterom u dva sloja sa perdašenjem.',
                'd_sr' => 'Pre malterisanja površine se čiste  i prskaju razređenim malterom. Po završetku malterisanja, malter se kvasi da ne dođe do prebrzog sušenja. U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Малтерисање кречним малтером у два слоја са пердашењем.',
                'd_sr_c' => 'Пре малтерисања површине се чисте  и прскају разређеним малтером. По завршетку малтерисања, малтер се кваси да не дође до пребрзог сушења. У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 28,
                'unit_id' => 1,
                't_sr' => 'Malterisanje produžnim malterom u dva sloja sa perdašenjem.',
                'd_sr' => 'Pre malterisanja površine se čiste  i prskaju razređenim malterom. Po završetku malterisanja, malter se kvasi da ne dođe do prebrzog sušenja. U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Малтерисање продужним малтером у два слоја са пердашењем.',
                'd_sr_c' => 'Пре малтерисања површине се чисте  и прскају разређеним малтером. По завршетку малтерисања, малтер се кваси да не дође до пребрзог сушења. У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 28,
                'unit_id' => 1,
                't_sr' => 'Malterisanje cementnim malterom u dva sloja sa perdašenjem.',
                'd_sr' => 'Pre malterisanja površine se čiste  i prskaju razređenim malterom. Po završetku malterisanja, malter se kvasi da ne dođe do prebrzog sušenja. U cenu ulazi i pomoćna skela.',
                't_sr_c' => 'Малтерисање цементним малтером у два слоја са пердашењем.',
                'd_sr_c' => 'Пре малтерисања површине се чисте  и прскају разређеним малтером. По завршетку малтерисања, малтер се кваси да не дође до пребрзог сушења. У цену улази и помоћна скела.',
            ],
            [
                'subcategory_id' => 29,
                'unit_id' => 3,
                't_sr' => 'Ugradnja drvenih vrata.',
                'd_sr' => 'Vrata se ugrađuju uz pomoć drvenih kajli. Prostor između kventa i štoka se popunjava Pur-penom.',
                't_sr_c' => 'Уградња дрвених врата.',
                'd_sr_c' => 'Врата се уграђују уз помоћ дрвених кајли. Простор између квента и штока се попуњава Пур-пеном.',
            ],
            [
                'subcategory_id' => 29,
                'unit_id' => 3,
                't_sr' => 'Ugradnja drvenih prozora.',
                'd_sr' => 'Prozori se ugrađuju uz pomoć drvenih kajli. Prostor između kventa i štoka se popunjava Pur-penom.',
                't_sr_c' => 'Уградња дрвених прозора.',
                'd_sr_c' => 'Прозори се уграђују уз помоћ дрвених кајли. Простор између квента и штока се попуњава Пур-пеном.',
            ],
            [
              'subcategory_id' => 14,
              'unit_id' => 1,
              't_sr' => 'Demontaža stare podne obloge od laminatna',
              'd_sr' => 'Stari laminat  i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km',
              't_sr_c' => 'Демонтажа старе подне облоге од ламинатна',
              'd_sr_c' => 'Стари ламинат  и лајсне се пажљиво демонтирају и депонују у оквиру градилишта на место које које одреди инвеститор. Шут и остали отпадни материјал се товари у превозно средство и одвози на градску депонију на удаљености до 10км',
            ],
            [
                'subcategory_id' => 14,
                'unit_id' => 1,
                't_sr' => 'Demontaža stare podne obloge od lamel parketa',
                'd_sr' => 'Stari lamel parket  i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km',
                't_sr_c' => 'Демонтажа старе подне облоге од ламел паркета',
                'd_sr_c' => 'Стари ламел паркет  и лајсне се пажљиво демонтирају и депонују у оквиру градилишта на место које које одреди инвеститор. Шут и остали отпадни материјал се товари у превозно средство и одвози на градску депонију на удаљености до 10км',
            ],
            [
              'subcategory_id' => 15,
              'unit_id' => 1,
              't_sr' => 'Postavljanje Stirodura ispod podne obloge',
              'd_sr' => 'Na betonski pod ili pod od cementne košuljice prvo postavlja parna brana, preko koje se postavlja Stirodur u debljini od 2cm. Table stirodura se spajaju i ukrajaju pored zidova.',
              't_sr_c' => 'Постављање Стиродура испод подне облоге',
              'd_sr_c' => 'На бетонски под или под од цементне кошуљице прво поставља парна брана, преко које се поставља Стиродур у дебљини од 2цм. Табле стиродура се спајају и украјају поред зидова.',
            ],
            [
              'subcategory_id' => 16,
              'unit_id' => 1,
              't_sr' => 'Postavljanje podne obloge od laminata',
              'd_sr' => 'Laminat se postavlja preko pripremljene i čiste podloge. Spajanje ploča se vrši na odgovarajući način, u zavisnosti od tipa laminata. Po obimu poda se postavljaju odgovarajuće lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
              't_sr_c' => 'Постављање подне облоге од ламината',
              'd_sr_c' => 'Ламинат се поставља преко припремљене и чисте подлоге. Спајање плоча се врши на одговарајући начин, у зависности од типа ламината. По обиму пода се постављају одговарајуће лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
            ],
            [
              'subcategory_id' => 16,
              'unit_id' => 1,
              't_sr' => 'Postavljanje podne obloge od lamel parketa',
              'd_sr' => 'Laminat se postavlja preko pripremljene i čiste podloge. Spajanje ploča se vrši na odgovarajući način, u skladu sa uputstvom proizvođača. Po obimu poda se postavljaju odgovarajuće lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.',
              't_sr_c' => 'Постављање подне облоге од ламел паркета',
              'd_sr_c' => 'Ламинат се поставља преко припремљене и чисте подлоге. Спајање плоча се врши на одговарајући начин, у складу са упутством произвођача. По обиму пода се постављају одговарајуће лајсне. Спојеви лајсни у негативним и позитивним угловима се герују.',
            ],
            // [
            //   'subcategory_id' => 14,
            //   'unit_id' => 1,
            //   't_sr' => '',
            //   'd_sr' => '',
            //   't_sr_c' => '',
            //   'd_sr_c' => '',
            // ],
        ];

        function poz($data)
        {
            if (empty($data['d_sr']))
                $data['d_sr'] = '';
            if (empty($data['d_sr_c']))
                $data['d_sr_c'] = '';
            $pozicija = Default_pozicija::create(
                [
                    'subcategory_id' => $data['subcategory_id'],
                    'unit_id' => $data['unit_id'],
                    'title' => [
                      'sr' => $data['t_sr'], 
                      'rs-cyrl' => $data['t_sr_c']
                    ],
                    'description' => [
                      'sr' => $data['d_sr'],
                      'rs-cyrl' => $data['d_sr_c']
                    ],
                ]
            );

            // if (isset($data['t_en'])) {
            //     $pozicija->setTranslations('title', ['en' => $data['t_en']]);
            // }

            // if (isset($data['t_hu'])) {
            //     $pozicija->setTranslations('title', ['hu' => $data['t_hu']]);
            // }

            // if (isset($data['d_en'])) {
            //     $pozicija->setTranslations('description', ['en' => $data['d_en']]);
            // }

            // if (isset($data['d_hu'])) {
            //     $pozicija->setTranslations('description', ['hu' => $data['d_hu']]);
            // }

            $pozicija->save();
        }

        foreach ($dataset as $data) {
            poz($data);
        }
    }
}