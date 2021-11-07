<?php

namespace App\Helpers;

class ErrorsCreator
{
    private $alphabet;
    private $rows;

    public function __construct(string $alphabet, array $rows)
    {
        $this->alphabet = $alphabet;
        $this->rows = $rows;
    }

    public function Create(float $chanceOfError) : array
    {
        for ($i=0; $i < count($this->rows); $i++) 
            $this->createOneRow($this->rows[$i], $chanceOfError);
        return $this->rows;
    }

    public function CreateOneRow(array &$row, float $chance) : void
    {
        $fields = array('fcs', 'address', 'phone');
        for ($i=0; $i < floor($chance); $i++) { 
            $errorType = rand(0, 0);
            $field = $fields[rand(0, 2)];
            switch($errorType){
                case 0: $this->AddLetter($row, $field); break;
                case 1: 
                    if(!empty($row[$field]))
                        $this->RemoveLetter($row, $field); 
                    else{
                        $i--;
                        continue;
                    }
                    break;
                case 2: $this->SwapLetters($row, $field); break;
            }
        }
        if(rand(0, 99) < $chance * 100 % 100)
            $this->CreateOneRow($row, 1);
    }

    private function AddLetter(array &$row, string $field) : void
    {
        $letter = mb_substr($this->alphabet, rand(0, mb_strlen($this->alphabet) - 1), 1);
        $pos = rand(0, mb_strlen($row[$field]) - 1);
        $row[$field] = \mb_substr($row[$field], 0, $pos, 'UTF-8')
            .$letter
            .\mb_substr($row[$field], $pos, null, 'UTF-8');
    }
    private function RemoveLetter(array &$row, string $field) : void
    {
        $pos = rand(0, mb_strlen($row[$field]) - 1);
        $row[$field] = \mb_substr($row[$field], 0, $pos - 1, 'UTF-8')
            .\mb_substr($row[$field], $pos, null, 'UTF-8');
    }
    private function SwapLetters(array &$row, string $field) : void
    {
        $pos = rand(0, mb_strlen($row[$field]) - 2);
        $l1 = mb_substr($row[$field], $pos, 1, 'UTF-8');
        $l2 = mb_substr($row[$field], $pos + 1, 1, 'UTF-8');
        $row[$field] = mb_substr($row[$field], 0, $pos - 1, 'UTF-8')
            .$l2.$l1
            .mb_substr($row[$field], $pos + 1, null, 'UTF-8');
    }
}