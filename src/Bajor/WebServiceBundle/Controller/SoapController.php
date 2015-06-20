<?php
# src/Bajor/WebServiceBundle/Controller/SoapController.php

namespace Bajor\WebServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Bajor\WebServiceBundle\Services\CheckService;
use Zend\Soap;

class SoapController extends Controller
{
    public function init()
    {
        // No cache
        ini_set('soap.wsdl_cache_enable', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
    }

    public function checkAction()
    {
        if(isset($_GET['wsdl'])) {
            return $this->handleWSDL($this->generateUrl('bajor_api_soap_check', array(), true), 'check_service'); 
        } else {
            return $this->handleSOAP($this->generateUrl('bajor_api_soap_check', array(), true), 'check_service'); 
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
       $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');
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
        // $soap->setClass('Bajor\WebServiceBundle\Services\CheckService');
        
        //$soap->setObject(new CheckService());
        
        
        
        // Response
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');
        
        
        try {
            ob_start();
            // Handle Soap
            $soap->handle();
            
            $response->setContent(ob_get_clean());
            
        } catch (SoapFault $e) {
          //do something about the problem
          echo $e->faultcode; 
        }
        
        
        
        return $response;
    }
}