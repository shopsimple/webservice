<?php 
# src/Bajor/WebServiceBundle/Services/EquationService.php

namespace Bajor\WebServiceBundle\Services;

class EquationService
{
    /**
     * Solve Quadratic Equation. 
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $minx
     * @param float $maxx                     
     * @return array 
     */
    public function quadratic($a, $b, $c, $minx, $maxx)
    {
        $result = array();
        
        $delta = $b * $b - 4 * $c * $a;
        $result['delta'] = $delta;
        
        while( $delta < 0 )
        {
            $result['deltaInfo'] = 'Delta < 0 - Dwa sprzężone pierwiastki urojone.';
              
            $re1 = $re2 = -1 * $b / (2 * $a);
            $im1 = sqrt(abs($delta)) / (2 * $a);
            $im2 = -1 * $im1;
            
            $result['re_1'] = $re1;
            $result['re_2'] = $re2;
            $result['im_1'] = $im1;
            $result['im_2'] = $im2;
            
            break;
         }
         
         while( $delta > 0 )
         {
            $result['deltaInfo'] =  'Delta > 0 - Dwa pierwiastki rzeczywiste.';
            
            $x1 = (-1 * $b + sqrt($delta)) / (2 * $a);
            $x2 = (-1 * $b - sqrt($delta)) / (2 * $a);
            
            $result['x_1'] = $x1;
            $result['x_2'] = $x2;
            
            break;
         }
         
        while( $delta == 0 )
        {
            $result['deltaInfo'] =  'Delta = 0.';
           
            $x0 = -1 * $b / (2 * $a);
           
            $result['x_0'] = $x0;
           
            break;      
        }
        
        $result['solutions'] = array();
        
        for( $x = $minx; $x <= $maxx; $x++ )
        {
            $y = $a * $x * $x + $b * $x + $c;
             
            $result['solutions'][$x] = $y;
        }
        
        
        
        return $result;
    }
}