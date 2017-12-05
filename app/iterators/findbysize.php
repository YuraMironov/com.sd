<?php
fwrite(STDOUT, "please input the full directory path to search" . PHP_EOL);
$dir = trim(fgets(STDIN));
fwrite(STDOUT, "please input the min size to find files. In format N(mg, gb, kb, b)" . PHP_EOL);
$size = trim(fgets(STDIN));
function getBytes($size):?float{
    $matches = array();
    $size = '0' . $size;
    preg_match('/([\.0-9]+)(mb|gb|kb|b)/', $size, $matches);
    if (isset($matches[2])) {
        switch ($matches[2]){
            case 'mb':
                return floatval($matches[1]) * 1024 * 1024;
                break;
            case 'gb':
                return floatval($matches[1]) * 1024 * 1024 * 1024;
                break;
            case 'kb':
                return floatval($matches[1])  * 1024;
                break;
            case 'b':
                return floatval($matches[1]);
                break;
            default:
                throw new Exception('Bad input data');
                break;
        }
    }
    throw new Exception('Bad input data');
}
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$count = 0;
$minsize = getBytes($size);
foreach ($rii as $file) {
    if ($count < 10) {
        if ((filesize($file) >= $minsize)){
            fwrite(STDOUT, $file . ' - ' . filesize($file) . " >= " . $minsize . PHP_EOL);
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
