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

---

### 3.1 App/Models/Animal.php
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