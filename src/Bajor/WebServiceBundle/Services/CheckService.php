<?php 
# src/Bajor/WebServiceBundle/Services/CheckService.php

namespace Bajor\WebServiceBundle\Services;

class CheckService
{
    /**
     * Check soap service, display name when called
     * @param string $name
     *       
     * @return mixed
     */
    public function check($name)
    {
        
        return 'Hello '.$name;
    }
}