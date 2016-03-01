Redovisning
====================================
 
 <h2 id=1>Kmom01: PHP-baserade och MVC-inspirerade ramverk</h2>
 
Detta kursmoment var både spännande och väldigt tungt, var väldigt mycket att läsa och stundtals kändes det som jag aldrig skulle bli klar. Men kommer antagligen behöva gå igenom det fler gånger i framtiden för att få allt att fastna. Men när jag väl fick börja med uppgifterna blev det väldigt roligt, artiklarna var lätta att följa med i även om det blev lite förvirrande ibland där det smugig sig in några småfel.

Lekte runt och experimenterade en hel del med anax-ramverket för att försöka förstå hur allt fungerar, är ingen mästare på css så gjorde inga stora förrändringar i utseendet på sidan. Men la in Me-sidan i index-frontcontroller, vet inte om det är en bra lösning eller inte men vill se hur det fungerade. Plysslade även en bra stund med navbaren, delvis pga att det stod i instruktionerna att jag skulle lägga in stylesheeten för den i app/config/theme.php, men för att få det att funka för mig var behövde jag lägga in den i app/config/theme_me.php.

Har i och med starten på denna kurs bytt texteditor från JEdit som har drivit mig till vansinne speciellt efter deras senaste update som gjorde att kortkomandona slutade funka. Nu har jag gått över till Adobe Edge Code CC, tycker det är great speciellt med tanke på storleken på detta ramverk så ger det en väldigt bra översikt bland alla filerna. Utöver det är det fortfarnade MAMP, fillezilla, safari och firefox som gäller.

Säger som jag sagt i tidigare kurser, jag har ingen erfarenhet i detta ämne med ramverk, däremot har jag jobbat med MVC tidigare med då i mycket mindre och enklare projekt än detta i xcode. Ramverket är lite svårt att greppa och det blir lite detektivarbete för att hitta rätt fil för att jobba i, men mycket är ganska logiskt och med tiden kommer förhoppningsvis min förståelse bli djupare.

Men det jag än så länge uppfattat av Anax-MVC tycker jag mycket om det och det är ett väldigt smidigt ramverk att jobb i så fort man hittar det man ska. Gillar konceptet med filer med kort och enkel kod, det gör det så himla mycket mer lätt jobbat när man inte behöver göra djupdykningar i meterlång kod.
 
Det enda jag gick riktigt bet på var att implementera bilder, men la inte heller så mycket tid på det då det inte kändes som det allra viktigaste i detta kursmoment förhoppningsvis kan jag pigga upp min webbsida lite längre fram i kursen.

Gjorde lite av extra uppgifterna, la till dice-pagecontrollern i navbaren och la upp projektet på github, men ganska basic.

<h2 id=2>Kmom02: Kontroller och modeller</h2>
 
Detta kursmoment började väldigt bra, allt flöt på bra, tyckte alla övningarna var lätta att hänga med och följa och funkade ganska problemfritt, vet dock inte hur man skulle använda Terminalen på studentserven men det löste jag genom att göra övningarna på min egen miljö.

<i>Edit(5/6-15), efter en snabb sökning i forumet hittade jag hur jag skulle logga in på studentservern via terminalen så löste även det.</i>

<strong>Hur känns det att jobba med Composer?</strong>

Composer kände som ett smidigt och bra verktyg, har inte riktigt fått grepp om alla funktionerna och alla användningsområden än men det kommer med tiden.

<i>Edit(5/6-15) De lilla som gjordes i Composer funkade väldigt bra och allt fungerade som det skulle för mig.</i>

<strong>Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?</strong>

Gick väldigt översiktligt genom Packagist, tiden var emot mig som vanligt så får gå djupar genom det i framtiden men verkar finns flera intressanta delar att utforka. 

<strong>Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?</strong>

När jag kom till uppgiften kände jag mig först väldigt lost och hade gärna velat ha lite mer vägledning hur det hela skulle fungera men efter mycket forskande i forumet och kika på hur de andra hade löst uppgiften kändes det som jag fick hyfsad hum om hur det skulle fungera. 

