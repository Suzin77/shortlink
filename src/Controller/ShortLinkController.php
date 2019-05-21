<?php 
namespace App\Controller;

use App\Entity\Link;
use App\Model\ShortLinkGenerator;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShortLinkController extends Controller
{
    /**
     * @Route("/{shorturl}" , name = "main")
     */
    public function main($shorturl)
    {   
        $link = $this->getDoctrine()->getRepository(Link::class)->findOneBy(['sufix' => $shorturl]);
        if($link){
            //make redirection
            return $this->redirect($link->getLongurl());    
        }
        return $this->redirectToRoute('new_link');
    }

    /**
     * @Route("", name= "new_link")
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
                     ->add('longurl', TextType::class, array('label'=>'Long URL', 'attr'=>array('class'=> 'form-control')))
                     ->add('Save', SubmitType::class, array(
                         'label'=> 'Short Your Link',
                         'attr' => ['class' => 'btn btn-primary mt-3']
                     ))
                     ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $link = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $shortLinkSufix =  ShortLinkGenerator::generateSufix(5);
            $link->setSufix($shortLinkSufix);
            $link->addProtocol();
            //build up whole short adress with protocol.
            $shortLink = "http://".$serverName.$serverBase."/".$shortLinkSufix;//put this into separet function.
            $link->setShorturl($shortLink);
            $entityManager->persist($link);
            $entityManager->flush();
            $data = ['form'=>$form->createView(),
                     'shortLink'=>$shortLink
                    ];
            return $this->render('shorter/form.html.twig', ['data'=>$data]);
        }
        return $this->render('shorter/form.html.twig', ['data'=>['form'=>$form->createView(), 'shortlink'=>$shortLink]]);
    }
}