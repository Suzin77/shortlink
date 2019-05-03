<?php 
namespace App\Controller;

use App\Entity\Link;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShortLinkController extends Controller
{
    /**
     * @Route("/short/{id}", name="shortlink")
     */

    public function server_dump()
    {
        //var_dump($_SERVER);
        //var_dump($_REQUEST);

        $serverName = $_SERVER['SERVER_NAME'];
        $serverBase = $_SERVER['BASE'];
        $shortLink =  ShortLinkGenerator::generateShortURL();
        
        $shorterConfig = new ShorterConfig();
        $shorterConfig->getConfig();
        $domain = $shorterConfig->config_domain;
        
        $requestURI = $this->getServerURI($_SERVER);
        $longURL = $this->getLongURL('longurl');
        $shortURL =  ShortLinkGenerator::generateShortURL();

        $fullURL = $domain."/".$shortURL;

        return $this->render('deb/index.html.twig', array('request_uri'=>$requestURI,
                                                          'longurl'=>$longURL,
                                                          'shortURL'=>$shortURL,
                                                          'fullURL' =>$fullURL                                                          
                                                    )
                            );
    }

    /**
     * @Route("/new/{shorturl}" , name = "main")
     */
    public function main($shorturl)
    {   
        $link = $this->getDoctrine()->getRepository(Link::class)->findOneBy(['shorturl' => $shorturl]);
        if($link){
            //make redirection
            return $this->redirect('https://'.$link->getLongurl());     
        }
        return $this->redirectToRoute('new_link');
    }

    public function createRedirection($longURL)
    {

        return $shortURL;
    }

    public function getServerURI($data)
    {
        if(isset($data['REQUEST_URI'])){
            return $data['REQUEST_URI'];
        }
    }

    public function checkShortLink($shortLinkSuffix)
    {
        $check = $this->getDoctrine()->getRepository(Link::class)->find($shortLinkSuffix);
        return $check;
    }

    // public function getLongURL($parname)
    // {
    //     if(isset($_REQUEST[$parname])){
    //         //need check data 
    //         $parValue = $_REQUEST[$parname];
    //         //after clear data
    //         return $parValue;
    //     }
    //     //return $logURL;
    // }

    /**
     * @Route("/link/new", name="new_link");
     * Method({"GET", "POST"})
     */
    public function new(Request $request)
    {   
        $shortLink= '';
        $config = new ShorterConfig();
        $config->getConfig();
        $serverName = $config->serverName;
        $serverBase = $config->serverBase;
        $link = new Link();
        $form = $this->createFormBuilder($link)
                     ->add('longurl', TextType::class, array('attr'=>array('class'=> 'form-control')))
                     ->add('Save', SubmitType::class, array(
                         'label'=> 'Create',
                         'attr' => ['class' => 'btn btn-primary mt-3']
                     ))
                     ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $link = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $shortLink =  ShortLinkGenerator::generateShortURL();
            $link->setShorturl($shortLink);
            $entityManager->persist($link);
            $entityManager->flush();
            $data = ['form'=>$form->createView(), 'shortLink'=>$shortLink, 'serverName'=>$serverName, 'serverBase'=>$serverBase];
            return $this->render('shorter/form.html.twig', ['data'=>$data]);
        }
        return $this->render('shorter/form.html.twig', ['data'=>['form'=>$form->createView(), 'shortlink'=>$shortLink]]);
    }
}