Dock satte jag en del käppar i hjulen för mig själv då jag gjorde några stavfel som genererade mycket felkod vilket gjorde att jag trodde felen var större än de egentligen var, men det gav mig också djupare förståelse för hur koden fungerade, eftersom jag fick skriva den flera gånger.

<i>Edit(5/6-15)Denna gången grävde jag djupare i koden, var tvungen för att kunna lösa kompletteringsuppgiften och fick väldiga bekymmer med just dispatcher-funktionerna, vilket i slutändan var bra för till slut såg även jag sambandet mellan klasserna och inser att det är inget magiskt trolleri som gör att de kan kommunicera med varandra.</i>

<strong>Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?</strong>

Eftersom jag är väldigt novis inom ämnet än så länge känner jag mig absolut inte i position att kritisera koden som följde med phpmvc/comment tyckte den var lätt att förstå när jag väl satte mig in i den, blev ju ett par ändringar i den men bara med nya metoder för kommentarsfältet olika funktioner.

<i>Edit(5/6-15) Efter ett väldigt långt uppehåll satte jag mig äntligen ner och tog tag i de jag hade fått komplettering på, eftersom det hade gått så lång tid sen sist fick jag så gott som börja om med hela momentet men känner nu att jag även fick en djupare förståelse för Anax än förra gången, även om det fortfarande kan kännas lite rörigt ibland.

Mitt Anax-MVC är nu uppdaterat till senaste versionen, som låg ganska långt ifrån den versionen jag jobbade på för nästan ett år sen så de var de jag fick lägga mest tid på. Men nu funkar kommentarerna som de ska, och finns på två sidor, under Me och Kommentarer.</i>

<h2 id=3> Kmom03: Bygg ett eget tema </h2>

Efter att ha haft det rätt tungt i det förra kursmomentet där jag kände mig väldigt lost var det med stor glädje jag högg in på detta kursmomentet som var betydligt enklare och tydligare att hänga med i. Förutom ett par små fel som jag lyckades avhjälpa med forumsinlägget efter övningen och insåg senare att jag hade kunnat undvika till största delen om jag bara läst noggrannare gick övningen över förväntan. I detta kursmomentet kändes de dessutom som jag börjar få lite mer hum om hur Anax-MVC fungerar och inte behöver sitta och leta efter varenda väg som måste tas utan det föll sig mer naturligt.

<strong>Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?</strong>

Känner mig som en hackande skiva när jag säger att jag inte har så stora erfarenheter av CSS-ramverk sen tidigare men samtidigt är det också tjusningen med dessa kurser, upptäcker hela tiden nya tekniken som jag aldrig tänkt på tidigare. Tycker de verkar vara en otroligt smidig lösning för att korta ner processen och gillade skarpt idé om att plocka ihop de godbitar man vill ha, dock känner jag mig lite för grön inom området för att riktigt kunna utnyttja den tekniken än men samtidigt är ramverken ett smidigt sätt att lära sig mer om språket, lättare att testa sig fram i färdig kod än att börja från noll.

<strong>Vad tycker du om LESS, lessphp och Semantic.gs?</strong>

LESS verkar vara bra, som CSS fast med lite mer grejer, hade lite svårt att sätta mig in i allt då jag känner att jag har långt kvar innan jag riktigt bemästar CSS så att lägga på ännu fler funktioner var svårt att ta in men det kommer förhoppningsvis med tiden. lessphp kändes som den funkade som den skulle, följde bara guiden över hur jag skulle installera det och de kändes som en ganska smart grej men har inte så mycket att jämnföra med. Semantic.gs var basic, rakt på sak, kändes som jag fick ett hyfsat hum om hur det skulle fungera och tyckte det var lättjobbat. 

<strong>Vad tycker du om gridbaserad layout, vertikalt och horisontellt?</strong>

