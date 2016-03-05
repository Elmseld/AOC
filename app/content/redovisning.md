Redovisning Kmom07/10: Projekt och examination
====================================

Lösenordet är dessa som användarnamnet för testanvändarna

Wow, nu när man står på andra sidan och ser tillbaka, väldigt kort tillbaka dock då jag precis blivit klar, känner jag bara vilket otroligt spännande projekt! Önskade verkligen att jag hade haft mer tid att spendera på detta projekt, men om tiden har varit knappt på de tidigare kursmomenteten är det ingeting mot detta, dessutom har jag haft csn flåsande i nacken så har verkligen haft tidspress.

Krav 1, 2, 3.
----------------------

Vet inte riktigt hur jag skulle dela upp kravet i tre så får bli ett enda stycke om alla tre, det var många delar som skulle in i denna del, jag gick uppifrån och ner och började så gott som med inloggning, det var nog både positivt och negativt, det gick ganska smidigt, kikade lite på hur mina studekamrater gjort för att få den allra högst upp på sidan och försökte mig sedan på något liknande. Att de gick smidigt gav mig blodad tand att ge mig på de andra men samtidigt hade de varit bättre att gör den efter att user-databasen var klar.

Att bygga tabellerna till databasen var helt klart de största och mest tidskrävande, de blev väldigt många och från början försökte jag behålla skapandet av varje databas i sina egna klasser, men tillslut var index-sidan överfull med anropslänkar så de fick bli att skapa en egen kontroller för databasuppbyggnaden, då räckte de med ett anrop och var också lättare att bygga tabellerna med foreign key när man inte behövde leta bland filerna hela tiden.

Det är nog den största nakdelen som jag kan se med ramverket, att de blir väldigt många filer och även om jag vet vilka filer jag ska använda tar de sin lilla tid att bläddra genom alla olika mappar etc för att komma till rätt fil, men efter att har gjort en seriös utrensning ibland filerna på slutet blev ramverkat mycket mer lättjobbat, önskade bara att jag gjort detta tidigare.

Det blev väldigt mycket databashantering, och jag la många timmar på att friska upp mina databas-kunskaper, detta gjorde mig lite förvånad då jag inte alls har tänkt på att denna kurs har så mycket med databas-hantering att göra. Jag känner jag nog skulle kunna lägga ett par timmar till på att förfina mina databasanrop bättre och om inte annat tydligare då det med alla olika omskrivningar kan vara svårt att se vad som gör vad. 

Jag kände att med denna uppgift fick jag en ordentlig känsla för hur MVC-tänket är uppbyggt och kände också att jag lyckades dela upp alla delar på rätt ställen, de som ska vara i vyerna var i vyerna och de som ska vara i controllerna var där, nästn iaf kanske att de finns lite för mycket funktion i vyerna men det kan också vara att vara lite väl nitisk kanske. Jag la upp mina vyer som så att varje del hade en egen vy, för att lättare kunna återanvända dem, dock blev de på så vis väldigt många vyer som var lite svåra att överblicka vilket gjorde felsökningen ganska ansträngande, men detta löste jag genom att kommentera in namn på varje vy så jag kunde hitta vilken vy det var i safaris webbgranskare, det var mycket användbart!

Något jag också fick lära mig den hårda vägen är att skriva bra tabellnamn i databasen, för när ett namn väl är satt blir jobbet att ändra dem i efterhand väldigt stort när man har anropat tabellen många gånger i olika klasser, detta fel lyckades jag med många gånger då jag tycker de skulle vara enklare med avkortade namn när jag sedan gjorde anropen men då blev de inte så återanvändbara, speciellt när man inte döper tabeller och de tabeller som håller i foreign keys till samma sak. Men slutresultat blev iaf väldigt namngivna tabeller som var lätta att anropa. 

Projektet finns på github med en väl utförlig readme-fil som förklarar exakt hur man kan ladda ner och sätta upp sidan på sin egen server, har ofta själv svårt att förstå installations beskrivning så försöker vara så utförlig som möjligt.

Krav 4. Frågor
-----------------------

Frågor går att besvara, och den som har skrivit frågan kan då gå in och acceptera svar som då får sin bock grön, man kan även ångra ett accepterat svar. Enbart trådläsaren kan acceptera ett svar och andra läsare kan bara se om ett svar är accepterat eller inte. Man kan bara acceptera ett svar, accepterar man ytterligare ett avaccepteras de förra valet automatiskt då de var så jag tolkade uppgiften.

Alla frågor, svar och kommentarer som man inte har skrivit själv eller redan röstat på kan man rösta på genom antingen en uppåtpil eller nedåt pil, informationen om röstandet syns sedan på frågan, svaret eller kommentaren och de användare som skrivit dessa får poäng i sin rankning(karma) av dessa röster. 

Svaren på en fråga kan om de är mer än en fråga sorteras efter rank eller datum, om rank är det högst rank först och är det datum är det äldst först, denna funktion tänkte jag vidarutveckla så att man kan vända på listan vid dubbelklick men detta få bli ett senare projekt då tiden tog slut. Tänkte dessutom att ett accepterat svar ska ge viss rankning vid vidareutveckling då detta svar helt klart betyder ganska mycket för frågan.

Jag tolkade fråga som så att ranken som syns på indexsidan i forumet är enbart för frågan så det är så den fungerar nu, men jag tror det hade varit mer användbart om frågor med högt rankade svar hade fått högre rank också och detta är något jag tänker jobba vidare på senare.

Krav 5.Användare
-------------------------

