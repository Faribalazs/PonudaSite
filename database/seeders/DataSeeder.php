<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class DataSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            array( 
                [
                    'name' => 'Molersko farbarski radovi'
                ],
                [
                    'name' => 'Suvomontažni radovi'
                ],
                [
                    'name' => 'Keramičarski radovi'
                ],
                [
                    'name' => 'Parketarski radovi'
                ],
                [
                    'name' => 'Podopolagački radovi'
                ],
            )
        );

        DB::table('subcategories')->insert(
            array(
                [
                    'category_id' => '1',
                    'name' => 'Pripremni i završni radovi'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Unutrašnji zidovi i plafoni'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Vrata i prozori'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Fasada'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Dekorativne tehnike'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Ukrasne tapete, bordure i aplikacije'
                ],
                [
                    'category_id' => '2',
                    'name' => 'Pregradni zidovi'
                ],
                [
                    'category_id' => '2',
                    'name' => 'Spusteni plafoni'
                ],
                [
                    'category_id' => '2',
                    'name' => 'Suvo malterisanje'
                ],
                [
                    'category_id' => '2',
                    'name' => 'Oblaganje instalacija'
                ],
                [
                    'category_id' => '3',
                    'name' => 'Pripremni i završni radovi'
                ],
                [
                    'category_id' => '3',
                    'name' => 'Zidovi'
                ],
                [
                    'category_id' => '3',
                    'name' => 'Podovi'
                ],
                [
                    'category_id' => '4',
                    'name' => 'Demontaža'
                ],
                [
                    'category_id' => '4',
                    'name' => 'Priprema podloge'
                ],
                [
                    'category_id' => '4',
                    'name' => 'Podovi'
                ],
                [
                    'category_id' => '5',
                    'name' => 'Demontaža'
                ],
                [
                    'category_id' => '5',
                    'name' => 'Priprema podloge'
                ],
                [
                    'category_id' => '5',
                    'name' => 'Podovi'
                ],
            )
        );

        DB::table('units')->insert(
            array(
                [
                    'name' => 'm²',
                ],
                [
                    'name' => 'm³',
                ],
                [
                    'name' => 'kom',
                ],
                [
                    'name' => 'm¹',
                ]
            )
        );

        DB::table('services')->insert(
            array(
                [
                    'name_service' => 'Cena pozicije sadrži vrednost materiala i usluge.',
                ],
                [
                    'name_service' => 'Cena pozicije sadrži vrednost uslugu (bez materiala).',
                ]
            )
        );

        DB::table('pozicija')->insert(
            array(
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Pomeranje postojećeg nameštaja iz prostora koji se adaptira.',
                    'description' => 'Nameštaj se po završenim radovima vraća na prvobitno mesto.'
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Iznošenje postojećeg nameštaja iz prostora koji se adaptira.',
                    'description' => 'Nameštaj se deponuje u okviru objekta.'
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Nabavka i postavljanje polietilenske folije preko otvora, vrata i prozora, radi zaštite.',
                    'description' => 'Folija se učvršćuje, vodeći računa da se ne ošteti postojeća stolarija.'
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Nabavka i postavljanje polietilenske folije preko nameštaja, radi zaštite.',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Nabavka i postavljanje deblje polietilenske folije za zaštitu podova.',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Montaža i demontaža pomoćne skele u objektu, za rad u prostorijama.',
                    'description' => 'Skela se izrađuje po svim propisima.'
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Čišćenje i pranje prozora i vrata po završetku radova.',
                    'description' => 'Pranje se obavlja vodom sa dodatkom odgovarajućih hemijskih sredstava.'
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Prikupljanje šuta i drugog otpadnog materijala sa objekta, utovar u kamion i odvoz na gradsku deponiju.',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '1',
                    'unit_id' => '1',
                    'title' => 'Detaljno čišćenje celog gradilišta, pranje svih staklenih površina, čišćenje i fino pranje svih unutrašnjih prostora i spoljnih površina.',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Gletovanje malterisanih zidova i plafona, disperzivnom glet masom.',
                    'description' => 'Površine se čiste i bruse pre gletovanja.  Manja oštećenja i pukotine se kituju. Gletovanje se vrši do potpune ravnosti, nakon čega se vrši fino brušenje cele površine.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Gletovanje starih ostruganih zidova i plafona, disperzivnom glet masom.',
                    'description' => 'Površine se čiste i bruse pre gletovanja.  Manja oštećenja i pukotine se kituju. Gletovanje se vrši do potpune ravnosti, nakon čega se vrši fino brušenje cele površine.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Struganje i gletovanje starih zidova i plafona, disperzivnom glet masom.',
                    'description' => 'Površine se stružu, peru, bruse, čiste i impregniraju. Pregledati i kitovati manja oštećenja i pukotine. Manja oštećenja i pukotine se kituju. Gletovanje se vrši do potpune ravnosti, nakon čega se vrši fino brušenje cele površine.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Struganje uljane boje sa zidova.',
                    'description' => 'Sve površine se stružu i peru.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Skidanje postojeće uljane boje sa zidova, paljenjem.',
                    'description' => 'Površine obojene uljanom bojom se pomoću plina i brenera zagrevaju i špahtlama i drugim prigodnim alatkama se vrši uklanjanje boje. Postupak se ponavlja dok se boja ne skine.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Bojenje gletovanih zidova i plafona, bojama za unutrašnju upotrebu.',
                    'description' => 'Sve površine se bruse i čiste. Oštećenja se kituju toniranim disperzivnim kitom. Površine se zatim finalno boje u dva sloja, odnosno do potpunog pokrivanja.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Bojenje malterisanih zidova i plafona, bez gletovanja.',
                    'description' => 'Sve površine se bruse i impregniraju. Oštećenja se kituju toniranim disperzivnim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Bojenje sa gletovanjem zidova.',
                    'description' => 'Malterisani zidovi i plafoni se  gletuju disperzivnom glet masom u dva sloja. Površine se bruse i čiste. Manja oštećenja i pukotine se kituju. Gletovanje se vrši do potpune ravnosti, nakon čega se vrši fino brušenje cele površine. Sitne nepravilnosti se ispravljaju toniranim disperzionim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Bojenje gips kartonskih zidova i plafona.',
                    'description' => 'Fuge se bandažiraju i gletuju u dva sloja u širini koja obezbeđuje potpunu ravnost površine, nakon čega se vrši fino brušenje. Sitne nepravilnosti se ispravljaju toniranim disperzionim kitom. Kompletna površina se zatim boji odgovarajućom bojom u dva sloja u traženoj boji i tonu, odnosno do potpunog pokrivanja.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Krečenje zidova i plafona četkom ili pumpom, rastvorenim odležalim gašenim krečom.',
                    'description' => 'Sve površine okrečiti četkom ili pumpom prvi put, brusiti i gipsovati manja oštećenja i pukotine, a zatim okrečiti drugi put.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Bojenje zidova uljanom bojom, sa lakiranjem.',
                    'description' => 'Vrši se osnovno bojenje zida, gletovanje i natapanje firnisom. Zatim se vrši kitovanje, brušenje, bojenje uljanom bojom u dva sloja, finalno brušenje i lakiranje u izabranoj boji i tonu.'
                ],
                [
                    'subcategory_id' => '2',
                    'unit_id' => '1',
                    'title' => 'Obrada zidova plastičnim malterom (Bavalit) sa zaribavanjem.',
                    'description' => 'Podloga se čisti i impregnira izolacionom masom, radi bolje veze. Na osušenu podlogu se nanosi malter, napravljen i dobro izmešan da se dobije jednolična i konzistentna masa. Pripremljen materijal se nanosi glet hoblom u debljini sloja do maksimalne veličine zrna. Struktura maltera se postiže kružnim zaribavanjem gumenom glet hoblom ili vertikalnim ili horizontalnim zaribavanjem Stiroporom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Skidanje boje sa vrata i prozora hemijskim putem.',
                    'description' => 'Postojeći slojevi boje se skidaju nanošenjem hemijskog rastvarača i fizičkim skidanjem slojeva boje špahtlama i odgovarajućim alatkama. Postupak se ponavlja dok se ne skinu svi slojevi boje i ne dođe do zdravog i čistog drveta. Po izvršenom skidanju boje drvo se prebrusi finom šmirglom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Skidanje boje sa vrata i prozora upotrebom specijalnog fena za skidanje boje.',
                    'description' => 'Postojeći slojevi boje se skidaju grejanjem fenom i upotrebom špahtli i odgovarajućih alatki. Postupak se ponavlja dok se ne skinu svi slojevi boje i ne dođe do zdravog i čistog drveta. Po izvršenom skidanju boje drvo se  prebrusi finom šmirglom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje starih prozora i vrata, sa kojih je skinuta stara boja.',
                    'description' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje starih prozora i vrata preko postojeće boje.',
                    'description' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje novih prozora i vrata.',
                    'description' => 'Prilikom bojenja izvode se sve faze koje su predviđene normativima za ovu vrstu radova, zajedno sa finalnim lakiranjem emajl lakom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje starih prozora i vrata lazurnim bojama, sa lakiranjem.',
                    'description' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, površine se prelaze najfinijom šmirglom, pa boje treći put i lakiraju lakom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje novih prozora i vrata lazurnim bojama, sa lakiranjem.',
                    'description' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, površine se prelaze najfinijom šmirglom, pa boje treći put i lakiraju lakom.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje osnovnom bojom metalnih prozora, sa prethodnim čišćenjem.',
                    'description' => 'Metalni prozori se pre bojenja čiste od korozije i prašine hemijskim i fizičkim sredstvima.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje osnovnom bojom metalne kapije, sa prethodnim čišćenjem.',
                    'description' => 'Metalna kapija se pre bojenja čisti od korozije i prašine hemijskim i fizičkim sredstvima.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje novih metalnih prozora, bojom za metal.',
                    'description' => 'Pre bojenja sa metala se uklanja korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje starih metalnih prozora, bojom za metal.',
                    'description' => 'Sa prethodnim skidanjem stare boje. Pre bojenja sa metala se uklanja stara boja i korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje novih metalnih rešetki prozora, bojom za metal.',
                    'description' => 'Pre bojenja sa metala se uklanja korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ],
                [
                    'subcategory_id' => '3',
                    'unit_id' => '1',
                    'title' => 'Bojenje starih metalnih rešetki prozora, bojom za metal.',
                    'description' => 'Pre bojenja sa metala se uklanja stara boja i korozija hemijskim i fizičkim sredstvima, a zatim sve izvode sve faze u skladu sa normativima za ovu vrstu radova.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Čišćenje slojeva stare boje sa ravnih površina fasade.',
                    'description' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga. Postupak se ponavlja do potpunog uklanjanja stare boje.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Čišćenje slojeva stare boje sa ravnih površina fasade i vučenih profila.',
                    'description' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga i vučeni profili. Postupak se ponavlja do potpunog uklanjanja stare boje.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Čišćenje slojeva stare boje sa fasade sa ornamentima i vučenim profilima.',
                    'description' => 'Stari slojevi boje se čiste mehaničkim i hemijskim putem. Prilikom čišćenja se vodi računa da se ne ošteti podloga, ornamentalna plastika i vučeni profili. Postupak se ponavlja do potpunog uklanjanja stare boje.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Gletovanje fasade glet masom.',
                    'description' => 'Sve površine fasade se čiste od naslaga i impregniraju. Fasada se gletuje glet masom za spoljno gletovanje. Sve površine se bruse i čiste.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Gletovanje fasade glet masom, sa sanacijom pukotina.',
                    'description' => 'Sve površine fasade se čiste od naslaga i impregniraju. Sanacija pukotina se vrši njihovim otvaranjem, kitovanjem i lepljenjem staklene mreže preko saniranih pukotina. Fasada se gletuje glet masom za spoljno gletovanje. Sve površine se bruse i čiste.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Bojenje malterisane fasade disperzionom bojom.',
                    'description' => 'Pre bojenja fasadne površine se prelaze šmirglom i pajaju, a zatim grundiraju.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Bojenje sa gletovanjem malterisane fasade disperzionom bojom.',
                    'description' => 'Fasadne površine se prelaze šmirglom i pajaju, a zatim gletuju glet masom za spoljnu upotrebu. Pre bojenja fasadne površine se bruse i pajaju, a zatim impregniraju.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Zaštita bojenih fasadnih površina od uticaja vlage i atmosferilija silikonskim premazom.',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Zaštita fasadnih zidova od fasadne opeke od uticaja vlage i atmosferilija silikonskim premazom.',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Postavljanje termoizolacionih ploča, Stiropor, odgovarajuće debljine i gustine.',
                    'description' => 'Stiropor ploče se postavljaju preko građevinskog lepka i ankerišu specijalnim tiplovima. Preko ploča se nanosi sloj građevinskog lepka, u koji se po celoj površini utiskuje odgovarajuća mrežica. Zatim se nanosi završni sloj građevinskog lepka.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Postavljanje termoizolacionih ploča, Stirodur, odgovarajuće debljine i gustine.',
                    'description' => 'Stirdur ploče se postavljaju preko građevinskog lepka i ankerišu specijalnim tiplovima. Preko ploča se nanosi sloj građevinskog lepka, u koji se po celoj površini utiskuje odgovarajuća mrežica. Zatim se nanosi završni sloj građevinskog lepka.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Postavljanje kamene vune u obliku mekih ploča, odgovarajuće debljine.',
                    'description' => 'Kamena vuna se postavlja kao termo i zvučna izolacija i protivpožarna zaštita fasadnih zidova, po detaljima i uputstvu projektanta.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Postavljanje kamene vune u obliku polutvrdih ploča, odgovarajuće debljine.',
                    'description' => 'Kamena vuna se postavlja kao termo i zvučna izolacija i protivpožarna zaštita fasadnih zidova, po detaljima i uputstvu projektanta.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Obrada fasade plastičnim malterom (Bavalit) sa zaribavanjem.',
                    'description' => 'Podloga se očistiti i impregnira radi bolje veze. Pripremljen materijal se nanosi  glet hoblom u debljini sloja do maksimalne veličine zrna. Struktura maltera se postiže kružnim zaribavanjem gumenom glet hoblom ili vertikalnim ili horizontalnim zaribavanjem Stiroporom.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Bojenje oluka i olučnih vertikala, bojom za metal.',
                    'description' => 'Pre bojenja lim se odmašćuje i pere organskim rastvaračima. Na lim se nanosi antikorozivni premaz. Posle sušenja oluci olučne vertikale se boje bojom za metal.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Bojenje metalne ograde, bojom za metal.',
                    'description' => 'Pre bojenja skida se korozija hemijskim i fizičkim sredstvima, brusi i očisti. Na ogradu se nanosi impregnacija i osnovna boja, a zatim se boji dva puta bojom za metal.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Skidanje stare boje i bojenje metalne ograde, bojom za metal.',
                    'description' => 'Pre bojenja skida se stara boja i korozija hemijskim i fizičkim sredstvima, brusi i očisti. Na ogradu se nanosi impregnacija i osnovna boja, a zatim se boji dva puta bojom za metal.'
                ],
                [
                    'subcategory_id' => '4',
                    'unit_id' => '1',
                    'title' => 'Bojenje drvene ograde lazurnim bojama.',
                    'description' => 'Pre bojenja sve površine se prelaze finom šmirglom. Bojenje se vrši dva puta sa razmakom za sušenje od 24 h, nakon čega se prelazi najfinijom šmirglom i boji po treći put.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike TRAVERTINO',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike OTTOCENTO',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike SAHARA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike SWAHILI',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike ARTECO',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike AFRICA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike SABULA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike ARABESQUE',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike HOBLIO',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike TUSCANIA ANTICA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike PERLESCENTE',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike VINTAGE',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike SPACCANTE',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike KLONDIKE',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike POLISTOF',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike ETNIKA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '5',
                    'unit_id' => '1',
                    'title' => 'Izrada dekorativne tehnike SPATULATO',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno nanošenje dekorativnog materijala u traženom tonu.'
                ],
                [
                    'subcategory_id' => '6',
                    'unit_id' => '1',
                    'title' => 'Dekoracija zida UKRASNIM TAPETAMA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih tapeta.'
                ],
                [
                    'subcategory_id' => '6',
                    'unit_id' => '4',
                    'title' => 'Dekoracija zida UKRASNIM BORDURAMA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih bordura.'
                ],
                [
                    'subcategory_id' => '6',
                    'unit_id' => '3',
                    'title' => 'Dekoracija zida UKRASNIM APLIKACIJAMA',
                    'description' => 'Cena sadrži kompletnu pripremu podloge u zavisnosti od njenog trenutnog stanja i potrebnih faza rada, kao i finalno lepljenje odabranih ukrasnih aplikacija.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Demontaža i rušenje postojećih pregradnih gipskarton zidova',
                    'description' => 'Postojeći zidovi se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 80 mm - GKB15mm+CW50+GKB15mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 15mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 100 mm - GKB12,5mm+CW75+GKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 125 mm - GKB12,5mm+CW100+GKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog  pregradnog zida ukupne debljine 80 mm - GKF15mm+CW50+GKF15mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50),  koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 100 mm - GKF12,5mm+CW75+GKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - GKF12,5mm+CW100+GKF12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 100 mm - 2xGKB12,5mm+CW50+2xGKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 125 mm - 2xGKB12,5mm+CW75+2xGKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 150 mm - 2xGKB12,5mm+CW100+2xGKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 100 mm - 2xGKF12,5mm+CW50+2xGKF12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - 2xGKF12,5mm+CW75+2xGKF12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 150 mm - 2xGKF12,5mm+CW100+2xGKF12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 125 mm - 3xGKB12,5mm+CW50+3xGKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 150 mm - 3xGKB12,5mm+CW75+3xGKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 175 mm - 3xGKB12,5mm+CW100+3xGKB12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 125 mm - 3xGKF12,5mm+CW50+3xGKF12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 50mm (CW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 150 mm - 3xGKF12,5mm+CW75+3xGKF12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 75mm (CW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 60mm (100kg/m3). Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 175 mm - 3xGKF12,5mm+CW100+3xGKF12,5mm',
                    'description' => 'Zid se sastoji od jednostruke metalne podkonstrukcije širine 100mm (CW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 60mm (100kg/m3). Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 155 mm - 2xGKB12,5mm+2xCW50+2xGKB12,5mm',
                    'description' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 100mm (2xCW50), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 205 mm - 2xGKB12,5mm+2xCW75+2xGKB12,5mm',
                    'description' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 150mm (2xCW75), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada pregradnog zida ukupne debljine 255 mm - 2xGKB12,5mm+2xCW100+2xGKB12,5mm',
                    'description' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 200mm (2xCW100), koja se obostrano oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 155 mm - 2xGKF12,5mm+2xCW50+2xGKF12,5mm',
                    'description' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 100mm (2xCW50), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 205 mm - 2xGKF12,5mm+2xCW75+2xGKF12,5mm',
                    'description' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 150mm (2xCW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 255 mm - 2xGKF12,5mm+2xCW100+2xGKF12,5mm',
                    'description' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 200mm (2xCW100), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 50mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '7',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog pregradnog zida ukupne debljine 215 mm - 2xGKF12,5mm+CW75+1xGKF12,5mm+CW75+2xGKF12,5mm - sa dodatom 5. pločom',
                    'description' => 'Zid se sastoji od dvostruke metalne podkonstrukcije širine 2x75mm (2xCW75), koja se obostrano oblaže protivpožarnim  gipskarton pločama u dva sloja (GKF). Između CW profila se postavlja jednostruka protivpožarna gipskarton ploča (GKF). Debljina svih ploča iznosi 12,5mm. Unutrašnjost zida se popunjava kamenom vunom debljine 2x75mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Demontaža i rušenje postojećih monolitnih plafona',
                    'description' => 'Postojeći monolitni plafoni se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Demontaža i rušenje postojećih kasetiranih plafona',
                    'description' => 'Postojeći kasetirani plafoni se u potpunosti uklanjaju, uključujući i kompletnu podkonstrukciju. Demontirani materijal se iznosi van objekta i deponuje na unaped predviđeno mesto. Horizontalni i vertikalni transport šuta i smeća se organizuje u skladu sa uslovima gradilišta.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+1xGKB 12,5mm',
                    'description' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+2xGKB 12,5mm',
                    'description' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+3xGKB 12,5mm',
                    'description' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+1xGKB 15mm',
                    'description' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+2xGKB 15mm',
                    'description' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na jednostrukoj metalnoj podkonstrukciji CD+3xGKB 15mm',
                    'description' => 'Plafon se sastoji od jednostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+1xGKB 12,5mm',
                    'description' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u jednom sloju (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+2xGKB 12,5mm',
                    'description' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u dva sloja (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+3xGKB 12,5mm',
                    'description' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže običnim gipskarton pločama u tri sloja (GKB). Debljina ploča iznosi 12,5mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+1xGKB 15mm',
                    'description' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u jednom sloju (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+2xGKB 15mm',
                    'description' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u dva sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada protivpožarnog horizontalnog monolitnog spuštenog plafona na dvostrukoj metalnoj podkonstrukciji 2xCD+3xGKB 15mm',
                    'description' => 'Plafon se sastoji od dvostruke metalne podkonstrukcije CD, koja se oblaže protivpožarnim gipskarton pločama u tri sloja (GKF). Debljina ploča iznosi 15mm. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog kasetiranog spuštenog plafona „Armstrong“ na jednostrukoj metalnoj vidljivoj konstrukciji',
                    'description' => 'Plafon se sastoji od jednostruke metalne „T“ konstrukcije koje je sastavljena od glavnih i poprečnih T-profila. U konstrukciju se postavljaju demontažne minealne ploče dimenzija 600x600mm sa ravnom ivicom i vidljivim T-profilima. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '8',
                    'unit_id' => '1',
                    'title' => 'Izrada horizontalnog kasetiranog spuštenog plafona „Armstrong“ na jednostrukoj metalnoj nevidljivoj konstrukciji',
                    'description' => 'Plafon se sastoji od jednostruke metalne „T“ konstrukcije koje je sastavljena od glavnih i poprečnih T-profila. U konstrukciju se postavljaju demontažne minealne ploče dimenzija 600x600mm sa ravnom ivicom i nevidljivim T-profilima. Spuštanje do 50cm.'
                ],
                [
                    'subcategory_id' => '9',
                    'unit_id' => '1',
                    'title' => 'Suvo malterisanje ravnih zidova',
                    'description' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove uz pomoć lepka (Fugenfüller) nanetog kao tankoslojni malter. Pre lepljenja, na zidove se nanosi prajmer, kako bi se poboljšalo prijanjanje. Lepak se nanosi po svim ivicama ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '9',
                    'unit_id' => '1',
                    'title' => 'Suvo malterisanje zidova sa neravninama do 20mm',
                    'description' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove uz pomoć Perlfix lepka . Pre lepljenja, na zidove se nanosi prajme, kako bi se poboljšalo prijanjanje. Lepak se nanosi po ivicama i sredini ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '9',
                    'unit_id' => '1',
                    'title' => 'Suvo malterisanje zidova sa neravninama preko 20mm',
                    'description' => 'Lepljenje gipsanih ploča debljine 12,5mm (GKB) na postojeće zidove se vrši preko unapred zalepljenih traka od gipsanih ploča širine 100mm koje se lepe uz pomoć Perlfix lepka.  Ploče se za podlogu lepe uz pomoć lepka (Fugenfüller) nanetog kao tankoslojni malter.  Lepak se nanosi po ivicama i sredini ploče. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '9',
                    'unit_id' => '1',
                    'title' => 'Oblaganje zida na metalnoj podkonstrukciji - jednostruko oblaganje CW+GKB12,5mm',
                    'description' => 'Gipskarton ploče se u jednom sloju postavljeju preko pripremljene metalne podkonstrukcije od CW profila. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '9',
                    'unit_id' => '1',
                    'title' => 'Oblaganje zida na metalnoj podkonstrukciji - dvostruko oblaganje CW+2xGKB12,5mm',
                    'description' => 'Gipskarton ploče se u jednom sloju postavljeju preko pripremljene metalne podkonstrukcije od CW profila. Sastavi ploča se obrađuju masom za ispunu i bandaž trakom.'
                ],
                [
                    'subcategory_id' => '9',
                    'unit_id' => '1',
                    'title' => 'Ugradnja termoizolacije u sistem obložnog zida',
                    'description' => ' '
                ],
                [
                    'subcategory_id' => '10',
                    'unit_id' => '4',
                    'title' => 'Izrada obloge kablovskih regala - dvostrana',
                    'description' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
                [
                    'subcategory_id' => '10',
                    'unit_id' => '4',
                    'title' => 'Izrada obloge kablovskih regala - trostrana',
                    'description' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
                [
                    'subcategory_id' => '10',
                    'unit_id' => '4',
                    'title' => 'Izrada obloge kablovskih regala - četvorostrana',
                    'description' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
                [
                    'subcategory_id' => '10',
                    'unit_id' => '4',
                    'title' => 'Izrada obloge ventilacionih kanala - trostrana',
                    'description' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
                [
                    'subcategory_id' => '10',
                    'unit_id' => '4',
                    'title' => 'Izrada obloge ventilacionih kanala - četvorostrana',
                    'description' => 'Obloga se sastoji od sopstvene noseće metalne konstrukcije preko koje se po potrebi postavlja izolacija od kamene vune i montiraju odgovarajuće gipskarton ploče.'
                ],
                [
                    'subcategory_id' => '11',
                    'unit_id' => '1',
                    'title' => 'Obijanje pločica postavljenih u cementni malter sa zidova',
                    'description' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
                [
                    'subcategory_id' => '11',
                    'unit_id' => '1',
                    'title' => 'Obijanje pločica postavljenih u lepak sa zidova',
                    'description' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
                [
                    'subcategory_id' => '11',
                    'unit_id' => '1',
                    'title' => 'Obijanje pločica postavljenih u cementni malter sa podova',
                    'description' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
                [
                    'subcategory_id' => '11',
                    'unit_id' => '1',
                    'title' => 'Obijanje pločica postavljenih u lepak sa podova',
                    'description' => 'Pločice se obijaju ručno ili mašinski. Šut se iznosi iz objekta i deponuje na gradilišnu deponiju otpada.'
                ],
                [
                    'subcategory_id' => '11',
                    'unit_id' => '1',
                    'title' => 'Izravnavanje obijenih površina',
                    'description' => 'Obijene površine se izravnavaju upotrebom građevinskog lepka u cilju pripreme za postavljanje novih pločica.'
                ],
                [
                    'subcategory_id' => '11',
                    'unit_id' => '1',
                    'title' => 'Čišćenje gradilišta nakon završenih radova',
                    'description' => 'Sav otpadni materijal utovariti u kamion i odvesti na gradsku deponiju udaljenu do 10km.'
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '1',
                    'title' => 'Postavljanje zidnih keramičkih pločica u cementnom malteru',
                    'description' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '1',
                    'title' => 'Postavljanje zidnih keramičkih pločica u lepku',
                    'description' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '1',
                    'title' => 'Postavljanje zidnog keramičkog mozaika',
                    'description' => 'Mozaik se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljeni mozaik se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenog mozaika.'
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '4',
                    'title' => 'Postavljanje zidne keramičke bordure',
                    'description' => 'Bordura se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljena bordura se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljene bordure.'
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '4',
                    'title' => 'Postavljanje zidnih keramičkih listela',
                    'description' => 'Listela se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene listele se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih listela.'
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '1',
                    'title' => 'Postavljanje bazenskih zidnih keramičkih pločica',
                    'description' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '4',
                    'title' => 'Silikoniranje negativnih uglova na spojevima keramičkih pločica',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '4',
                    'title' => 'Postavljanje prefabrikovanih lajsni na pozitivne uglove spojeva keramičkih pločica',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '12',
                    'unit_id' => '4',
                    'title' => 'Postavljanje prefabrikovanih lajsni na gornju ivicu ugrađenih sokli od keramičkih pločica',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '1',
                    'title' => 'Postavljanje podnih keramičkih pločica u cementnom malteru',
                    'description' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '1',
                    'title' => 'Postavljanje podnih keramičkih pločica u lepku',
                    'description' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '4',
                    'title' => 'Postavljanje keramičke sokle visine do 15cm',
                    'description' => 'Sokla se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljena sokla  se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine sokle.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '1',
                    'title' => 'Postavljanje podnog keramičkog mozaika',
                    'description' => 'Mozaik se postavlja u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljeni mozaik se fuguje odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenog mozaika.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '1',
                    'title' => 'Postavljanje bazenskih podnih keramičkih pločica',
                    'description' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '1',
                    'title' => 'Postavljanje protivkliznih podnih keramičkih pločica oko bazena',
                    'description' => 'Pločice se uz pomoć lepka određenog od strane projektanta postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '4',
                    'title' => 'Postavljanje prefabrikovanih profilisanih keramičkih preliva po obimu bazena',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '4',
                    'title' => 'Postavljanje prefabrikovanih profilisanih keramičkih prelivnih kanala po obimu bazena zajedno sa PVC ili prohrom rešetkama',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '4',
                    'title' => 'Postavljanje keramičkih pločica na čelo stepenika',
                    'description' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '4',
                    'title' => 'Postavljanje keramičkih pločica na gazište stepenika',
                    'description' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica.'
                ],
                [
                    'subcategory_id' => '13',
                    'unit_id' => '4',
                    'title' => 'Postavljanje keramičkih pločica na stepenice (gazište i čelo stepenika)',
                    'description' => 'Pločice se postavljaju u dogovorenom rasporedu i slogu na pripremljenu podlogu. Postavljene pločice se fuguju odabranom masom za fugovanje. Nakon fugovanja, vrši se čišćenje celokupne površine postavljenih pločica. '
                ],
                [
                    'subcategory_id' => '14',
                    'unit_id' => '1',
                    'title' => 'Iznošenje postojećeg nameštaja iz prostora u kome se vrše parketarski radovi',
                    'description' => 'Nameštaj se deponuje u okviru objekta.'
                ],
                [
                    'subcategory_id' => '14',
                    'unit_id' => '1',
                    'title' => 'Pomeranje nameštaja u prostoriji gde se vrše parketarski radovi',
                    'description' => 'Nameštaj se nakon izvršenih radova vraća na svoje prvobitno mesto'
                ],
                [
                    'subcategory_id' => '14',
                    'unit_id' => '1',
                    'title' => 'Demontaža stare podne obloge od parketa',
                    'description' => 'Parket i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                [
                    'subcategory_id' => '14',
                    'unit_id' => '1',
                    'title' => 'Demontaža stare podne obloge od parketa i slepog poda',
                    'description' => 'Parket, lajsne i gredice se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Pesak, šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                [
                    'subcategory_id' => '14',
                    'unit_id' => '1',
                    'title' => 'Demontaža stare podne obloge od brodskog poda',
                    'description' => 'Brodski pod i lajsne se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                [
                    'subcategory_id' => '14',
                    'unit_id' => '1',
                    'title' => 'Demontaža stare podne obloge od brodskog poda sa slepim podom',
                    'description' => 'Brodski pod, lajsne i gredice se pažljivo demontiraju i deponuju u okviru gradilišta na mesto koje koje odredi investitor. Pesak, šut i ostali otpadni materijal se tovari u prevozno sredstvo i odvozi na gradsku deponiju na udaljenosti do 10km'
                ],
                [
                    'subcategory_id' => '14',
                    'unit_id' => '1',
                    'title' => 'Sortiranje i povezivanje demontiranog parketa',
                    'description' => 'Demontirani parket se sortira i povezuje u buntove i odlaže u okviru gradilišta na mesto koje odredi investitor.'
                ],
                [
                    'subcategory_id' => '15',
                    'unit_id' => '1',
                    'title' => 'Delimično krpljenje velikih oštećenja u podlozi',
                    'description' => 'Oštećenja podloge se isecaju, obijaju, čiste, otprašuju i impregniraju radi boljeg prijanjanja, nakon čega se popunjavaju sitnozrnim betonom i nivelišu u odnosu na okolnu  površinu podloge. Finalno se perdaše radi postizanja potrebne glatkoće.'
                ],
                [
                    'subcategory_id' => '15',
                    'unit_id' => '1',
                    'title' => 'Izravnavanje postojeće rapave podloge',
                    'description' => 'Kompletna površina postijeće podloge se otprašuje i impregnira radi boljeg prijanjanja, nakon čega se nanosi samonivelirajuća masa za izravnavanje. Nakon sušenja izravnavajuće mase, po potrebi se vrši mašinsko brušenje.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje hrastovog parketa d=22mm ukivanjem u podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje hrastovog parketa d=22mm lepljenjem za  podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje hrastovog parketa d=22mm preko vrućeg bitumena',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm ukivanjem u podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm lepljenjem za  podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje i hoblovanje hrastovog parketa d=22mm preko vrućeg bitumena',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje, hoblovanje i lakiranje hrastovog parketa d=22mm ukivanjem u podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje, hoblovanje i lakiranje hrastovog parketa d=22mm lepljenjem za  podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje,  hoblovanje i lakiranje hrastovog parketa d=22mm preko vrućeg bitumena',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje hrastovog lamel parketa lepljenjem za  podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje i hoblovanje hrastovog lamel parketa lepljenjem za  podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje, hoblovanjei lakiranje hrastovog lamel parketa lepljenjem za  podlogu',
                    'description' => 'Parket se postavlja na očišćenu podlogu. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Postavljanje, hoblovanjei lakiranje hrastovog lamel parketa kao „plivajućeg“ poda',
                    'description' => 'Preko očišćene podloge se postavlja PVC folija i filc. Parket se postavlja podužno, kao brodski pod. Po obimu poda se postavljaju odgovarajuće hrastove lajsne. Spojevi lajsni u negativnim i pozitivnim uglovima se geruju.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '1',
                    'title' => 'Hoblovanje i lakiranje postojećeg parketa sa sitnim popravkama',
                    'description' => 'Sitna oštećenja i otvorene fuge se kituju smesom pilotine i laka.'
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '3',
                    'title' => 'Krpljenje parketa na mestu demontirane peći',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '3',
                    'title' => 'Krpljenje parketa na mestu probijanja otvora za vrata u zidu',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '4',
                    'title' => 'Krpljenje parketa na mestu uklanjanja zida',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '16',
                    'unit_id' => '3',
                    'title' => 'Postavljanje i lakiranje novih hrastovih pragova',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '17',
                    'unit_id' => '1',
                    'title' => 'Demontaža poda od itisona u rolnama',
                    'description' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
                [
                    'subcategory_id' => '17',
                    'unit_id' => '1',
                    'title' => 'Demontaža poda od itisona u pločama',
                    'description' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
                [
                    'subcategory_id' => '17',
                    'unit_id' => '1',
                    'title' => 'Demontaža PVC poda u rolnama',
                    'description' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
                [
                    'subcategory_id' => '17',
                    'unit_id' => '1',
                    'title' => 'Demontaža PVC poda u pločama',
                    'description' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
                [
                    'subcategory_id' => '17',
                    'unit_id' => '1',
                    'title' => 'Demontaža poda od gume u rolnama',
                    'description' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
                [
                    'subcategory_id' => '17',
                    'unit_id' => '1',
                    'title' => 'Demontaža poda od gume u pločama',
                    'description' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
                [
                    'subcategory_id' => '17',
                    'unit_id' => '1',
                    'title' => 'Mašinsko i ručno obijanje postojećeg poda od samorazlivajućeg epoksidnog (sintetičkog) materijala',
                    'description' => 'Otpad utovariti u prevozno sredstvo i odvesti na gradsku deponiju udaljenu do 10km'
                ],
                [
                    'subcategory_id' => '18',
                    'unit_id' => '1',
                    'title' => 'Delimično krpljenje velikih oštećenja u podlozi',
                    'description' => 'Oštećenja podloge se isecaju, obijaju, čiste, otprašuju i impregniraju radi boljeg prijanjanja, nakon čega se popunjavaju sitnozrnim betonom i nivelišu u odnosu na okolnu  površinu podloge. Finalno se perdaše radi postizanja potrebne glatkoće.'
                ],
                [
                    'subcategory_id' => '18',
                    'unit_id' => '1',
                    'title' => 'Izravnavanje postojeće rapave podloge',
                    'description' => 'Kompletna površina postijeće podloge se otprašuje i impregnira radi boljeg prijanjanja, nakon čega se nanosi samonivelirajuća masa za izravnavanje. Nakon sušenja izravnavajuće mase, po potrebi se vrši mašinsko brušenje.'
                ],
                [
                    'subcategory_id' => '18',
                    'unit_id' => '1',
                    'title' => 'Mašinsko brušenje neravne betonske podloge dijamantskim diskovima',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje tekstilne podne obloge – itisona u pločama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje tekstilne podne obloge – itisona u rolnama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje podne obloge od industrijske gume u pločama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje podne obloge od industrijske gume u rolnama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem.'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje PVC podne obloge u pločama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje PVC podne obloge u rolnama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje elektrootporne podne obloge u pločama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '1',
                    'title' => 'Postavljanje elektroprovodne podne obloge u pločama',
                    'description' => 'Podna obloga se na pripremljenu, očišćenu i suvu podlogu pričvršćuje lepljenjem grafitnim lepkom preko mreže provodnika fiksiranih za podlogu'
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '4',
                    'title' => 'Postavljanje tvrdih PVC  lajsni na spoju poda i zidova',
                    'description' => ''
                ],
                [
                    'subcategory_id' => '19',
                    'unit_id' => '4',
                    'title' => 'Postavljanje mekih PVC lajsni na spoju poda i zidova',
                    'description' => ''
                ],
            )
        );
    }
}