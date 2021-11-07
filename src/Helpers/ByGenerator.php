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

class ByGenerator extends abstractGenerator 
{
    public function __construct(?int $seed, ?int $page, ?float $chance, $doctrine)
    {
        parent::__construct($seed, $page, $chance, "by", $doctrine);
    }

    protected function getFCs() : array
    {
        return array();
    }

    public function getAddresses() : array
    {
        return array();
    }

    protected function setAlphabet() : void
    {
        $this->alphabet = "\u{0410}\u{0430}\u{0411}\u{0431}\u{0412}\u{0432}\u{0413}\u{0433}\u{0414}\u{0434}\u{0415}\u{0435}\u{0416}\u{0436}\u{0417}\u{0437}\u{0406}\u{0456}\u{0419}\u{0439}\u{041a}\u{043a}\u{041b}\u{043b}\u{041c}\u{043c}\u{041d}\u{043d}\u{041e}\u{043e}\u{041f}\u{043f}\u{0420}\u{0440}\u{0421}\u{0441}\u{0422}\u{0442}\u{0423}\u{0443}\u{040e}\u{045e}\u{0424}\u{0444}\u{0425}\u{0445}\u{0426}\u{0446}\u{0427}\u{0447}\u{0428}\u{0448}\u{042b}\u{044b}\u{042c}\u{044c}\u{042d}\u{044d}\u{042e}\u{044e}\u{042f}\u{044f}0123456789";
    }
}