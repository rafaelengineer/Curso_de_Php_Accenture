<?php
function generateRandomNumbers()
{
    $numbers = array();
    
    for ($i = 0; $i < 6; $i++) {
        $numbers[] = mt_rand(0, 59);
    }
    
    return $numbers;
}
$randomNumbers = generateRandomNumbers();
//print_r($randomNumbers);

$numbers = array();

for ($i = 0; $i < 6; $i++) {
    $inputValue = (int) readline("Enter number " . ($i + 1) . ": ");
    $numbers[] = $inputValue;
}

print_r($numbers);

function compareArrays($array1, $array2) {

    for ($i = 0; $i < 6; $i++) {
        if ($array1[$i] !== $array2[$i]) {
            return false;
        }
    }
    
    return true;
}
if (compareArrays($numbers, $randomNumbers))
    echo "Você é o mais novo milionário!!!";
    else echo "Continue dando chances a sua sorte!"

?>