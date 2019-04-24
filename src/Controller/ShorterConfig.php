<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShorterConfig extends Controller
{
    public function getConfig()
    {
        $config = [];
        $config['domain'] = 'pli.pl';
        $this->config_domain = $config['domain'];

        return $config;
    }
}