Tyckte den gridbaserad layouten var ett smidigt sätt att bygga upp sida på för att få en harmoni i layouten och för att bygga en mer läsvänlig och intressant hemsida, gillade verkligen att ha bilden som representerar det tänkta rutnätet i bakgrunden, gjorde det så mycket enklare att se om allt låg rätt eller inte, något som hade varit ganska omöjligt att göra med blotta ögat.

<strong>Har du några kommentarer om Font Awesome, Bootstrap, Normalize?</strong>

Font Awesome tyckte jag var mycket rolig att jobba med, tog med en hel del av dess element i mitt slutgiltiga tema, enkel att installera och sen var det bara att kasta sig över alla olika roliga ikoner, fick genast mitt tema att se mycket roligare ut än med bara text. Bootstrap var jag bara inne och nosade på så där har jag inga större kommentarer kommer kika mer på det vid tillfälle. Normalize tycker jag var smart för att slippa oroa sig för hur en sida ska se ut på andra webbläsare än de man själv testar på, att undvika obehagliga överraskningar är alltid en bra idé.

<strong>Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?</strong>

Jag skapade mitt tema som en blandning av alla tekniker som används under övningen, detta både för att verkligen få in hur allt funkar men också för att se om jag kunde ändra kod utan att de föll sönder, hade gärna velat ta ut svängarna mer och trycker det är otroligt roligt att sitta och pilla med design och skulle gärna velat lägga ett antal timmar till på detta tema men tiden räckte inte till denna gången. Hade vissa svårigheter att få temat att fungera responsivt snyggt, men efter lite trixande med att göra boxarna flytande istället för fasta blev reslutatet precis som jag hade velat. Mitt tema är ganska stilrent och enkelt, satsade mer på harmoni än stil och färg, blev lite citat, ett par länkar i sidebaren och lite annat smått och gott man kan nog säga att det syns att jag pillar en del med blogg-layout. Skapade en egen sida för temat, theme.php istället för att lägga in den i index.php, detta för att så enkelt som möjligt kunna omvandla temat längre fram till en egen tema-modul som inte är beroende av Anax-MVC.

<h2 id=4> Kmom04: Databasdrivna modeller </h2>

Efter att ha lagt denna kursen på is ett bra tag kände jag att min första lärdom var att det var en dum idé, det var svårt att komma in i tänket igen och att få någonting över huvudtaget att fungera! Någonting krockade så den enda sidan som fungerade var index, men efter en ny kloning av Anax-MVC och bara lägga till de filer jag jobbar med under tidigare kurs-moment fick jag det att fungera igen. Denna tid har jag dock inte räknat in i mitt arbete med kursmomentet men trots det var jag tvungen att lägga mycket mer än 20 timmar på detta kursmoment, och på slutet fick jag både ta ett par genvägar, strunta i att rensa genom klasserna ordentligt och stunta i funktioner som jag inte fick att funka, dock ska mitt arbete ändå uppfylla kraven för kursmomentet hoppas jag.

<strong>Vad tycker du om formulärhantering som visas i kursmomentet?</strong>

Formulärhanteringen i detta kursmoment var nog de enda jag verkligen förstod, även om jag hade mina bekymmer när jag jobbade med uppgiften var de ändå något som jag fick ett hum om i jämför med de andra delarna som jag fortfarnade känner mig väldigt tveksam på om jag förstått.

<strong>Vad tycker du om databashanteringen som visas, föredrar du kanske traditionell SQL?</strong>

Jag kände att jag inte riktigt fick något grep om databashanteringen och satt och försökte trassla upp min kod under större delen av momentet för att överhuvudtaget ha någonting att visa upp, hela kursmomentet kändes väldigt svårt, hade stora problem redan med övningen “Skapa basklasser för databasdrivna modeller i Anax MVC”, hade svårt att förstå vad som skulle vara vart och även om jag förstår konceptet med MVC tycker jag det är svårt att få grepp om vad som ska vara vart. Men detta kan ju beror på att jag gått tillbaka till kursen efter så lång tid. 

