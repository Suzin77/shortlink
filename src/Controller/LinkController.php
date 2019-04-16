<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LinkController extends Controller
{
    /**
     * @Route("/")
     * 
     */
    public function index()
    {
        $data = [
            'name'=>'patryk',
            'surname'=>'sosnowski'
        ];

        
     //   return new Response('<html>HHHH</html>');
        return $this->render("articles/index.html.twig");
    }
}