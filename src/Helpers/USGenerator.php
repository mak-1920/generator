<?php

namespace App\Helpers;

use App\Entity\RuAddrSubjects;
use App\Entity\RuNames;
use App\Entity\RuPatronymic;
use App\Entity\RuSurnames;
use App\Entity\UsNames;
use App\Entity\UsSurnames;
use App\Helpers\abstractGenerator;
use App\Repository\RuAddrSubjectsRepository;
use Doctrine\Persistence\ObjectRepository;

class USGenerator extends abstractGenerator 
{
    public function __construct(?int $seed, ?int $page, ?float $chance, $doctrine)
    {
        parent::__construct($seed, $page, $chance, "us", $doctrine);
    }

    protected function getFCs() : array
    {
        $fcs = array();
        $names = $this->doctrine
            ->getRepository(UsNames::class)
            ->getRandomPartsOfFCs($this->rowCount, null, 'name');
        $surnames = $this->doctrine
            ->getRepository(UsSurnames::class)
            ->getRandomPartsOfFCs($this->rowCount, null, 'surname');
        for ($i=0; $i < $this->rowCount; $i++)
            $fcs[$i] = $this->getFCsOfOne($names[$i], $surnames[$i]);
        return $fcs;
    }

    private function getFCsOfOne(string $name, string $surname) : String
    {
        $type = rand(0, 1);
        switch($type){
            case 0: return $name.' '.$surname;
            case 1: return $surname.' '.$name;
        }
    }

    public function getAddresses() : array
    {
        return array();
    }

    protected function setAlphabet() : void
    {
        $this->alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }
}