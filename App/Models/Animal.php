<?php
namespace App\Models;

class Animal {
    private ?int $id;
    private string $name;
    private string $breed;
    private int $age;
    private string $status;

    public function __construct(?int $id, string $name, string $breed, int $age, string $status) {
        if ($age < 0) {
            throw new \InvalidArgumentException("Az életkor nem lehet negatív!");
        }
        $this->id = $id;
        $this->name = $name;
        $this->breed = $breed;
        $this->age = $age;
        $this->status = $status;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getBreed(): string { return $this->breed; }
    public function getAge(): int { return $this->age; }
    public function getStatus(): string { return $this->status; }

    // Setters
    public function setName(string $name): void { $this->name = $name; }
    public function setBreed(string $breed): void { $this->breed = $breed; }
    public function setAge(int $age): void {
        if ($age < 0) throw new \InvalidArgumentException("Az életkor nem lehet negatív!");
        $this->age = $age;
    }
    public function setStatus(string $status): void { $this->status = $status; }

    public function display(): string {
        return "Név: {$this->name} | Fajta: {$this->breed} | Életkor: {$this->age} év | Státusz: {$this->status}";
    }
}
?>
