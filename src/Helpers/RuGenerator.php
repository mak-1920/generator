<?php

namespace App\Helpers;

use App\Entity\RuAddrSubjects;
use App\Entity\RuNames;
use App\Entity\RuPatronymic;
use App\Entity\RuSurnames;
use App\Helpers\abstractGenerator;
use App\Repository\RuAddrSubjectsRepository;
use Doctrine\Persistence\ObjectRepository;

class RuGenerator extends abstractGenerator 
{
    public function __construct(?int $seed, ?int $page, ?float $chance, $doctrine)
    {
        parent::__construct($seed, $page, $chance, "ru", $doctrine);
    }

    protected function getFCs() : array
    {
        $gender = rand(0, 1) ? "male" : "female";
        $fcs = array();
        $names = $this->doctrine
            ->getRepository(RuNames::class)
            ->getRandomPartsOfFCs($this->rowCount, $gender, 'name');
        $surnames = $this->doctrine
            ->getRepository(RuSurnames::class)
            ->getRandomPartsOfFCs($this->rowCount, $gender, 'surname');
        $patronymics = $this->doctrine
            ->getRepository(RuPatronymic::class)
            ->getRandomPartsOfFCs($this->rowCount, $gender, 'patronymic');
        for ($i=0; $i < $this->rowCount; $i++)
            $fcs[$i] = $this->getFCsOfOne($names[$i], $surnames[$i], $patronymics[$i]);
        return $fcs;
    }

    private function getFCsOfOne(string $name, string $surname, string $patronymic) : String
    {
        $type = rand(0, 3);
        switch($type){
            case 0: return $name.' '.$surname;
            case 1: return $surname.' '.$name;
            case 2: return $name.' '.$patronymic;
            case 3: return $surname.' '.$name.' '.$patronymic;
        }
    }

    public function getAddresses() : array
    {
        $rep = $this->doctrine->getRepository(RuAddrSubjects::class);
        $addrs = array();
        for ($i=0; $i < $this->rowCount; $i++) 
            $addrs[] = $this->getAddress($rep);
        return $addrs;
    }

    private function getSubjsRow(string $codeTpl, string $subjType, RuAddrSubjectsRepository $rep, 
        int $codeStart, int $codeLength) : array
    {
        $info = array();
        $subjs = $rep->getSubjects($codeTpl);
        if(count($subjs) != 0){
            $subj = $subjs[rand(0, count($subjs) - 1)];
            $info[$subjType] = $subj['name'];
            $info[$subjType.'-type'] = $subj['shortname'];
            $info[$subjType.'-fulltype'] = $subj['type'];
            $info[$subjType.'-code'] = mb_substr($subj['code'], $codeStart, $codeLength, 'UTF-8');
        }
        else $info[$subjType.'-code'] = \str_repeat('0', $codeLength);
        return $info;
    }
    private function getAddress(RuAddrSubjectsRepository $rep) : string
    {
        $addr = array('country' => "\u{0420}\u{043e}\u{0441}\u{0441}\u{0438}\u{044f}");
        
        $addr = array_merge($addr, $this->getSubjsRow('__00000000000', 'region', $rep, 0, 3));
        $addr = array_merge($addr, $this->getSubjsRow($addr['region-code'].'___0000000', 'district', $rep, 3, 3));
        $addr = array_merge($addr, $this->getSubjsRow($addr['region-code'].$addr['district-code'].'___0000000', 'other', $rep, 6, 7));

        return $this->getStringAddress($addr);
    }

    private function getStringAddress(array $addr) : string
    {
        $str = '';
        if(rand(0, 1))
            $str .= $addr['country'].', ';
        $str .= $this->getPartOfAddress($addr, 'region');
        $str .= $this->getPartOfAddress($addr, 'district', true);
        $str .= $this->getPartOfAddress($addr, 'subj', true);

        return mb_substr($str, 0, -2, 'UTF-8');
    }

    private function getPartOfAddress(array $addr, string $field, bool $canHide = false) : string
    {
        if(!isset($addr[$field])) return '';
        if($canHide && !rand(0, 1)) return '';
        $type = rand(0, 4);
        switch($type){
            case 0: return $addr[$field.'-type'].' '.$addr[$field].', ';
            case 1: return $addr[$field.'-fulltype'].' '.$addr[$field].', ';
            case 2: return mb_strtolower($addr[$field.'-fulltype'], 'UTF-8').' '.$addr[$field].', ';
            case 3: return $addr[$field].' '.$addr[$field.'-fulltype'].', ';
            case 4: return $addr[$field].' '.mb_strtolower($addr[$field.'-fulltype'], 'UTF-8').', ';
        }
    }

    protected function setAlphabet() : void
    {
        $this->alphabet = "\u{0430}\u{0431}\u{0432}\u{0433}\u{0434}\u{0435}\u{0436}\u{0437}\u{0438}\u{0439}\u{043a}\u{043b}\u{043c}\u{043d}\u{043e}\u{043f}\u{0440}\u{0441}\u{0442}\u{0443}\u{0444}\u{0445}\u{0446}\u{0447}\u{0448}\u{0449}\u{044a}\u{044b}\u{044c}\u{044d}\u{044e}\u{044f}\u{0410}\u{0411}\u{0412}\u{0413}\u{0414}\u{0415}\u{0416}\u{0417}\u{0418}\u{0419}\u{041a}\u{041b}\u{041c}\u{041d}\u{041e}\u{041f}\u{0420}\u{0421}\u{0422}\u{0423}\u{0424}\u{0425}\u{0426}\u{0427}\u{0428}\u{0429}\u{042a}\u{042b}\u{042c}\u{042d}\u{042e}\u{042f}0123456789";
    }
}