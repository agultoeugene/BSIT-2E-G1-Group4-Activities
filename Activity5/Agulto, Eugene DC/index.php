<?php 
$items = array (
    array(
          "item" => "ITEM 1",
          "quantity" => "2",
          "amount" => "100"
          ),
    array(
          "item" => "ITEM 2",
          "quantity" => "7",
          "amount" => "35"
           ),
    array(
          "item" => "ITEM 3",
          "quantity" => "1",
          "amount" => "350"
           ),
    array("item" => "ITEM 4", "quantity" => "2", "amount" => "20"),
);

$overall_Total = 0;

echo "<pre>"; 

echo "QTY\tDESC\tAMT\tTOTAL\n";
echo "------------------------------------\n";

for($i = 0; $i < count($items); $i++){

    $quantity = $items[$i]["quantity"];
    $item = $items[$i]["item"];
    $amount = $items[$i]["amount"];

    $total = $quantity * $amount;
    $overall_Total += $total;

    echo "($quantity)\t$item\t$amount\t$total\n";
}

echo "------------------------------------\n";
echo "OVERALL TOTAL:\t\tPhp $overall_Total";

echo "</pre>"; 
?>