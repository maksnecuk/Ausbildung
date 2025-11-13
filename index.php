<?php

class Cat {
    public $name;
    public $color;
	public $age;
	public $size;
    public function eat() {
        echo "njom!";
    }


   /* public function getName ($name){
        $this->name = readline("Введи ім'я кота: ");
        
    } */
}




$cat = new Cat();
/*$cat->getName($cat);
echo "Ім'я кота: " . $cat->name . "\n";*/
$cat->name = "Mrs. Treble";
$cat->color = "rot";
$cat->age = 10;
$cat->size = "medium";
echo "Name: $cat->name <br/> 
Color: $cat->color<br/> 
Age: $cat->age<br/> 
Size: $cat->size<br/> "; 
