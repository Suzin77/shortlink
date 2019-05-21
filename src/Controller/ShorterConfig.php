<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShorterConfig extends Controller
{
    public function getConfig()
    {
        $this->config_domain = 'lin-q.pl';
        $this->serverName = $_SERVER['SERVER_NAME'];
        $this->serverBase = $_SERVER['BASE'];

        return $this;
    }
}