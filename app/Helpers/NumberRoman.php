<?php

if (!function_exists('convertToRoman')) {
    function convertToRoman($monthNumber)
    {
        $romanNumerals = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];
        // return $monthNumber;
        return $romanNumerals[$monthNumber] ?? null; // Mengembalikan null jika input tidak valid
    }

}


if (!function_exists('typeToCode')) {
    function typeToCode($dataType)
    {
        $typeCode = [
            'Laptop' => 'LPT',
            'Printer' => 'PRT',
            'CCTV' => 'DVR',
            'Server' => 'SRV',
            'PC(Komputer)' => 'PCC',
            'Other' => 'IT',
        ];

        return $typeCode[$dataType] ?? 'IT';

    }
}
