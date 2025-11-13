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
print_r($cat);
?>
</pre>
