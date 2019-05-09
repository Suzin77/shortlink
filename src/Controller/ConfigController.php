<?php 
namespace App\Controller;

use App\Entity\Link;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConfigController extends Controller
{
    /**
     * @Route("/config/{id}", name = "main_config")
     */

    public function config(){

            echo "<pre>".var_export($_SERVER, true)."</pre>";
            return $this->render("deb/debugger.html.twig");
    }

    /**
     * @Route("/config/default" , name="default_config")
     */
     public function setDefaultConfig()
     {
        echo "<pre>".var_export($_SERVER, true)."</pre>";
     }
}