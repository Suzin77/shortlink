<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Boundel\FrameworkExtraBoundle\Configuration\Method;

class LinkController
{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        return new Response('<html>HHHH</html>');
    }
}