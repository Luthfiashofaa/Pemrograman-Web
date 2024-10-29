<?php

echo "Segitiga Sama Kaki : \n";


for ($i = 1; $i <= 5; $i++) {
    for ($j = 5; $j > $i; $j--) {
        echo " ";
    }
    
    for ($j = 1; $j <= (2 * $i - 1); $j++) {
        echo "*";
    }
    
    echo "\n";
}

echo "\nSegitiga Sama Kaki tapi Kebalik : \n";

for ($i = 5; $i >= 1; $i--) {
    for ($j = 5; $j > $i; $j--) { // Perbaiki kondisi spasi
        echo " "; // Spasi untuk membuat segitiga terbalik
    }
    // Menambahkan bintang
    for ($j = 1; $j <= (2 * $i - 1); $j++) { // Perbaiki kondisi bintang
        echo "*";
    }
    
    echo "\n"; // Garis baru setelah setiap baris
}
?>
