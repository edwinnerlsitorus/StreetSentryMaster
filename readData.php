<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$filePath = 'DataAkurasi/akurasi.xlsx';

$reader = new Xlsx();
$spreadsheet = $reader->load($filePath);

$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray();

// print_r($data);
$dataAkurasi = array();

foreach ($data as $row) {
    foreach ($row as $cell) {
        // $dataAkurasi = $cell.",";

    array_push($dataAkurasi, $cell);
    }
    echo "\n";
}
$dataMaps = array();

for($i = 0; $i<sizeof($dataAkurasi); $i++){
    if($i>1 && $i%2==0){
        $dataKor = $dataAkurasi[$i].",".$dataAkurasi[$i+1];
        array_push($dataMaps, $dataKor);
    }
}

print_r($dataMaps);

// AIzaSyD0qk_u7O-1j-gnm6VQiOF02qpxY9ql8R0
