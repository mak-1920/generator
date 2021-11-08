<?php

namespace App\Helpers;

class CSVGenerator{
    private $data;
    
    public function __construct(?array $data)
    {
        $this->data = $data;
    }

    public function createFileAndSave() : array
    {
        $shortname = time();
        
        if(\file_exists($shortname.'.csv')){
            $i = 0;
            while(file_exists($shortname.'-'.++$i.'.csv'));
            $shortname .= "-$i";
        }
        fopen('t', 'w');
        echo $_SERVER['DOCUMENT_ROOT'].\PHP_EOL;
        $shortname = 'files\\'.$shortname.'.csv';
        $fileName = __DIR__.'\\..\\..\\public\\'.$shortname;

        $fp = fopen($fileName, 'w');

        foreach ($this->data as $fields)
            fputcsv($fp, $fields, ';');

        fclose($fp);

        return array('fileName' => $shortname); 
    }
}