Detta krav tyckte jag hände mycket ihop med ovanstående krav, mitt poäng system ser ut precis som de är beskrivet i uppgiften, användaren får poäng varje gång han frågar/kommenterar/svarar och varje gång någon röstar på hans inlägg får han antingen plus eller minuspoäng beroende på röstningen. 

I användarens översikt kan man se vilka frågor han har gjort, vilka frågor han har svarat på om dessa svar blivit accepterade och vilka frågor han har kommenterat och rankning på dessa. Dessutom kan man se hur många gånger han har röstat och hur många karma poäng han har lyckats skrapa ihop. 

Denna funktion skulle jag vilja utveckla vidare med att man uppfår olika status för hur många poäng man lyckats samla och om någon användare/fråga/svar/kommentar får mycket minuspoäng att detta ska leda till någon form av funktion så som borttagning av fråga, varningar etc. För poängsystem utan mål är ganska oanvändbara, i nu läget är det ju upp till varje användares måttstock att bedömma om något är bra eller dåligt, utan en vinst blir det inte så intressant att göra bra ifrån sig.

Krav 6. Layout
-----------------------

Under detta krav lägger jag in layouten, detta är inget som finns med i övriga krav för projektet men något som verkligen behövs för att få en välfungerande och användarvänlig sida, förutom uppbyggnaden av databasen är detta något av de mest tidskrävande på hela arbetet och till viss del fortfarande har viss retrokänsla över sig så är jag iaf nöjd med att den fick ett specifikt tema och att sidan både blev lätt navigerad och tillgänlig. Jag valde att dela upp koden i olika css mallar och importera dem i huvudmallen för att lättare kunna överståda, det kanske inte är optimalt men så länge hemsidan är så pass liten är det inget problem.

Detta moment har tagit mycket mer än 8 timmar men då jag tycker det är väldigt roligt att jobba med css har de inte varit något problem, det var också anledningen till att jag valde de tema jag gjorde till projektet för att kunna grotta ner mig ordentligt i css och utan css blir sidan väldigt svårläst med nästan utestutande massa länkar. 

Jag har inplementerat Font Awesome Icons för att på ett smidigt sätt lägga in iconer till länkarna, det enda som var kruxigt var att få rätt färg på dessa men de gjorde också att jag fick utveckla mina css-kunskaper ytterligare.

Nästa steg som jag vill vidareutveckla i layouten blir att skapa göra designen resonsiv så att den funkar för alla skärmar i dagsläget är den utveckad för att se bra ut på min bärbara mac med skärmstorlek 13".

1.3. Allmänt om projektets genomförande.
-------------------------------------------------

Jag tyckte instruktionerna var väldigt bra i detta projekt, även om det kanske var på gränsen till övermäktigt stort var det väldigt tydligt vad man skulle göra något som jag tyckte var svårt med i fjärde kursen(som jag slutförde före denna), svårighetsnivån låg också på en bra nivå, vilket faktiskt förvånade mig då jag har tyckte att tidigare kursmoment har varit extremt svåra, men här kunde jag lösa uppgiften även om jag hade en del strul påvägen som att mina tabeller blev så fulla och trasslade ihops sig till ett enda stort garn-nystan innan jag fick rätt på det hade jag nog börjat om ett antal gånger, sparade varje gång jag hade en stabil version på git som jag gick tillbaka till när jag trasslat till de ordentligt, det var till stor hjälp.

Hade jag gjort hela arbetet igen hade jag försökt bena ut mer vad som borde vara vart, tex har jag nog lite för mycket tagg-relaterat i question-kontroller som egentligen borde ligga i tagg-controller. Dessutom skulle jag vilja haft in mer i vote-klassen som det är nog genomsyrar detta system alla klasserna men tiden räckte tyvärr inte till till mer jobb på dessa områden.

1.4. Feedback och kursbetyg.
--------------------------------------

Detta var en extremt svår kurs, jag har med nästan varje kursmoment känt att jag inte riktigt har vetat hur jag ska lösa detta, vilket inte har varit något problem i någon av de andra tre kurserna i kurspaketet, till och med fjärde kursen var mycket lättare att hänga med i än denna. Dessutom har den varit väldigt tidskrävande att hinna med endast de grundläggande har oftast tagit mer än 20 timmar. Men det har varit en otroligt givande kurs och nu i efterhand känner jag att jag har lärt mig otroligt mycket och denna kurs har varit väldigt rolig och man har känt sig otroligt nöjd när man väl har lyckats lösa de svåra uppgifterna vilket i sig är väldigt givande. Dock skulle jag velat att artiklarna man ska jobba igenom med mos var lite enklare, till exempel vilken klass han skriver i var något jag fick lägga mycket energi att förstå, vilket förvisso var bra för de ökade min förståelse för MVC men det gjorde också att de tog minst dubbelt så lång tid att lösa uppgiften och jag kunde sällan lägga någon större tid på extra uppgifterna vilket är lite synd då jag gärna hade gjort mer än bara de jag behövt.

Jag skulle rekommendera kursen till någon som vill ha en utmaning och med riktigt hög studiemoral, någon annan har nog lätt att ge upp under tidens gång, när en kurs av denna kaliber är på distans kräver det mycket av sina studenter. 

Kursen får av mig en 8, ämnet kunde inte vara mer spännande men svårighetsnivån är lite för hög, även för mig som har läst IT sen 2012, men de jag tycker är de absolut bästa med dessa fyra kurser är hur uptodate de är, finns många kurser som inte blivit uppdaterade på många år vilket inte alls funkar i en så snabbt utvecklande branch som denna så de ska de har mycket credit för, skulle absolut rekomendera kurspaketet till alla som vill jobba med webb de har varit en otroligt spännande resa. 