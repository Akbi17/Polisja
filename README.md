### lista todo

- pliki migration nie działają po zainicjowaniu bazy danych - podejrzewam że w ogóle nie są potrzebne, ale do tego jeszcze nie doszedłem pisząc to zdanie
- czemu nie ma ściezki / root w kontrolerach? na co ja mam wejść żeby widzieć stronę główną?
- klik w logo - index.html nie istnieje
- logo dalej wygląda na ściśnięte, poprawiałeś wymiar wysokości?
- najazd na logo nic nie robi z pustą przestrzenią po prawej, tak miało być? coś tu brakuje
- pierwsza sekcja pod logo większy padding od góry, jest 25px, daj 30px i czuje że bedzie wyglądać lepiej - ale to ogólnie nie jest konieczne, możesz olać jak uważasz inaczej
- ikonki nie pasują do usług, oc/ac a tu laptop? oc/ac = samochód, dom = dom, życie = serduszko, firma = budynek albo coś - jak w logo
- sekcja pod sekcją z ikonkami, czemu ma customowe style? "Interesuje cię oferta ubezpieczeniowa" - ma być użyta sekcja z templaty, klient za nią zapłacił
- kolejna sekcja jest rozjechana i wygląda jak kupa - mam wrażenie że nie rozumiesz o co chodzi z klasami md-7 i tym podobne - źle skopiowałeś sekcje z templaty
- ten laptop musimy wymienić chyba na jakąś inną grafikę obok tej sekcji z opiniami
- w stopce copyright 2014?
- w stopce po opisie "zobacz więcej" ?? do wywalenia
- ogólnie stopka jest super, bardzo mi się podoba
- coś złapało dolny suwak, tzn że jakiś element się rozpycha na stronie
- formularz dom - ostatnie pole to data, całkowicie źle sformatowany, albo date picker jakiś tam powinien być albo popraw to na 3 inputy, albo nie wiem co, ale tak być nie może na pewno
- formularz dom - czemu pierwszy input jest na pół strony a reszta na full?
- formularz życie - to samo, datepicker albo coś ładniejszego, to jest do bani, najlepiej wyobraź sobie że jesteś klientem i jakbyś chciał wprowadzić date? jakoś wygodnie chyba
- formularz bizness (przez dwa ss) - to samo, datepicker albo coś
- widok kontakt - plus minus mapy wchodzi pod menu, tzn że cała mapa wchodzi pod menu, źle zagnieżdżona
- widok kontakt - wyświetl większą mapę? albo do wywalenia albo do ładniejszego ostylowania
- widok kontakt - labele formularza są po angielsku

## teraz kod

- widok register powinien być nazwany install - a dwa powinien być niedostępny po utworzeniu użytkownika i jest tam jakiś bajzel, bez styli i ten formularz z tymi stronami do zapisu
- dashboard znów tralalala, coś tam można wymyślić albo zostawić notkę że coś tu można wymyślić
- widok w adminie - webPage - co to jest i czemu nie działa? biały ekran, brak błędów
- brakuje konfigów do smtp do formularza kontaktowego - możliwe że mówiłem na sztywno ale ogólnie tez można tutaj coś wklepać, albo jakieś inne dane - nie jest konieczne, można na sztywno, jak uważasz - do ew. przedyskutowania
- brakuje edycji userów admina
- filed nameOfBusiness ?? - companyName po prostu
- wszelkie zapisy do bazy danych czy wysyłka maila w procesie użytkownika muszą być w try catch, inaczej klient zobaczy błąd w razie problemów, a ma zobacyzć komunikat że coś poszłom nie tak spróbuj później - praktycznie wszędzie
- admin config - routing stworzony ale nie uzywany
- auto controller - success message i error message na raz xD usunąłem już error message
- routing auto można by zmienić już na samochod albo coś skoro routingu są po polsku - a najlepiej to pomyśleć o routingach seo friendly czyli np ubezpieczenie-samochodu albo coś takiego oc-ac-samochod, nie wiem
- okazuje się że block webpageadmin nie był używany nawet, niby zaimplementowany ale to co zwracał nigdzie nie było użyte
- cały ten webpageadmin to nie wiem po co? włącznik wyłącznik stron? mocno niedokończony
- $typeOfHouse ?? houseType / homeType / propertyType albo po prostu type skoro jestesmy już w obiekcie property
- co to jest carmake i caryear? dwa troche niepotrzebnie drążymy temat samochodów - zastanawiam się, tam po prostu ma wjechać inny formularz
- dateOfBirth - birthdate ?? 
- 'Comprehensive' => 'comprehensive', 'Third Party' => 'third_party', - co to za wybór dziwny?
