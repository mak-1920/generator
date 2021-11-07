<?php

namespace App\Helpers;

class CSVGenerator{
    private $data;
    
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function createFileAndSave() : array
    {
        $fileName = 'files/'.time();
        if(\file_exists($fileName.'.csv')){
            $i = 0;
            while(file_exists($fileName.'-'.++$i.'.csv'));
            $fileName .= "-$i.csv";
        }
        $fileName .= '.csv';

        $fp = fopen($fileName, 'w');

        foreach ($this->data as $fields)
            fputcsv($fp, $fields, ';');

        fclose($fp);

        return array('fileName' => $fileName); 
    }
}