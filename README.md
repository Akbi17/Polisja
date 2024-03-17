Wprowadzenie
Projekt Polisja jest platformą ubezpieczeniową, która umożliwia użytkownikom ubezpieczanie samochodów, życia, nieruchomości oraz biznesów. Został zaprojektowany z myślą o zapewnieniu wygodnego i łatwego w obsłudze interfejsu zarówno dla klientów, jak i administratorów.

Funkcje
Rejestracja i logowanie użytkowników
Ubezpieczanie samochodów, życia, nieruchomości oraz biznesów
Panel administracyjny do zarządzania użytkownikami, polisami ubezpieczeniowymi, produktami ubezpieczeniowymi itp.
Wyszukiwanie, przeglądanie i edycja istniejących polis ubezpieczeniowych


Technologie użyte
Symfony 6
MySQL
Docker


Wymagania systemowe
Docker: Instalacja Docker
Docker Compose: Instalacja Docker Compose


Instalacja i uruchomienie

Sklonuj repozytorium:
git clone https://github.com/nazwa_uzytkownika/polisja.git

Uruchom kontenery Docker:
docker-compose up -d

Zainstaluj zależności PHP:
docker-compose exec php composer install

Załaduj schemat bazy danych:
docker-compose exec php php bin/console doctrine:migrations:migrate

Otwórz przeglądarkę i przejdź do:
http://localhost:8000