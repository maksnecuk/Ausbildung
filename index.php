<?php
class Cat
{
    // Class properties
    private $name;         // String: cat's name
    private $color;        // String: cat's color
    private $DoB;          // String: birthdate
    private $size;         // Integer: size in cm
    private $weight;       // Float: weight in kg
    private $stomachAmount; // Current volume of food in the stomach
    private $cubicAmount;   // Max stomach capacity

    public function __construct($name = "", $color = "", $DoB = "", $size = 0, $weight = 0.5, $stomachAmount = 0)
    {
        $this->name = $name;
        $this->color = $color;
        $this->DoB = $DoB;
        $this->size = $size;
        $this->weight = $weight;

        // Randomize stomach size to make each cat unique (0.1 to 0.5 liters)
        $this->cubicAmount = rand(1,5)/10;
        $this->stomachAmount = $stomachAmount;
    }

    // Handles vocalization based on the cat's state
    private function makeASound(): void{
        if ($this->getIsHungry() === true)
        {
            // Loud meow implies urgency
            echo "[" . $this->name . "]: MEOOOW!!!". "<br>";
        } else
        {
            // Happy/Normal meow
            echo "[" . $this->name . "]: meow!". "<br>";
        }
    }

    // Displays the full current status of the cat
    public function showStatus(){
        $output = "";
        $output .= "[".$this->name."]:<br/>"."Farbe:".$this->color."<br/>"."Date of birth:".$this->DoB."<br/>"."Size:".$this->size."<br/>"."Gewicht:".$this->weight."kg<br/>";

        // check hunger status for output
        if ($this->getIsHungry() === true)
        {
            $output .= "hungrig <br/>";
        }
        else
        {
            $output .= "nicht hungrig <br/>";
        }
        return $output;
    }

    // Internal method to process eating.
    // Calculates the real amount eaten based on limits.
    private function eat(CatBowl $bowl,$quantity):void{
        $foodInBowl = $bowl->getQuantity();
        $freeSpaceInTheCat = $this->cubicAmount-$this->stomachAmount;

        // Logic: Cat eats the minimum of what is requested, what is in the bowl, or what fits in the stomach.
        $realEatenAmount = min($quantity, $foodInBowl, $freeSpaceInTheCat);

        // Update cat's state
        $this->weight=$this->getWeight()+$realEatenAmount;
        $this->stomachAmount +=$realEatenAmount;

        // Remove food from the bowl
        $bowl->toEmpty($realEatenAmount);
    }

    // Interaction method: Cat tries to play with another cat
    public function play(Cat $fellow):void{
        // 1. Check if too full
        if($this->getLevel()===100){
            echo "No, thank you, I'd rather sleep.";
            $this->sleep();
        }
        // 2. Check if too hungry
        elseif ($this->getIsHungry() === true){
            echo "I don't want to play. I want eat!";
        }
        // 3. Play and burn energy
        else{
            // Burning random 30-60% of stomach content
            $percent = rand(30, 60);
            $lostFood = ($this->stomachAmount * $percent) / 100;
            $this->energyConsumption($lostFood);
        }
    }

    // Internal sleep logic
    private function sleep():void{
        // Hungry cats can't sleep
        if($this->getIsHungry() === true){
            $this->makeASound();
        }
        else{
            // Sleeping burns less energy (10-30%)
            $percent = rand(10, 30);
            $lostFood = ($this->stomachAmount * $percent) / 100;
            $this->energyConsumption($lostFood);
        }
    }

    // Toilet logic
    private function defecate():void{
        // Cat won't go if stomach is almost empty
        if($this->getLevel()<=10){
            echo "I don't want to go to the toilet";
        }
        else{
            // Going to toilet reduces stomach content significantly
            $lostFood = ($this->stomachAmount * 4) / 100;
            $this->energyConsumption($lostFood);
        }
    }

    // Returns true if stomach is less than 20% full
    public function getIsHungry():bool{
        return $this->getLevel()<20;
    }

    // --- Getters and Setters ---

    public function setName(string $name):void{
        $this->name = $name;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getColor(): string{
        return $this->color;
    }

    public function getWeight():float{
        return $this->weight;
    }
    public function getSize():float{
        return $this->size;
    }

    public function getDoB():string{
        return $this->DoB;
    }

    // Helper to calculate stomach fullness in %
    private function getLevel():int{
        return $this->stomachAmount/$this->cubicAmount*100;
    }

    // Centralized method to handle weight/food reduction to avoid code duplication
    private function energyConsumption($value):void{
        $this->stomachAmount-=$value;
        $this->weight -=$value;

        // Safety check: stomach cannot be negative
        if($this->stomachAmount<=0){
            $this->stomachAmount=0;
            trigger_error("The value cannot be less than zero.");
        }

        // Safety check: minimum weight threshold
        if ($this->weight<=0.1){
            $this->weight=0.1;
            trigger_error("The value must be at least 0.1. If it's less than that, the cat dies.");
        }
    }
}

class CatBowl{
    private $cubicAmount;   // Current food amount
    private $cubicCapacity; // Max capacity in liters

    public function __construct(float $cubicAmount = 0, float $cubicCapacity = 0.3){
        $this->cubicAmount = $cubicAmount;
        $this->cubicCapacity = $cubicCapacity;
    }

    // Returns fullness percentage
    public function getLevel():int {
        return $this->cubicAmount/$this->cubicCapacity*100;
    }

    // Refills the bowl. Checks for overflow.
    public function refill($quantity){
        $this->cubicAmount+=$quantity;
        if($this->cubicCapacity<$this->cubicAmount){
            $this->cubicAmount=$this->cubicCapacity;
            trigger_error("The bowl was overflowing, with excess spilling over the edge. The current amount of food left in the bowl is:".$this->cubicAmount);
        }
    }

    public function getQuantity(): float
    {
        return $this->cubicAmount;
    }

    // Removes food from the bowl (e.g. when cat eats)
    public function toEmpty($quantity):void{
        $this->cubicAmount-=$quantity;
        // Basic validation
        if($this->cubicAmount<0){
            $this->cubicAmount=0;
            trigger_error("The value cannot be less than zero.");
        }
    }
}
echo "</pre>";
?>