Dessutom känns Anax både smidig och rörig, väldigt rörigt med alla olika kataloger, speciellt med namespace som inte behöver ha så mycket med mappen den ligger i vilket gör filer svårt att följa, men när jag flytta ut mina filer till en egen mapp och gav dem namespacet Enax var de lite enklare att hitta iaf mina egna filer.

Men för att svara på fråga, nej jag tror jag kommer med lite mer förståelse gilla denna formulärhantering bättre än traditionell SQL som känns lite med messy.

<strong>Gjorde du några vägval, eller extra saker, när du utvecklade basklassen för modeller?</strong>

Nej inte direkt.

<strong>Beskriv vilka vägval du gjorde och hur du valde att implementera kommentarer i databasen.</strong>

När jag väl kom till kommentardelen hade jag redan lagt mycket mer än 20 timmar på kursmomentet och haft mycket huvudbry så gjorde de så enkelt som möjligt för mig och använde Userfilern som mall och ändrade bara forumulär-innehållet och vad jag gjorde sen har jag svårt att komma ihåg då den blev så rörigt och jag trimmade bara till klasserna för att bli av med errorna.

<strong>Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.</strong>

Nej absolut inte, hade redan lagt väldigt mycket tid och kände att jag måste gå vidare.

<h2 id=5> Kmom05: Bygg ut ramverket </h2>

Detta kursmoment kändes som gjort för mig, att göra något litet och lättöverskådligt var väldigt skönt efter allt strulande att hitta rätt filer i tidigare kursmoment, när jag lästa “The MicroPHP Manifesto” kände jag mig nästan fånig som höll med om varenda ord författaren skrev! 

<strong>Var hittade du inspiration till ditt val av modul och var hittade du kodbasen som du använde?</strong>

Jag valde att försöka göra det relativt enkelt för mig och jobba mig nerifrån och upp genom att bara göra en väldigt enkel utbyggnad av CTextFilter, min tanke var att börja med få metoder och om jag får tid över vidarutveckla den med mer avancerad funktioner. Jag hade därför tänkt utgå från Anax inbyggda fil men inser sedan att de redan finns en extra modul för CTextFilter som dessutom är mycket mer utvecklad än originalfilen vilket är rätt logisk men det gjorde också min uppgift både lättare och svårare då jag har en väldigt färdig kod att utgå från men också lite knixigare att hitta fler funktioner som inte redan finns. De jag hade tänkt från börja fanns redan, så som purify, men la istället till de två från smartypants. 

Men efter en hel del krånglande inser jag att detta nog inte var rätt väg att gå, i slutändan hade de bara blivit en modul som kallade på andra moduler vilket inte kändes särskilt användbar. Så gick i stället över till flashmeddelanden som var rolig att skapa då de även gav möjligheter att leka lite i css men också som kändes som en användbarfunktion, kikade lite på hur mina kurskamrater gjort och läste igenom hur Ramverket Phalcon skapade sin innan jag gav på uppgiften. 

<strong>Hur gick det att utveckla modulen och integrera i ditt ramverk?</strong>

I slutändan gick de ganska smärtfritt, både att integrera i mitt nuvarande ramverk och i standard Anax-MVC, kikade på hur mos moduler var uppbyggda och återskapade en liknande stuktur. Gjorde modulen väldigt enkel men tyckte inte de behövde så mycket extra funktioner för meddelande, men vid tid i framtiden kanske jag kommer att vidareutveckla den till snyggare meddelande och fler varianter, nu blev de 4 olika då jag tyckte de räckte för de flesta fall.

<strong>Hur gick det att publicera paketet på Packagist?</strong>

Superenkelt, tog bara ett par min, kikade även här hur mos hade gjort sin composer-fil och gjorde en liknande, allt funkade smärtfritt och autentiseringen var ju bara att läsa sig till så även de var klart snabbt och smidigt. 

<strong>Hur gick det att skriva dokumentationen och testa att modulen fungerade tillsammans med Anax MVC?</strong>

