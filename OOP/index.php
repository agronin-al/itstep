<?php
class men extends hands
{
    var $weight;
    var $height;
    var $age = 0;
    var $name;
    static $color = 'white';
    const isHead = true;

    function eat($food)
    {
        //eat food
    }
    function drink($amount)
    {
        //drink $amount of water
    }
    function happyBD()
    {
        $this->age++;
        echo self::isHead;
    }
}

$vasia = new men();
$vasia->name = 'Vasia';
$vasia->color = 'yello';
$vasia->happyBD();

echo "People are usually birth" . men::$color . "color";

function __construct ($name){
    $this->weight = 3500;
    $this->height = 4;
    $this->$name;
}

function __destruct(){

}


class hands
{
    var $fingers_count = 10;
    var $isHair = false;
    function shaper($object){

    }

}