<?php

namespace App\Helpers;

class PhoneCreater
{
    private $code;
    private $number;

    public function __construct($codeOfCountry){
        $this->code = $codeOfCountry;
        $this->number = '0';
        for ($i=0; $i < 10; $i++) 
            $this->number .= rand(0, 10);
    }

    public function getInRandomType(): string
    {
        $type = rand(0, 9);
        switch($type){
            case 0: return $this->parseToCurrentType("+a(bcd)efg-hi-jk");
            case 1: return $this->parseToCurrentType("+abcdefghijk");
            case 2: return $this->parseToCurrentType("abcdefghijk");
            case 3: return $this->parseToCurrentType("efghijk");
            case 4: return $this->parseToCurrentType("+a-bcd-efg-hi-jk");
            case 5: return $this->parseToCurrentType("+a (bcd) efghijk");
            case 6: return $this->parseToCurrentType("+a bcd efg hi jk");
            case 7: return $this->parseToCurrentType("a (bcd) efg-hi-jk");
            case 8: return $this->parseToCurrentType("a-bcd-efg-hi-jk");
            case 9: return $this->parseToCurrentType("+a (bcd) efg-hi-jk");
        }
    }

    private function parseToCurrentType(string $tpl): String
    {
        $phone = '';
        $aOrd = ord('a');
        for ($i=0; $i < strlen($tpl); $i++) {
            if($tpl[$i] == 'a'){
                $phone .= $this->code;
                continue;
            }
            if($tpl[$i] >= 'a' && $tpl[$i] <= 'k')
                $phone .= $this->number[ord($tpl[$i]) - $aOrd];
            else
                $phone .= $tpl[$i];
        }
        return $phone;
    }
}