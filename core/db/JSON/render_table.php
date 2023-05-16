
<?php

function render_table(array $array) {
$num_rows = count($array);
$num_cols = count($array[0]);


for ($j = 0; $j < $num_cols; $j++) {
    printf("| %-15s ", $array[0][$j]);
}
printf("|\n");

for ($j = 0; $j < $num_cols; $j++) {
    printf("|%'-17s", '');
}
printf("|\n");

for ($i = 1; $i < $num_rows; $i++) {
    for ($j = 0; $j < $num_cols; $j++) {
        printf("| %-15s ", isset($array[$i][$j]) ? $array[$i][$j] : '');
    }
    printf("|\n");
}

for ($j = 0; $j < $num_cols; $j++) {
    printf("|%'-17s", '');
}
printf("|\n");
}

?>