<?php

// src/Bajor/WebServiceBundle/Entity/QuadraticEquation.php
namespace Bajor\WebServiceBundle\Entity;

class QuadraticEquation
{
    protected $factorA;
    protected $factorB;
    protected $factorC;
    protected $minX;
    protected $maxX;

    public function getFactorA()
    {
        return $this->factorA;
    }

    public function setFactorA($a)
    {
        $this->factorA = $a;
    }
    
    public function getFactorB()
    {
        return $this->factorB;
    }

    public function setFactorB($b)
    {
        $this->factorB = $b;
    }
    
    public function getFactorC()
    {
        return $this->factorC;
    }

    public function setFactorC($c)
    {
        $this->factorC = $c;
    }

    
    
    public function getMinX()
    {
        return $this->minX;
    }

    public function setMinX($x)
    {
        $this->minX = $x;
    }
    
    public function getMaxX()
    {
        return $this->maxX;
    }

    public function setMaxX($x)
    {
        $this->maxX = $x;
    }
    
    
    
}

