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
            UGOVOR br. <u>&nbsp;{{ $ugovorBr }}&nbsp;</u>
            <br>
            O IZVOĐENJU GRAĐEVINSKO - ZANATSKIH RADOVA
        </b>
    </div>
    <br>
    Zaključen između <u>&nbsp;{{ $fields[0] }}&nbsp;</u> iz <u>&nbsp;{{ $fields[1] }}&nbsp;</u>, adresa:<u>&nbsp;{{ $fields[2] }}&nbsp;</u>, s jedne strane kao naručioca (u daljem tekstu: Naručilac) i
    <br><br>
    <u>&nbsp;{{ $fields[3] }}&nbsp;</u> iz <u>&nbsp;{{ $fields[4] }}&nbsp;</u>, adresa:<u>&nbsp;{{ $fields[5] }}&nbsp;</u>, PIB:<u>&nbsp;{{ $fields[6] }}&nbsp;</u> s druge strane, koje zastupa direktor <u>&nbsp;{{ $fields[7] }}&nbsp;</u> iz <u>&nbsp;{{ $fields[8] }}&nbsp;</u> , kao izvođača (u daljem tekstu: Izvođač).
    <br><br>
    Ugovorne strane su se sporazumele o sledećem:
    <br><br>
    Član 1.
    <br><br>
    Izvođač se obavezuje da za račun Naručioca izvede građevinsko - zanatske radove na objektu u <u>&nbsp;{{ $fields[9] }}&nbsp;</u> ul. <u>&nbsp;{{ $fields[10] }}&nbsp;</u> br.<u>&nbsp;{{ $fields[11] }}&nbsp;</u> u 
    svemu prema usvojenoj ponudi Izvođača br.<u>&nbsp;{{ $fields[12] }}&nbsp;</u> od <u>&nbsp;{{ $fields[13] }}&nbsp;</u> koja čini sastavni deo ovog Ugovora.
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
    Naručilac se obavezuje da na ime cene za sve radove na objektu, iz člana 1. ovog ugovora, plati izvođaču ukupan iznos od <u>&nbsp;{{ number_format($fields[14],2) }}&nbsp;</u> dinara (slovima: <u>&nbsp;{{ $fields[15] }}&nbsp;</u> dinara), sa uračunatim PDV-om.
    <br><br>
    Član 4.
    <br><br>
    Ukoliko se ukaže potreba za izvođenjem dodatnih ili nepredviđenih radova, Izvođač će pristupiti njihovom izvođenju nakon ispostavljanja Ponude za ove radove koju će Investitor pisanim putem prihvatiti.
    U ovom slučaju, ugovorena cena radova iz člana 3 ovog ugovora će se uvećati za iznos dodatnih ili nepredviđenih radova.
    <br><br>
    Član 5.
    <br><br>
    Naručilac se obavezuje da će na ime avansa Izvođaču uplatiti iznos od <u>&nbsp;{{ number_format($fields[16],2) }}&nbsp;</u> dinara, u skladu sa uslovima iz usvojene ponude Izvođača. 
    <br><br>
    Član 6.
    <br><br>
    Izvođač se obavezuje da će radove započeti u roku od <u>&nbsp;{{ $fields[17] }}&nbsp;</u> dana od dana uplate avansa, u skladu sa uslovima iz usvojene ponude Izvođača.
    <br><br>
    Član 7.
    <br><br>
    Izvođač s obavezuje da sve radove na objektu iz člana 1. ovog ugovora izvede u roku od <u>&nbsp;{{ $fields[18] }}&nbsp;</u> radnih dana, u skladu sa uslovima iz usvojene ponude Izvođača. 
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
    Sve eventualne sporove ugovorne strane će rešavati mirnim putem. Ukoliko do rešenja spora nije moguće doći na ovaj način, ugovara se nadležnost suda u <u>&nbsp;{{ $fields[19] }}&nbsp;</u>.
    <br><br>
    Član 11.
    <br><br>
    Ovaj ugovor sačinjen je u <u>&nbsp;{{ $fields[20] }}&nbsp;</u> istovetna  primerka, od kojih 
    se <u>&nbsp;{{ $fields[21] }}&nbsp;</u> primerka nalaze kod Naručioca, a <u>&nbsp;{{ $fields[22] }}&nbsp;</u> primerka kod Izvođača.
    <br><br>
    U <u>&nbsp;{{ $fields[23] }}&nbsp;</u> , dana <u>&nbsp;{{ $fields[24] }}&nbsp;</u> godine
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
</body>

</html>
