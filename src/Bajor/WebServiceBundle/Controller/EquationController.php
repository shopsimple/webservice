<?php
# src/Bajor/WebServiceBundle/Controller/EquationController.php

namespace Bajor\WebServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Bajor\WebServiceBundle\Services\EquationService;
use Zend\Soap;

class EquationController extends Controller
{
    
    public function init()
    {
        // No cache
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
    }

    public function quadraticAction()
    {
        if(isset($_GET['wsdl'])) {
            return $this->handleWSDL($this->generateUrl('bajor_api_equation_quadratic', array(), true), 'eq_quadratic_service'); 
        } else {
            return $this->handleSOAP($this->generateUrl('bajor_api_equation_quadratic', array(), true), 'eq_quadratic_service'); 
        }
 }

    /**
    * return the WSDL
    */
    public function handleWSDL($uri, $class)
    {
        // Soap auto discover
        $autodiscover = new Soap\AutoDiscover();
        $autodiscover->setClass($this->get($class));
        $autodiscover->setUri($uri);

       // Response
       $response = new Response();
       $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-2');
       ob_start();

       // Handle Soap
       $autodiscover->handle();
       $response->setContent(ob_get_clean());
       return $response;
    }

    /**
     * execute SOAP request
     */
    public function handleSOAP($uri, $class)
    {
        
        // Soap server
        $soap = new Soap\Server(null,
            array('location' => $uri,
            'uri' => $uri,
        ));
        
        
        $soap->setClass($this->get($class));
        
        
        // Response
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-2');
        
        
        try {
            ob_start();
            // Handle Soap
            $soap->handle();
            
            $response->setContent(ob_get_clean());
            
        } catch (SoapFault $e) {
          echo $e->faultcode; 
        }
        
        
        
        return $response;
    }
}