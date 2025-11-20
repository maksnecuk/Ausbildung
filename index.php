<?php
//test2
// ==========================================
// Aufgabe 4, 6: Клас кота + makeASound() з ім'ям кота
// ==========================================
class Cat {
    public $name;   // String
    public $color;  // String "black", "white", "red", "tabby"
    public $age;    // Пр.: "2014-05-10"
    public $size;   // В сантиметрах
    public $isHungry ; // Boolean 

    public function eat() {
        echo "njom!";
    }

    // Aufgabe 4 + Aufgabe 6
    public function makeASound() {
        if ($this->isHungry == true) {
        echo  $this->name . ": MEOWW!\n";
        }
        else {
            echo $this->name. "meow!\n";}
    }
}

// Початок <pre> для зручного виводу — Aufgabe 3
//echo "<pre>";


// ==========================================
// Aufgabe 2: Вивід властивостей (ім’я та розмір) через echo та var_dump
// ==========================================
$cat = new Cat();
$cat->name = "Mrs. Treble";
$cat->color = "rot";
$cat->age = "2014-05-10";
$cat->size = 60;   // Без лапок — як вимагає задача
$cat->isHungry = false;


echo "===== echo =====\n";
echo $cat->name."\n";
echo $cat->size."\n";

echo "===var_dump()===\n";
 var_dump($cat->name);
 var_dump($cat->size);


// ==========================================
// Aufgabe 3: Вивести весь об’єкт трьома функціями
// ==========================================
echo "=== echo (не працює для об'єктів) ===\n";
//echo $cat;  // дасть помилку/попередження

echo "\n=== print_r() ===\n";
print_r($cat);

echo "\n=== var_dump() ===\n";
var_dump($cat);


// Виклик методу
$cat->makeASound();


// ==========================================
// Aufgabe 5: Створити двох котів Felix 1 і Felix 2 та змусити їх нявкати
// ==========================================
$catFelix1 = new Cat();
$catFelix1->name = "Felix der 1.";
$catFelix1->color = "black";
$catFelix1->age = "2014-05-10";
$catFelix1->size = 30;
$catFelix1->isHungry = true;
$catFelix1->makeASound();


$catFelix2 = new Cat();
$catFelix2->name = "Felix der 2.";
$catFelix2->color = "white";
$catFelix2->age = "2017-05-10";
$catFelix2->size = 70;
$catFelix2->isHungry = false;
$catFelix2->makeASound();


echo "</pre>";

?>