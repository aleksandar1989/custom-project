Zainstaliciju je potrebno:

 >=7 PHP verzija
instaliran composer

Skinuti projekat sa git-a
Napraviti bazu i podesiti podatke za bazu u .env fajlu
Izvrsiti komande:
    php artisan migrate:refresh --seed
    composer update
    
U .env fajlu podesiti temu sajta, default je laracus, dodati u env:
DEFAULT_THEME=laracus