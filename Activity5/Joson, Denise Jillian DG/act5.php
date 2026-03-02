<?php

/**
 * Generates a formatted receipt based on an array of items.
 * Each item should contain 'desc', 'qty', and 'amt'.
 */
function generateReceipt($items) {
    $overallTotal = 0;

    // Table Header
    echo str_pad("QTY", 6) . str_pad("DESC", 12) . str_pad("AMT", 10) . "Total\n";
    echo str_repeat("-", 38) . "\n";

    foreach ($items as $item) {
        $lineTotal = $item['qty'] * $item['amt'];
        $overallTotal += $lineTotal;

        // Formatting columns using printf for alignment
        // (%-s for left-align, %d for integers)
        printf("(%d) %-10s %-10d %d\n", 
            $item['qty'], 
            $item['desc'], 
            $item['amt'], 
            $lineTotal
        );
    }

    echo str_repeat("-", 38) . "\n";
    echo str_pad("Overall Total", 22) . "Php " . $overallTotal . "\n";
}

// Data input: Flexible array structure
$groceryList = [
    ['desc' => 'ITEM 1', 'qty' => 2, 'amt' => 100],
    ['desc' => 'ITEM 2', 'qty' => 7, 'amt' => 35],
    ['desc' => 'ITEM 3', 'qty' => 1, 'amt' => 350],
    ['desc' => 'ITEM 4', 'qty' => 2, 'amt' => 20],
];

// Execute
header('Content-Type: text/plain'); // Makes the output look like a receipt in the browser
generateReceipt($groceryList);

?>