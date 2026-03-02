<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <pre>
<?php
    echo "Output:\n\n";

    $grocery_list = array(
        array("desc" => "ITEM 1", "qty" => 2, "amt" => 100),
        array("desc" => "ITEM 2", "qty" => 7, "amt" => 35),
        array("desc" => "ITEM 3", "qty" => 1, "amt" => 350),
        array("desc" => "ITEM 4", "qty" => 2, "amt" => 20),
    );

    $overallTotal = 0;

    echo str_pad("QTY", 6) . str_pad("DESC", 12) . str_pad("AMT", 12) . "Total\n";
    echo "------------------------------------------\n";

    foreach ($grocery_list as $item) {
        
        $itemTotal = $item['qty'] * $item['amt']; 
        $overallTotal += $itemTotal;

        foreach ($item as $key => $value) {
            if ($key == "qty") {
                echo str_pad("(" . $value . ")", 6);
            } elseif ($key == "desc") {
                echo str_pad($value, 12);
            } elseif ($key == "amt") {
                echo str_pad($value, 12);
            }
        }

        echo $itemTotal . "\n";
    }

    echo "------------------------------------------\n";
    echo str_pad("Overall Total", 30) . "Php " . $overallTotal;
?>
    </pre>

</body>
</html>