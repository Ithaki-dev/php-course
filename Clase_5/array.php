<?php
    function addTwo($y) {
        $y = $y + 2;
        echo $y;
    }
    $x = 10;
    addTwo($x);
    echo "<br>";
    echo $x;

    echo "<br>";
    function addThree(&$y) {
        $y = $y + 3;
        echo $y;
    }
    $x = 10;
    addThree($x);
    echo "<br>";
    echo $x;
    echo "<br>";

    function makecoffee($type = "cappuccino") {
        return "Making a cup of $type.\n";
    }
    echo makecoffee();
    echo makecoffee(null);
    echo makecoffee("espresso");

    echo "<br>";

    $message = "Hello, World!";
    $example = function($m){
        var_dump($m);
    };
    echo $example($message);
?>