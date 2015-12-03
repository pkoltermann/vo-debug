<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace spec\VoDebug\Dumpers;


class TestSubjectSpec
{
    public $array = [
            "subfoo" => "subbar"
        ];
    
    private $man = "get man";
    private $woman = "is woman";
    private $child = "has child";
    
    private $unaccessible = "bar";
    
    function getMan()
    {
        return $this->man;
    }

    function isWoman()
    {
        return $this->woman;
    }

    function hasChild()
    {
        return $this->child;
    }
}