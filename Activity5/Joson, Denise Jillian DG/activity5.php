<?php

function generateReceipt($items) {
    $overallTotal = 0;

    echo str_pad("QTY", 6) . str_pad("DESC", 9) . str_pad("AMT", 10) . "Total\n";
    echo str_repeat("-", 30) . "\n";

    foreach ($items as $item) {
        $lineTotal = $item['qty'] * $item['amt'];
        $overallTotal += $lineTotal;

        printf("(%d) %-10s %-10d %d\n", 
            $item['qty'], 
            $item['desc'], 
            $item['amt'], 
            $lineTotal
        );
    }

    echo str_repeat("-", 30) . "\n";
    echo str_pad("Overall Total", 22) . "Php " . $overallTotal . "\n";
}

$groceryList = [
    ['desc' => 'ITEM 1', 'qty' => 2, 'amt' => 100],
    ['desc' => 'ITEM 2', 'qty' => 7, 'amt' => 35],
    ['desc' => 'ITEM 3', 'qty' => 1, 'amt' => 350],
    ['desc' => 'ITEM 4', 'qty' => 2, 'amt' => 20],
];

header('Content-Type: text/plain'); 
generateReceipt($groceryList);

?>