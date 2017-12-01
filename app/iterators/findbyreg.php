<?php
fwrite(STDOUT, "please input the full directory path to search" . PHP_EOL);
$dir = trim(fgets(STDIN));
fwrite(STDOUT, "please input the regexp for find files" . PHP_EOL);
$pattern = trim(fgets(STDIN));
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$count = 0;
foreach ($rii as $file) {
    if ($count < 10) {
        $matches = array();
        preg_match($pattern, substr($file, stripos($file, '\'')), $matches);
        if (count($matches) > 0){
            fwrite(STDOUT, $file . PHP_EOL);
            $count++;
        }

        continue;
    }
    fwrite(STDOUT, "next 10 files? ('n' to next)" . PHP_EOL);
    $line = trim(fgets(STDIN));
    switch ($line) {
        case 'n':
            $count = 0;
            continue;
            break;
        default:
            return;
    }
}
