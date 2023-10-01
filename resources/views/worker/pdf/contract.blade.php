<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Ugovor Ponuda Majstora</title>
    <style type="text/css">
        * {
          font-family: "DejaVu Sans Mono", monospace;
          font-size: 9px;
        }
    </style>
</head>
<body style="padding-left: 20px; padding-right: 20px;">
    <div style="text-align: center">
        <b>
            UGOVOR br. <u>&nbsp;{{ auth('worker')->user()->id }}P{{ $id }}K{{ $company_data->id }}{{ $type_lica }}{{ $foundClient->id }}&nbsp;</u>
            <br><br>
            O IZVOĐENJU GRAĐEVINSKO - ZANATSKIH RADOVA
        </b>
    </div>
    <br>
    Zaključen između <u>&nbsp;{{ $foundClient->first_name }}&nbsp;{{ $foundClient->last_name }}&nbsp;</u> iz <u>&nbsp;{{ $foundClient->city }}&nbsp;</u>, adresa:<u>&nbsp;{{ $foundClient->address }}&nbsp;</u>, s jedne strane kao naručioca (u daljem tekstu: Naručilac) i
    <br><br>
    <u>&nbsp;{{ $company_data->company_name }}&nbsp;</u> iz <u>&nbsp;{{ $company_data->city }}&nbsp;</u>, adresa:<u>&nbsp;{{ $company_data->address }}&nbsp;</u>, PIB:<u>&nbsp;{{ $company_data->pib }}&nbsp;</u> s druge strane, koje zastupa direktor <u>&nbsp;{{ auth('worker')->user()->name }}&nbsp;</u> iz <u>______</u>, kao izvođača (u daljem tekstu: Izvođač).
    <br><br>
    Ugovorne strane su se sporazumele o sledećem:
    <br><br>
    Član 1.
    <br><br>
    Izvođač se obavezuje da za račun Naručioca izvede građevinsko - zanatske radove na objektu u <u>&nbsp;&nbsp;</u> ul. <u>&nbsp;&nbsp;</u> br.<u>&nbsp;&nbsp;</u> u svemu prema usvojenoj ponudi Izvođača br.__________ od __. __.____. koja čini sastavni deo ovog Ugovora.
    <br><br>
    Član 2.
    <br><br>
    Izvođač se obavezuje da:
    <br><br>
    - sve radove iz člana 1. ovog ugovora izvede u skladu sa važećim tehničkim normativima, standardima i propisima;
    <br>
    - upotrebljava materijal i opremu koji u svemu odgovaraju važećim normativima i standardima;
    <br>
    - će se u toku izvođenja radova pridržavati svih važećih normi iz oblasti bezbednosti i zdravlja na radu.
    <br><br>
    Član 3.
    <br><br>
    Naručilac se obavezuje da na ime cene za sve radove na objektu, iz člana 1. ovog ugovora, plati izvođaču ukupan iznos od <u>&nbsp;{{ $sum }}&nbsp;</u> dinara (slovima: <u>&nbsp;{{ $sum_in_words }}&nbsp;</u> dinara), sa uračunatim PDV-om.
    <br><br>
    Član 4.
    <br><br>
    Ukoliko se ukaže potreba za izvođenjem dodatnih ili nepredviđenih radova, Izvođač će pristupiti njihovom izvođenju nakon ispostavljanja Ponude za ove radove koju će Investitor pisanim putem prihvatiti.
    U ovom slučaju, ugovorena cena radova iz člana 3 ovog ugovora će se uvećati za iznos dodatnih ili nepredviđenih radova.
    <br><br>
    Član 5.
    <br><br>
    Naručilac se obavezuje da će na ime avansa Izvođaču uplatiti iznos od ___________ dinara, u skladu sa uslovima iz usvojene ponude Izvođača. 
    <br><br>
    Član 6.
    <br><br>
    Izvođač se obavezuje da će radove započeti u roku od ___ dana od dana uplate avansa, u skladu sa uslovima iz usvojene ponude Izvođača.
    <br><br>
    Član 7.
    <br><br>
    Izvođač s obavezuje da sve radove na objektu iz člana 1. ovog ugovora izvede u roku od ___________________ radnih dana, u skladu sa uslovima iz usvojene ponude Izvođača. 
    <br><br>
    Član 8.
    <br><br>
    Izvođač Naručiocu na izvedene radove daje garanciju u trajanju od dve (dve) godine od dana primopredaje radova.
    <br><br>
    Član 9.
    <br><br>
    Na sve što nije precizirano ovim ugovorom, primenjivaće se odredbe Zakona o obligacionim odnosima.
    <br><br>
    Član 10.
    <br><br>
    Sve eventualne sporove ugovorne strane će rešavati mirnim putem. Ukoliko do rešenja spora nije moguće doći na ovaj način, ugovara se nadležnost suda u __________.
    <br><br>
    Član 11.
    <br><br>
    Ovaj ugovor sačinjen je u _ istovetna  primerka, od kojih se __ primerka nalaze kod Naručioca, a __ primerka kod Izvođača.
    <br><br>
    U _____________________ , dana {{ now()->format('d.m.Y') }} godine
    <br><br>
    <div style="float:left">
        <div style="text-align: center">
            IZVOĐAČ
            <br><br>
            _____________________
        </div>
     </div>
     
     <div style="float:right">
        <div style="text-align: center">
            NARUČILAC
            <br><br>
            _____________________
        </div>
     </div>
    {{-- HA ZORAN AKARNA URES UGOVORT --}}

    {{-- <div style="text-align: center">
        <b>
            UGOVOR br. ________
            <br><br>
            O IZVOĐENJU GRAĐEVINSKO - ZANATSKIH RADOVA
        </b>
    </div>
    <br>
    Zaključen između __________________________ iz ______________, adresa:____________________, s jedne strane kao naručioca (u daljem tekstu: Naručilac) i
    <br><br>
    ______________________________ iz ________________________, adresa:____________________, PIB:___________________ s druge strane, koje zastupa  direktor ____________________________________ iz __________________, kao izvođača  (u daljem tekstu: Izvođač).
    <br><br>
    Ugovorne strane su se sporazumele o sledećem:
    <br><br>
    Član 1.
    <br><br>
    Izvođač se obavezuje da za račun Naručioca izvede građevinsko - zanatske radove na objektu u ______________________ ul. ___________________ br.______ u svemu prema usvojenoj ponudi Izvođača br.__________ od __. __.____. koja čini sastavni deo ovog Ugovora.
    <br><br>
    Član 2.
    <br><br>
    Izvođač se obavezuje da:
    sve radove iz člana 1. ovog ugovora izvede u skladu sa važećim tehničkim normativima, standardima i propisima;
    upotrebljava materijal i opremu koji u svemu odgovaraju važećim normativima i standardima;
    će se u toku izvođenja radova pridržavati svih važećih normi iz oblasti bezbednosti i zdravlja na radu.
    <br><br>
    Član 3.
    <br><br>
    Naručilac se obavezuje da na ime cene za sve radove na objektu, iz člana 1. ovog ugovora, plati izvođaču ukupan iznos od _____________ dinara (slovima: __________________________________ dinara), sa uračunatim PDV-om.
    <br><br>
    Član 4.
    <br><br>
    Ukoliko se ukaže potreba za izvođenjem dodatnih ili nepredviđenih radova, Izvođač će pristupiti njihovom izvođenju nakon ispostavljanja Ponude za ove radove koju će Investitor pisanim putem prihvatiti.
    U ovom slučaju, ugovorena cena radova iz člana 3 ovog ugovora će se uvećati za iznos dodatnih ili nepredviđenih radova.
    <br><br>
    Član 5.
    <br><br>
    Naručilac se obavezuje da će na ime avansa Izvođaču uplatiti iznos od ___________ dinara, u skladu sa uslovima iz usvojene ponude Izvođača. 
    <br><br>
    Član 6.
    <br><br>
    Izvođač se obavezuje da će radove započeti u roku od ___ dana od dana uplate avansa, u skladu sa uslovima iz usvojene ponude Izvođača.
    <br><br>
    Član 7.
    <br><br>
    Izvođač s obavezuje da sve radove na objektu iz člana 1. ovog ugovora izvede u roku od ___________________ radnih dana, u skladu sa uslovima iz usvojene ponude Izvođača. 
    <br><br>
    Član 8.
    <br><br>
    Izvođač Naručiocu na izvedene radove daje garanciju u trajanju od dve (dve) godine od dana primopredaje radova.
    <br><br>
    Član 9.
    <br><br>
    Na sve što nije precizirano ovim ugovorom, primenjivaće se odredbe Zakona o obligacionim odnosima.
    <br><br>
    Član 10.
    <br><br>
    Sve eventualne sporove ugovorne strane će rešavati mirnim putem. Ukoliko do rešenja spora nije moguće doći na ovaj način, ugovara se nadležnost suda u __________.
    <br><br>
    Član 11.
    <br><br>
    Ovaj ugovor sačinjen je u _ istovetna  primerka, od kojih se __ primerka nalaze kod Naručioca, a __ primerka kod Izvođača.
    <br><br>
    U _____________________ , dana {{ now()->format('d.m.Y') }} godine
    <br><br>
    <div style="float: left;">IZVOĐAČ</div><div style="float: right;">NARUČILAC</div><br>
    <div style="float: left;">_____________________</div><div style="float: right;">_____________________</div> --}}
</body>

</html>
