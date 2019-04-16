<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;

class LinkController
{
    /**
     * @Route("/")
     * 
     */
    public function index()
    {
        return new Response('<html>HHHH</html>');
    }
}