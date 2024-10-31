<?php
// Meminta pengguna untuk memasukkan nama
echo "Masukkan Bilangan Bulat Positif: ";
$bilangan = trim(fgets(STDIN));

for ($x = 1; $x <= $bilangan; $x++) {
    
    if ($x % 4 == 0 && $x % 6 == 0){
        echo "Pemrograman Website 2024\n";
    }

    elseif($x % 5 == 0){
        echo "2024\n";
    }

    elseif($x % 4 == 0){
        echo "Pemrograman\n";
    }

    else if($x % 6 == 0){
        echo "Website\n";
    }

    else{
        echo "$x\n";
    }
}