Dokumentationen tog en stund att skriva men den gjorde jag efter hur jag själv interagerade modulen med standard Anax, det enda jag inte tog med var hur man använder composer då detta tyckte jag låg utanför vad som behövde vara med. Jag beskrev även vad de olika anropen gjorde för att användaren lätt ska kunna sätta igång och använda modulen. Kikade lite på hur en annan student hade skrivit sin för att få till textens layout på ett snyggt och lättläst sätt. 

<strong>Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.</strong>

Denna gången gjorde jag faktiska det, laddade hem toeswade CLog, då jag tyckte denna verkade intressant, följde intruktionerna och den verkar funka riktigt bra, skulle säkert vara väldigt användbar om man i framtiden behövde hjälp med optimering. 

<h2 id=6>Kmom06: Verktyg och CI</h2>

När jag började med detta kursmomentet kikade jag först över momentet och sen lite i forumet för att så om de var någoot speciellt jag skulle tänka på, då blev jag väldigt positivt inställd, momentet kändes inte allt för krångligt och i forumet pratades de om att de var ett ganska smidigt moment, läste dock bara de översta kommentarerna så missade helt de som fick mycket problem och klydd. Så det blev ett hårt slag när precis allt krånglade från början och genom hela momentet. Först var min php för gammal så uppdaterade, vilket inte hjälpte men hittade efter mångt och mycket anledningen, den nya uppdateringen lägger sig på en annan plats så path måste rutas om, de var inte allt för svårt, men upptäckte att de funkade bara så länge de terminalen-fönstret var öppen sen försvann pathen igen. Att hitta lösningen på de var inte så svårt det svåra var att förstå varför de blev så installerade säkert om php 10-15 gånger! 

Då det blev ganska stora förändringar i min modul skapade jag en egen branch för att koden detta kursmoment inte skulle radera ut förra kursmomentets kod, försöker länka rätt till rätt bansch med ser de fel ut kolla att branchen kmom06 är vald.

<strong>Var du bekant med några av dessa tekniker innan du började med kursmomentet?</strong>

Nej allt var helt nytt för mig aldrig provat något att metoderna tidigare och de kändes som väldigt mycket tidsöslande och ganska lite att få ut av det, men när jag var klar med momentet så visst tyckte jag att de var väldigt roligt när verktygen blev gröna och att min kod var godkänd men ofta gick de helt åt pipan bara pga att git la till något i travis eller scrutinizer filerna och jag fick pilla lite till, ibland blev de även trots inga ändringar i filer som funkade perfekt gången innan så verktygen känns lite knepiga.

<strong>Hur gick det att göra testfall med PHPUnit?</strong>

När jag sedan övergick till phpunit, funkade allt precis som de skulle genom hela installationen, tills den skulle användas, då fick jag ett felmeddelande och trots att jag spenderade närmare ett dygn på att försöka lösa problemet fick jag de inte att funka, då tex pear var borttaget som metod och överallt blev jag bara hänvisad till original metoden som somsagt inte funkade, men tror problemet är in min dator(mac), dock provade jag även med min andra dator(Imac) men med samma problem så tillslut fick jag inse mig besegrad och använda mig av lättvarianen att ha phpunit.phar liggande i mappen jag jobbade i och använda hela kommandot php phpunit.phar. Copypastade de så jag hade de i en anteckning och kunde ta fram de enkelt efter att ha skrivit in de otaligt antal gånger.

Då kom nästa problem, eftersom min modul var beroende av Anax-MVC gick jag igenom guiden för "PHPUnit och testa modul som är beroende av Anax MVC" den lätt väldigt enkel men satt ändå med ca 255(travis räknade) fel som jag inte hade en aning om hur jag skulle lösa. Kikade på hur mina medstudenter hade löst de men kunde ändå inte få ner mängde fel ens lite, kände inte att de var rätt väg att börja ändra i anax men de kändes som att felen kom där. Efter att ha sovit på saken såg jag hur en student hade gjort sin modul oberoende genom att använda globala $_SESSION istället för anaxs, kanske inte en helt optimal lösning men kändes som att uppgiften blev lite enklare att lösa då. Efter att ha tagit bort beroendet var bara 2 fel kvar, detta var en mycket mer lättarbetad situation och jag kunde istället lägga lite krut på att kika runt i verktygen för att förstå hur de skulle fungera och lösa mina två fel. Slutresultatet blev densamma iaf. 

