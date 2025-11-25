<?php
// ==========================================
// Cat class with properties and behavior
// ==========================================
class Cat {
    public $name;         // String: cat's name
    public $color;        // String: cat's color
    public $age;          // String: birthdate or age info
    public $size;         // Integer: size in cm (must be without quotes)
    public $isHungry; // Boolean: hunger state (default: hungry)
    public $weight = 0.5;    // Float: default newborn weight in kg

    public function __construct($name = "", $color = "", $age = "", $size = 0, $isHungry = true, $weight = 0.5) {
        $this->name = $name;
        $this->color = $color;
        $this->age = $age;
        $this->size = $size;
        $this->isHungry = $isHungry;
        $this->weight = $weight;

    }

    // Simple eating method
    public function eat() {
        echo "njom!";
    }

    // Makes a sound depending on hunger state
    public function makeASound() {
        if ($this->isHungry === true) {
            // Loud meow if hungry
            echo "[" . $this->name . "]: MEOOOW!!!". "<br>";
        } else {
            // Normal meow if not hungry; becomes hungry afterwards
            echo "[" . $this->name . "]: meow!". "<br>";
            $this->isHungry = true;
        }
    }
    
    // Prints full status of the cat
    public function showStatus() {
       $output = "";
       $output .= "[".$this->name."]:<br/>"."Farbe:".$this->color."<br/>"."Age:".$this->age."<br/>"."Size:".$this->size."<br/>"."Gewicht:".$this->weight."kg<br/>";
       if ($this->isHungry === true) {
           $output .= "hungrig <br/>";
       }
       else{
           $output .= "nicht hungrig <br/>";
       }
       return $output;


        /* echo "<br>";
        echo "[" . $this->name . "]";
        echo "<br>";
        echo "Farbe: " . $this->color;
        echo "<br>";
        echo "Age: ".$this->age;
        echo "<br>"; 
        echo "Size:". $this->size;
        echo "<br>";
        echo "Gewicht: " . $this->weight . " kg";
        echo "<br>";
        echo "isHungry: " . $this->isHungry;
        echo "<br>";  */
    }
}

// ==========================================
// Aufgabe 2: Output properties using echo() and var_dump()
// ==========================================
$cat = new Cat("","","",);
$cat->name = "Mrs. Treble";
$cat->color = "rot";
$cat->age = "2014-05-10";
$cat->size = 60;      // Must be without quotes
$cat->isHungry = false;

echo "===== echo =====". "<br>";
echo $cat->name ."<br>";
echo $cat->size ."<br>";

echo "=== var_dump() ==="."<br>";
var_dump($cat->name."<br>");
var_dump($cat->size);
var_dump($cat->isHungry);
var_dump($cat->weight);


// ==========================================
// Aufgabe 3: Output entire object with echo/print_r/var_dump
// ==========================================
echo "\n=== echo (does not work for objects) ===\n". "<br>";
// echo $cat; // would cause an error

echo "\n=== print_r() ===\n". "<br>";
print_r($cat, )."<br>";

echo "\n=== var_dump() ===\n". "<br>";
var_dump($cat,"<br>");


// Call the method to test sound
$cat->makeASound();


// ==========================================
// Aufgabe 5: Create Felix 1 and Felix 2 and let them meow
// ==========================================
$catFelix1 = new Cat();
$catFelix1->name = "Felix der 1.";
$catFelix1->weight = 2.3;
$catFelix1->color = "black";
$catFelix1->age = "2014-05-10";
$catFelix1->size = 30;
$catFelix1->isHungry = true;
//$catFelix1->makeASound();

$catFelix2 = new Cat();
$catFelix2->name = "Felix der 2.";
$catFelix2->color = "white";
$catFelix2->age = "2017-05-10";
$catFelix2->size = 70;
$catFelix2->isHungry = false;
//$catFelix2->makeASound();


// ==========================================
// Aufgabe 10: Show status of all properties
// ==========================================
echo "====== Aufgabe 10 ======". "<br>";
echo $catFelix1->showStatus();
echo $catFelix2->showStatus();
echo"<Br/>";
$aboba = new Cat("aboba", "braun", 3, 30, false, 0.5 );
echo $aboba->showStatus();
echo "</pre>";
?>
