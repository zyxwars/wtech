# Semestrálny projekt - elektronický obchod

## Zadanie

Vytvorte webovú aplikáciu - eshop, ktorá komplexne rieši nižšie definované prípady použitia vo vami zvolenej doméne (napr. elektro, oblečenie, obuv, nábytok). Presný rozsah a konkretizáciu prípadov použitia si dohodnete s vašim vyučujúcim.

### Aplikácia musí realizovať tieto prípady použitia:

#### Klientská časť

-   zobrazenie prehľadu všetkých produktov z vybratej kategórie používateľom
-   základné filtrovanie (aspoň podľa 3 atribútov, napr. rozsah cena od-do, značka, farba)
-   stránkovanie
-   preusporiadanie produktov (napr. podľa ceny vzostupne/zostupne)
-   zobrazenie konkrétneho produktu - detail produktu
-   pridanie produktu do košíka (ľubovolné množstvo)
-   plnotextové vyhľadávanie nad katalógom produktov
-   zobrazenie nákupného košíka
-   zmena množstva pre daný produkt
-   odobratie produktu
-   výber dopravy
-   výber platby
-   zadanie dodacích údajov
-   dokončenie objednávky
-   umožnenie nákupu bez prihlásenia
-   prenositeľnosť nákupného košíka v prípade prihláseného používateľa
-   registrácia používateľa/zákazníka
-   prihlásenie používateľa/zákazníka
-   odhlásenie zákazníka

#### Administrátorská časť

-   prihlásenie administrátora do administrátorského rozhrania eshopu
-   odhlásenie administrátora z administrátorského rozhrania
-   vytvorenie nového produktu administrátorom cez administrátorské rozhranie
-   produkt musí obsahovať minimálne názov, opis, aspoň 2 fotografie
-   upravenie/vymazanie existujúceho produktu administrátorom cez administrátorské rozhranie

## Vybraná doména - Predaj gramofónových platní

V našom projekte sme si ako tému vybrali eshop s platňami. Každá platňa má jeden obrázok v obale a jeden detail cover artu. Platne sa dajú vyhladávať podľa časti názvu alebo podľa kategórie do ktorej patria (Pop, Rock, Indie, etc.). Následne sa dajú platne presnejšie filtrovať podľa rozsahu ceny, autora, jazyku, alebo rozsahu rokov vydania. Výsledky sa dajú zároveň zoradiť(Recommended, Price Lowest, Price highest). Každá kategória a platňa má aj popis.

## TODO: Diagram

### TODO: Zmeny v diagrame

## Návrhové rozhodnutia

### Laravel

Požadovaná technológia

### Postgres

Odporúčaný databázový systém

### Tailwind

Rozhodli sme sa použiť popri štandardnom css aj tailwind classes pre rýchlejšie iterovanie a kopírovanie častí kódu medzi views.

https://tailwindcss.com

### DaisyUI

Pre konzistentný vzhľad sme sa rozhodli použiť daisyUI. Používame daisyUI theme variables s custom farbami. Zároveň používame komponenty ako button, select a input. Tieto komponenty poskytujú quality of life features ako napríklad rýchle vyhladanie možnosti v select pomocou klávesnice.

https://daisyui.com

### Laravel Breeze

Na účely autentifikácie sme použili vybranú funkcionalitu s laravel breeze. Laravel breeze poskytuje stabilný základ postačujúci pre scope nášho projektu. Používame jednoduchý session model s rate limitingom pri opakovaných pokusoch o prihlásenie.

https://github.com/laravel/breeze

### Cart persistence

Pre neprihláseného zákazníka sa obsah košíka ukladá do session. Pre prihláseného zákazníka sa obsah košíka ukladá do databázy. Pri prihlásení sa obsah session košíka prekopíruje do databázy, ak je košík v databáze prázdny, inak sa session košík zahodí.

### TODO: roles handling, login etc. -->

## Implementácia prípadov použitia

### TODO: Zmena množstva pre daný produkt

### TODO: Prihlásenie

<!-- is admin -->

<!-- is customer -->

<!-- has cart items -->

### TODO: Vyhľadávanie

### TODO: Pridanie produktu do košíka

### TODO: Stránkovanie

### TODO: Základné filtrovanie

## Snímky obrazoviek

### Detail produktu

<img src="./detail.png" alt="detail" width="100%"/>
<img src="./detail-image.png" alt="detail image" width="50%"/>

### Prihlásenie

<img src="./login.png" alt="login" width="100%"/>

<img src="./login-failed.png" alt="login failed" width="50%"/>

### Homepage

<img src="./home.png" alt="home" width="100%"/>

### Nákupný košík s vloženým produktom

<img src="./cart.png" alt="cart" width="100%"/>

## Návod na spustenie (development mode)

### Runtimes

php version defined in <strong>composer.json</strong>\
node version defined in <strong>.nvmrc</strong>

### Dependencies

composer for php\
https://laravel.com/docs/12.x/installation#installing-php\
npm for node\
https://nodejs.org/en/download

```sh
composer install
npm install
```

