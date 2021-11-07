<?php

namespace App\Helpers;

use Doctrine\Persistence\ManagerRegistry;

abstract class abstractGenerator 
{
    protected $rowCount;
    protected $doctrine;
    protected $country;
    protected $page;
    protected $chance;
    protected $alphabet;

    protected abstract function setAlphabet() : void;
    protected abstract function getFCs() : array;
    protected abstract function getAddresses() : array;
    protected function getPhones(): array
    {
        $code = -1;
        switch($this->country){
            case 'ru': $code = 7; break;
            case 'by': $code = 375; break;
            case 'us': $code = 1; break;
        }
        $phones = array();
        for ($i=0; $i < $this->rowCount; $i++) 
            $phones[$i] = $this->getPhone($code);
        return $phones;
    }

    protected function getPhone(int $codeOfCountry): string
    {
        $phone = new PhoneCreater($codeOfCountry);
        return $phone->getInRandomType();
    }
    // protected abstract function 

    public function __construct(?int $seed, ?int $page, ?float $chance, string $country, ManagerRegistry $doctrine){
        if($seed === null) $seed = 0;
        if($page === null) $page = 1;
        $this->page = $page;
        srand($seed + $page);
        $this->rowCount = $page == 1 ? 20 : 10;
        $this->doctrine = $doctrine;
        $this->country = $country;
        $this->setAlphabet();
        $this->chance = $chance;
    }

    public function getRandomData(): array
    {
        $data = array();
        $fcs = array_pad($this->getFCs(), $this->rowCount, 'fcs');
        $address = array_pad($this->getAddresses(), $this->rowCount, 'address');
        $phones = array_pad($this->getPhones(), $this->rowCount, 'phone');
        for ($i=0; $i < $this->rowCount; $i++) { 
            $data[$i] = array(
                'num' => ($this->page == 1 ? $i : $i + $this->page * 10) + 1,
                'id' => rand(0, 100000000),
                'fcs' => $fcs[$i],
                'address' => $address[$i],
                'phone' => $phones[$i]);
        }
        $errorCreator = new ErrorsCreator($this->alphabet, $data);
        return $errorCreator->Create($this->chance);
    }
}