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
        if($this->getSize()<10){
            $this->size=10;
            trigger_error("size is too small");
        }
        $this->weight = $weight;
        if($this->getWeight()<0.1){
            $this->weight=0.1;
            trigger_error("weight is too small");
        }

        // Randomize stomach size to make each cat unique (0.1 to 0.5 liters)
        $this->cubicAmount = rand(1,5)/10;
        $this->stomachAmount = $stomachAmount;
    }

    // Handles vocalization based on the cat's state
    private function makeASound(): void{
        if ($this->getIsHungry() === true)
        {
            // Loud meow implies urgency
            echo "[" . $this->getName() . "]: MEOOOW!!!". "<br>";
        } else
        {
            // Happy/Normal meow
            echo "[" . $this->getName(). "]: meow!". "<br>";
        }
    }

    // Displays the full current status of the cat
    public function showStatus(){
        $output = "";
        $output .= "[".$this->getName()."]:<br/>"."Farbe:".$this->getColor()."<br/>"."Date of birth:".$this->getDoB()."<br/>"."Size:".$this->getSize()."<br/>"."Weight:".$this->getWeight()."kg<br/>";

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
    public function eat(CatBowl $bowl,$quantity):void{
        $foodInBowl = $bowl->getQuantity();
        $freeSpaceInTheCat = $this->getCubicAmount()-$this->getStomachAmount();

        // Logic: Cat eats the minimum of what is requested, what is in the bowl, or what fits in the stomach.
        $realEatenAmount = min($quantity, $foodInBowl, $freeSpaceInTheCat);

        // Update cat's state
        $this->setWeight($this->getWeight()+$realEatenAmount);
        $this->setStomachAmount($this->getStomachAmount()+$realEatenAmount);

        // Remove food from the bowl
        $bowl->toEmpty($realEatenAmount);
    }

    // Interaction method: Cat tries to play with another cat
    public function play(Cat $fellow = null):void{
        // 1. Check if too full
        if($this->getLevel()>=99){
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
            $lostFood = ($this->getStomachAmount() * $percent) / 100;
            $this->energyConsumption($lostFood);
            if($fellow!==null){
                $fellow->play();
            }
        }
    }

    // Internal sleep logic
    public function sleep():void{
        // Hungry cats can't sleep
        if($this->getIsHungry() === true){
            $this->makeASound();
        }
        else{
            // Sleeping burns less energy (10-30%)
            $percent = rand(10, 30);
            $lostFood = ($this->getStomachAmount() * $percent) / 100;
            $this->energyConsumption($lostFood);
        }
    }

    // Toilet logic
    public function defecate():void{
        // Cat won't go if stomach is almost empty
        if($this->getLevel()<=10){
            echo "I don't want to go to the toilet";
        }
        else{
            // Going to toilet reduces stomach content significantly
            $lostFood = ($this->getStomachAmount() * 4) / 100;
            $this->energyConsumption($lostFood);
        }
    }

    // Returns true if stomach is less than 20% full
    private function getIsHungry():bool{
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

    private function getStomachAmount():float
    {
        return $this->stomachAmount;
    }
    private function getCubicAmount(){
        return $this->cubicAmount;
    }
    private function setStomachAmount(float $stomachAmount):void{
        $this->stomachAmount = $stomachAmount;
        if($this->getStomachAmount()<0){
            $this->stomachAmount=0;
            trigger_error("there cannot be less than zero food in the stomach");
        }
        elseif ($this->getStomachAmount()>$this->getCubicAmount()){
            trigger_error("stomach amount is too small");
            $this->setStomachAmount($this->getCubicAmount());
        }
    }
    private function setWeight(float $weight):void{
        $this->weight = $weight;
        if($this->getWeight()<0.1){
            trigger_error("weight cannot be less than 0.1kg");
        }
    }

// Helper to calculate stomach fullness in %
    private function getLevel():int{
        return $this->getStomachAmount()/$this->getCubicAmount()*100;
    }

    // Centralized method to handle weight/food reduction to avoid code duplication
    private function energyConsumption($value):void{
        $this->setStomachAmount($this->getStomachAmount()-$value);
        $this->setWeight($this->getWeight()-$value);
    }
}

class CatBowl {
    private $cubicAmount;   //Current amount of food
    private $cubicCapacity; //Maximum volume

    public function __construct(float $cubicAmount = 0, float $cubicCapacity = 0.3) {
        $this->cubicAmount = $cubicAmount;
        $this->setCubicCapacity($cubicCapacity);
    }

    public function getLevel(): int {
        if ($this->cubicCapacity === 0) return 0;
        return ($this->cubicAmount / $this->cubicCapacity) * 100;
    }
    public function refill($quantity) {
        $this->cubicAmount += $quantity;

        if ($this->getCubicCapacity() < $this->getQuantity()) {
            $this->refill($this->getCubicCapacity());

            trigger_error("The bowl was overflowing! Excess food spilled.");
        }
    }

    public function getQuantity(): float {
        return $this->cubicAmount;
    }

    public function getCubicCapacity(): float {
        return $this->cubicCapacity;
    }
    public function toEmpty($quantity): void {
        $this->cubicAmount -= $quantity;
        if ($this->cubicAmount < 0) {
            $this->cubicAmount = 0;
            trigger_error("The bowl is already empty.");
        }
    }
    private function setCubicCapacity(float $cubicCapacity): void {
        if ($cubicCapacity <= 0) {
            trigger_error("Cubic capacity is too small/invalid. Setting to default 0.3");
            $this->cubicCapacity = 0.3;
        } else {
            $this->cubicCapacity = $cubicCapacity;
        }
    }
}
echo "</pre>";
?>