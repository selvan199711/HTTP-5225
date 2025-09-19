<?php

$number = rand(1, 1000);

if ($number % 3 == 0 && $number % 5 == 0) {
    $magic = "FizzBuzz";
} elseif ($number % 3 == 0) {
    $magic = "Fizz";
} elseif ($number % 5 == 0) {
    $magic = "Buzz";
} else {
    $magic = $number; 
}

echo "<h2>Welcome to the Magic Number Game!</h2>";
echo "<p>The random number is: <strong>$number</strong></p>";
echo "<p>The magic number is: <strong>$magic</strong></p>";
?>
