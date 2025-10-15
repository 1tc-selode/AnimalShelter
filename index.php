<?php

spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use App\Models\Animal;
use App\Services\AnimalManager;


$dbHost = 'localhost';
$dbName = 'animal_shelter_db';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Sikeres adatbázis-kapcsolat.\n";
} catch (PDOException $ex) {
    die("Hiba az adatbázis-kapcsolatban: " . $ex->getMessage());
}


$sql = "
    CREATE TABLE IF NOT EXISTS animals (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        breed VARCHAR(255) NOT NULL,
        age INT NOT NULL,
        status VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL
    ) ENGINE=InnoDB;
";
$pdo->exec($sql);

$manager = new AnimalManager($pdo);


$action = $argv[1] ?? 'list';

switch ($action) {
    case 'list':
        $manager->listAnimals();
        break;

    case 'add':
        $data = [
            'name' => $argv[2] ?? 'Ismeretlen',
            'breed' => $argv[3] ?? 'keverék',
            'age' => (int)($argv[4] ?? 1),
            'status' => $argv[5] ?? 'Örökbefogadható'
        ];
        $animal = new Animal(null, $data['name'], $data['breed'], $data['age'], $data['status']);
        $manager->addAnimal($animal);
        break;

    case 'edit':
        $id = (int)($argv[2] ?? 0);
        $data = [];
        for ($i = 3; $i < count($argv); $i++) {
            if (strpos($argv[$i], '--') === 0) {
                $parts = explode('=', substr($argv[$i], 2), 2);
                if (count($parts) === 2) {
                    $data[$parts[0]] = trim($parts[1], '"');
                }
            }
        }
        $manager->editAnimal($id, $data);
        break;

    case 'delete':
        $id = (int)($argv[2] ?? 0);
        $manager->deleteAnimal($id);
        break;

    default:
        echo "Ismeretlen parancs. Használat: php index.php [list|add|edit|delete]\n";
        break;
}

echo "--- A művelet véget ért ---\n";
?>