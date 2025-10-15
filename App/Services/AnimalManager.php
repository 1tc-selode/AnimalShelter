<?php
namespace App\Services;

use App\Models\Animal;
use PDO;

class AnimalManager {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addAnimal(Animal $animal): void {
        $stmt = $this->pdo->prepare("
            INSERT INTO animals (name, breed, age, status)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $animal->getName(),
            $animal->getBreed(),
            $animal->getAge(),
            $animal->getStatus()
        ]);
        echo "Állat sikeresen hozzáadva az adatbázishoz.\n";
    }

    public function editAnimal(int $id, array $data): void {
        if ($id <= 0) {
            echo "Hibás ID.\n";
            return;
        }
        if (empty($data)) {
            echo "Nincs megadva módosítandó adat.\n";
            return;
        }

        $set = [];
        $params = [];
        foreach ($data as $key => $value) {
            $set[] = "{$key} = ?";
            $params[] = $value;
        }
        $params[] = $id;

        $sql = "UPDATE animals SET " . implode(', ', $set) . ", updated_at = NOW() WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $success = $stmt->execute($params);

        if ($success && $stmt->rowCount() > 0) {
            echo "A(z) {$id}. állat adatai sikeresen frissítve.\n";
        } else {
            echo "Nem történt módosítás.\n";
        }
    }

    public function deleteAnimal(int $id): void {
        if ($id <= 0) {
            echo "Hibás ID.\n";
            return;
        }
        $stmt = $this->pdo->prepare("DELETE FROM animals WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            echo "A(z) {$id}. állat sikeresen törölve.\n";
        } else {
            echo "Nem található ilyen ID-jű állat.\n";
        }
    }
}
?>
