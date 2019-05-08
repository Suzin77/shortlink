<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShortLinkGenerator
{
    static public function generateSufix($length)
    {   
        $shortURL = '';
        $range = range('a','z');
        $count = 0;

        while(strlen($shortURL)<=$length){
            $randomCharacter = rand(0,count($range)-1);
            $shortURL .= $range[$randomCharacter]; 
        }
        return $shortURL;
    }

    

}