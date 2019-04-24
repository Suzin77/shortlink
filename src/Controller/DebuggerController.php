<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DebuggerController extends Controller
{
    /**
     * @Route("/deb/{id}", name="debugger")
     */

    public function server_dump()
    {
       // var_dump($_SERVER);
       
        var_dump($_REQUEST);
        
        $shorterConfig = new ShorterConfig();
        $shorterConfig->getConfig();
        $domain = $shorterConfig->config_domain;
        
        $requestURI = $this->getServerURI($_SERVER);
        $longURL = $this->getLongURL('longurl');
        $shortURL = $this->generateShortURL();

        $fullURL = $domain."/".$shortURL;

        return $this->render('deb/index.html.twig', array('request_uri'=>$requestURI,
                                                          'longurl'=>$longURL,
                                                          'shortURL'=>$shortURL,
                                                          'fullURL' =>$fullURL
                                                          
                                                    )
                            );
    }

    public function getServerURI($data)
    {
        if(isset($data['REQUEST_URI'])){
            return $data['REQUEST_URI'];
        }
    }

    public function getUrlParameter($parName)
    {
        //pobieramy parametry
        //return $parname
    }

    public function getLongURL($parname)
    {
        if(isset($_REQUEST[$parname])){
            //need check data 
            $parValue = $_REQUEST[$parname];
            //after clear data
            return $parValue;
        }
        //return $logURL;
    }

    // public function generateShortURL()
    // {   
    //     $shortURL = '';
    //     $range = range('a','z');
    //     //$randomCharacter = rand(0,count($range)-1);
    //     $count = 0;

    //     while(strlen($shortURL)<=5){
    //         $randomCharacter = rand(0,count($range)-1);
    //         $shortURL .= $range[$randomCharacter]; 
    //     }
    //     //ta funkcja generuje krotki link.
    //     //return shortURL;
    //     return $shortURL;
    // }
}