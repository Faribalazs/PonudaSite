<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pozicija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pozicija', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->string('title');
            $table->text('description');
        });
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
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pozicija');
    }
}
