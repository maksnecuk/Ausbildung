<pre>
<?php

class Cat {
    public $name;//String
    public $color; //String "black", "white", "red", " tabby"
	public $age; //date of birth e. g. "1997-11-21"
	public $size; //from head to the beginning of tail in cm
    public function eat() {
        echo "njom!";
    }
    public function makeASound() {
        print_r ( $this->name.":Miau! <br />"); 
    }
}

$cat = new Cat();
$cat->name = "Mrs. Treble";
$cat->color = "rot";
$cat->age = "2014-05-10";
$cat->size = 60;
/*echo "Name: $cat->name <br/> 
Color: $cat->color<br/> 
Age: $cat->age<br/> 
Size: $cat->size<br/> "; 

var_dump($cat->age);
var_dump($cat->name); */


var_dump($cat) ;
print_r($cat,"<br />");
$cat->makeASound();


$catFelix1 = new Cat();
$catFelix1->name = "Felix der 1 ";
$catFelix1->color = "black";
$catFelix1->age = "2014-05-10";
$catFelix1->size = 30;
$catFelix1->makeASound();


$catFelix2 = new Cat();
$catFelix2->name = "Felix der 2";
$catFelix2->color = "white";
$catFelix2->age = "2017-05-10";
$catFelix2->size = 70;
$catFelix2->makeASound()




?>
</pre>
