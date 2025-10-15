# Dokumentáció – Állatörökbefogadó Nyilvántartó Parancssori Alkalmazás (PHP + MySQL)

## 1. Bevezetés
Az alkalmazás célja, hogy egy állatmenhely örökbefogadásra váró állatainak nyilvántartását támogassa.  
Segítségével az állatok adatai (név, fajta, életkor, örökbefogadási státusz) könnyen kezelhetők. Az alkalmazás parancssorból (CLI) futtatható, és teljes CRUD (Create, Read, Update, Delete) funkcionalitást biztosít.

A rendszer objektumorientált PHP nyelven készült, MySQL adatbázist használ az adatok tárolására, és a kód MVC-szerű szerkezetet követ:

- **Model** – az adatok reprezentációja (`Animal.php`)  
- **Service / Manager** – az adatkezelés logikája (`AnimalManager.php`)  
- **Controller / Index** – a parancssori interfész (`index.php`)

---

## 2. Célkitűzés
- Objektumorientált szemlélet gyakorlása PHP-ben  
- MVC-szerű rétegzett struktúra kialakítása  
- Parancssori alkalmazás fejlesztése valós adatbázis-kezeléssel  
- Hibakezelés és adatok érvényesítése  

---

## 3. Fájlszerkezet és rövid leírás

### 3.1 index.php
**Leírás:** A belépési pont, amely a parancssori argumentumokat kezeli, kapcsolatot létesít az adatbázissal és a `AnimalManager` szolgáltatáson keresztül végrehajtja a CRUD műveleteket.  
**Funkciók:**
- Adatbázis kapcsolat létrehozása PDO-val  
- Tábla létrehozása, ha még nem létezik (`animals`)  
- Parancssori argumentum feldolgozás:
  - `list` – az összes állat kilistázása  
  - `add` – új állat felvétele  
  - `edit` – meglévő állat adatainak módosítása  
  - `delete` – állat törlése  
- A parancsok hívják a `AnimalManager` megfelelő metódusait  

---

### 3.2 App/Models/Animal.php
**Leírás:** Az `Animal` osztály reprezentálja az adatbázisban tárolt állatot.  
**Attribútumok:**
- `id` – az állat egyedi azonosítója  
- `name` – állat neve  
- `breed` – állat fajtája  
- `age` – életkor (év)  
- `status` – örökbefogadási státusz  

**Metódusok:**
- Konstruktor: ellenőrzi, hogy az életkor nem negatív  
- Getters és Setters: minden attribútumhoz, az életkor módosítása érvényesítéssel  
- `display()` – formázott szöveges megjelenítés a CLI-hez  

---

### 3.3 App/Services/AnimalManager.php
**Leírás:** A `AnimalManager` osztály végzi a CRUD műveleteket az `animals` táblán.  
**Metódusok:**

- `__construct(PDO $pdo)` – adatbázis kapcsolat beállítása  
- `addAnimal(Animal $animal)` – új állat beszúrása  
- `listAnimals()` – az összes állat kilistázása, formázott CLI megjelenítéssel  
- `editAnimal(int $id, array $data)` – állat adatainak módosítása; csak megadott mezőket frissít  
- `deleteAnimal(int $id)` – állat törlése az ID alapján  

**Hibakezelés:**
- Ellenőrzi a negatív életkort  
- Ellenőrzi a létező ID-t a módosítás és törlés esetén  
- Figyelmeztet, ha nincs módosítandó adat vagy az ID nem található  

---

### 3.2 App/Services/AnimalManager.php
**Leírás:** A `AnimalManager` osztály végzi a CRUD műveleteket az `animals` táblán.  
**Metódusok:**

- `__construct(PDO $pdo)` – adatbázis kapcsolat beállítása  
- `addAnimal(Animal $animal)` – új állat beszúrása  
- `listAnimals()` – az összes állat kilistázása, formázott CLI megjelenítéssel  
- `editAnimal(int $id, array $data)` – állat adatainak módosítása; csak megadott mezőket frissít  
- `deleteAnimal(int $id)` – állat törlése az ID alapján  

**Hibakezelés:**
- Ellenőrzi a negatív életkort  
- Ellenőrzi a létező ID-t a módosítás és törlés esetén  
- Figyelmeztet, ha nincs módosítandó adat vagy az ID nem található  

---