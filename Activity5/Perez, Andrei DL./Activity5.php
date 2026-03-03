<?php

function generateReceipt($items) {
    $overallTotal = 0;

    echo str_pad("QTY", 6) . str_pad("DESC", 10) . str_pad("AMT", 8, " ", STR_PAD_LEFT) . str_pad("Total", 10, " ", STR_PAD_LEFT) . "\n";
    echo "------------------------------------\n";

    foreach ($items as $item) {
        $lineTotal = $item['qty'] * $item['amt'];
        $overallTotal += $lineTotal;

        // Formatting the line: (QTY)DESC  AMT  Total
        $qtyStr = "(" . $item['qty'] . ")";
        echo str_pad($qtyStr, 6) . 
             str_pad($item['desc'], 10) . 
             str_pad($item['amt'], 8, " ", STR_PAD_LEFT) . 
             str_pad($lineTotal, 10, " ", STR_PAD_LEFT) . "\n";
    }

    echo "------------------------------------\n";
    echo str_pad("Overall Total", 16) . "Php " . $overallTotal . "\n";
}

$groceryItems = [
    ['desc' => 'ITEM 1', 'qty' => 2, 'amt' => 100],
    ['desc' => 'ITEM 2', 'qty' => 7, 'amt' => 35],
    ['desc' => 'ITEM 3', 'qty' => 1, 'amt' => 350],
    ['desc' => 'ITEM 4', 'qty' => 2, 'amt' => 20],
];

header('Content-Type: text/plain'); // Ensures spacing looks correct in a browser
generateReceipt($groceryItems);

?>