### Create <strong>.env</strong>, use <strong>.env.example</strong> as a guide

#### Generate APP_KEY

https://laravel.com/docs/12.x/encryption

```sh
php artisan key:generate
```

#### Configure postgres connection in <strong>.env</strong>

```sh
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=record-store
DB_USERNAME=postgres
DB_PASSWORD=example
```

https://laravel.com/docs/12.x/database#configuration

### Symlink <strong>./storage/app/public</strong> to target directory <strong>./public/storage</strong>

https://laravel.com/docs/12.x/filesystem#the-public-disk

```sh
php artisan storage:link
```

### Migrate and seed database

```sh
php artisan migrate
php artisan db:seed
```

### Run

```sh
composer run dev
```

TODO: update product image sources

## Credits

### Category images

-   https://unsplash.com/photos/vinyl-record-wall-decor-6rGJQry0_WI
-   https://unsplash.com/photos/silhouette-of-people-raising-hands-6F5ct471oRk
-   https://unsplash.com/photos/black-and-blue-turntable-aivbDhWuFyw
-   https://unsplash.com/photos/a-hat-is-hanging-on-a-wooden-pole-1Je6CXMXHfU
-   https://unsplash.com/photos/man-carrying-with-people-mawOOCqXhrY
-   https://unsplash.com/photos/a-nintendo-wii-game-system-sitting-on-top-of-a-table-jDkFVfW1Ln8
-   https://unsplash.com/photos/man-holding-bottled-water-EUpUWc14Kks
-   https://unsplash.com/photos/music-group-performing-on-stage-with-empty-audience-seats-NsgsQjHA1mM
-   https://unsplash.com/photos/poster-lot-EWDCeCUz8Ho

### Banner image

-   https://unsplash.com/photos/an-aerial-view-of-a-boat-in-the-water-0yQPd95ScSc

### Product images

-   https://images.unsplash.com/photo-1547157233-48f320d15108?q=80&w=3924&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1723203331194-47d46a577c7d?q=80&w=3024&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1734779205618-30ee0220f56f?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDJ8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1743191771058-d06e793dda2d?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDN8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1744058588832-5a0cf779b215?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDh8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1743014379226-a3189c8f4a84?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDZ8Ym84alFLVGFFMFl8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1744132116976-0a68511b70f6?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDIyfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1732692699579-592f37bf4cdf?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDIzfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1744023018283-b1bbb84dd0df?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDI3fGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1743710426934-89887ca897d8?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDMzfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1742599968125-a790a680a605?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDQ4fGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1744726666136-7b923572a561?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDJ8cVBZc0R6dkpPWWN8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1744035522988-08bf64003759?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDd8cVBZc0R6dkpPWWN8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1744219792921-a74da6141822?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDV8cVBZc0R6dkpPWWN8fGVufDB8fHx8fA%3D%3D
-   https://images.unsplash.com/photo-1741888181508-851b1283ed8e?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDE2fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1736561609156-8e503d619ba9?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDE4fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1678811116814-26372fcfef1b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDIyfHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1719293846622-4101792a255d?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDI2fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1633668803757-40926829820b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDM5fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1743449661678-c22cd73b338a?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDM3fHFQWXNEenZKT1ljfHxlbnwwfHx8fHw%3D
-   https://images.unsplash.com/photo-1500964757637-c85e8a162699?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y292ZXJ8ZW58MHx8MHx8fDI%3D
-   https://images.unsplash.com/photo-1511367461989-f85a21fda167?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8Y292ZXJ8ZW58MHx8MHx8fDI%3D
-   https://images.unsplash.com/photo-1509114397022-ed747cca3f65?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y292ZXJ8ZW58MHx8MHx8fDI%3D
-   https://images.unsplash.com/photo-1438762398043-ac196c2fa1e7?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8Y292ZXJ8ZW58MHx8MHx8fDI%3D
-   https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1487088678257-3a541e6e3922?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1558376939-7d6cb3025d5c?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1509978778156-518eea30166b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjN8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1454817481404-7e84c1b73b4a?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjZ8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1563089145-599997674d42?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjR8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1470790376778-a9fbc86d70e2?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mjl8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1523867574998-1a336b6ded04?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzJ8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1520262494112-9fe481d36ec3?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzB8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1505274664176-44ccaa7969a8?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzV8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1590310051055-1079d8f48c89?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzh8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1489549132488-d00b7eee80f1?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzR8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1516900448138-898720b936c7?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzZ8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1494830723470-a8f5b3918a99?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzd8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1538113300105-e51e4560b4aa?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDF8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1615578731118-37d932b83555?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTF8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1525226456211-24affe06d7dc?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDV8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1610189808557-9051febb2cb8?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Njl8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1535157412991-2ef801c1748b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Njd8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1663042092427-fde6ca201ed0?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8ODB8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1589689342466-81889bcd7e67?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8ODF8fGNvdmVyfGVufDB8fDB8fHwy
-   https://images.unsplash.com/photo-1654647382270-83a08c49e75b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OTV8fGNvdmVyfGVufDB8fDB8fHwy
