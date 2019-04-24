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
       // var_dump($_SERVER);
       
        var_dump($_REQUEST);
        $shortLink =  ShortLinkGenerator::generateShortURL();
        //$shortLinkGenerator = new ShortLinkGenerator();
        

        $shorterConfig = new ShorterConfig();
        $shorterConfig->getConfig();
        $domain = $shorterConfig->config_domain;
        
        $requestURI = $this->getServerURI($_SERVER);
        $longURL = $this->getLongURL('longurl');
        //$shortURL = $this->generateShortURL();
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
     * @Route("/main/{shortURL}" , name = "main")
     */
    public function main()
    {
        $shortURL = '';
        if($shortURL){
            //make redirection 
        } else {
            //reditrect to index
        }
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

    public function generateShortURL()
    {   
        $shortURL = '';
        $range = range('a','z');
        //$randomCharacter = rand(0,count($range)-1);
        
        while(strlen($shortURL)<=5){
            $randomCharacter = rand(0,count($range)-1);
            $shortURL .= $range[$randomCharacter]; 
        }
        //ta funkcja generuje krotki link.
        //this function generates short sufix added to link.
        //return shortURL;
        return $shortURL;
    }

    /**
     * @Route("/link/new", name="new_link");
     * Method({"GET", "POST"})
     */
    public function new(Request $request)
    {   
        $link = new Link();
        $shortLink ='aa';
        $form = $this->createFormBuilder($link)
                     ->add('longurl', TextType::class, array('attr'=>array('class'=> 'form-control')))
                    //  ->add('body', TextareaType::class, array(
                    //        'required'=> false,
                    //        'attr'=>[
                    //            'class'=>'form-control'
                    //        ]
                    //    ))
                     ->add('Save', SubmitType::class, array(
                         'label'=> 'Create',
                         'attr' => [
                             'class' => 'btn btn-primary mt-3'
                         ]
                     ))
                     ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //$form = $this->createFormBuilder($link)
            $link = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $shortLink =  ShortLinkGenerator::generateShortURL();
            $link->setShorturl($shortLink);

            $entityManager->persist($link);
            $entityManager->flush();
            $data = ['form'=>$form->createView(), 'shortLink'=>$shortLink];
            return $this->render('shorter/form.html.twig', ['data'=>$data]);
        }
        return $this->render('shorter/form.html.twig', ['data'=>['form'=>$form->createView(), 'shortlink'=>$shortLink]]);
    }
}