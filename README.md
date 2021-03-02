# Trello_copy

## Struktura katalogów
- .docker
	Katalog z którego są importowane ustawienia serwerów i kontenerów.
- react_www 
	Katalog z którego jest hostowany front end aplikacji 
- www 
	Katalog z którego jest hostowany back end aplikacji.
	

## Architektura:

Aplikacja korzysta z architektury mikro serwisów który jest systemem rozproszonym czyli ten system może składać się z setek mini aplikacji które są ze sobą powiązanych i które korzystają z siebie nawzajem . Można tu podać przykład naszej aplikacji która bazuje na takiej architekturze. Mamy takie kontenery w których znajduje się back end (PHP,Laravel) front end (React) Baza danych (MySql) plus ewentualne narzędzia które  są rozbite na kontenery lub tymczasowo zainstalowane na danej instancji na potrzebę developmentu.



## Jak odpalić środowisko ?
1. Klonujemy repozytorium z brancha Docker
2. Klonuje repozytorium z brancha laravel to katalogu www
3. Przechodzimy do katalogu z sklonowanym repozytorium
4. `$ docker compose up`
5. `$ docker exec -it laravel /bin/bash`
6. `$ cd /var/www`
7. `$ composer install`
8. `$ cp .env.example .env`
9. `$ php artisan key:generate`
10. `$ chmod -R 777 storage` 
11.`$ php artisan migrate:refresh --seed` 
12. Gotowe 
## Dostępne kontenery:
- PHP (laravel + narzędzia) Port:  2220:22 (SSH)
	Dane do logowania:
	root
	root
- Nginx (host back-end) Port: 8180:80 (www)
- Nginx (host front-end) Port: 8185:80 (www)
- Mysql (baza danych aplikacji) Port : 3315:3306 
- Phpmyadmin (narzędzie) Port: 8181:80 (www)