<strong>Hur gick det att integrera med Travis?</strong>

När jag väl gjort min moduloberoende funkade Travis väldigt bra, allt blev så grönt och fint, gillade mycket att den var så effektiv däremot tyckte jag de kändes som ett ganska enkelt verktyg, hade gärna velat ha lite mer innehållsrika rapporter. Men de fick jag ju sedan med Scrutinizer så kanske inget jätteproblem. 

<strong>Hur gick det att integrera med Scrutinizer?</strong>

Samma som ovan när modulen väl var oberoende funkade de riktigt bra, lite långsamt, speciellt som de fick problem med hastigheten så den blev ännu långsammare, dock hade jag stora problem att få coverage, stod bara att den inte var tillgänglig trots att jag hade med allt för att de skulle fungera. Detta var såklart de jag ahde kvar sist så de vara bara att snällt sitta och vänta på att de skulle bli klart, ibland så länge som 30 min bara för att få ett teeny tiny fel, det kunde vara väldigt frusteraden och tidsödslande. Men övrigt gillade jag detta verktyg de gav väldigt utförlig information om testet och även tips om förbättring. 

<strong>Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?</strong>

På små uppgifter var jag väldigt bekväm med verktygen när jag väl jobbat med dem en stund men har svårt att se att jag skulle orkar göra detta på stora projekt, speciellt inte som jag inte kunde få att det funka ens lite när min modul var beroende av Anax. Kanske om man har med verktygen från början vid utveckling men att försöka stoppa in något stort känns som väldigt tidsödslande. 

<strong>Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.</strong>

Det var två extra uppgifter, den i själva uppgiften om 100% code coverage och 10 poäng på kodkvalitet jobbade jag lite på, kodkvaliten var 10.0 under hela uppgiften så den krävde inte så mycket, code coverage däremot hade jag bekymmer med att få att funka över huvudtaget men när jag väl fick de att fungera så landade den på 94% vilket fick mig att känna att jag bara måste nå 100%, jag tror inte att det är så lätt på en stor modul men på min lilla kändes de inte som helt omöjligt och med lite pillande kom jag iaf upp till 98%, det är inte hundra men jag vet att testfallen iaf inkapslar alla min metoder och kände att de fick räcka. 

<h2 id=7-10>Kmom07/10: Projekt och examination</h2>

<strong>1.2. För varje krav du implementerat, dvs 1-6, skriver du ett textstycke om ca 5-10 meningar där du beskriver vad du gjort och hur du tänkt. </strong>

<strong>Krav 1.</strong>
<strong>Krav 2.</strong>
<strong>Krav 3.</strong>
<strong>Krav 4.</strong>
<strong>Krav 5.</strong>
<strong>Krav 6.</strong>

<strong>1.3. Skriv ett allmänt stycke om hur projektet gick att genomföra. Problem/lösningar/strul/enkelt/svårt/snabbt/lång tid, etc. Var projektet lätt eller svårt? Tog det lång tid? Vad var svårt och vad gick lätt? Var det ett bra och rimligt projekt för denna kursen?</strong>

<strong>1.4. Avsluta med ett sista stycke med dina tankar om kursen och vad du anser om materialet och handledningen (ca 5-10 meningar). Ge feedback till lärarna och förslå eventuella förbättringsförslag till kommande kurstillfällen. Är du nöjd/missnöjd? Kommer du att rekommendera kursen till dina vänner/kollegor? På en skala 1-10, vilket betyg ger du kursen?</strong>