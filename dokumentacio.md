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