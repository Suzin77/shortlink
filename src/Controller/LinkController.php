<?php
namespace App\Controller;

use App\Entity\Article;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundel\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LinkController extends Controller
{
    /**
     * @Route("/", name ="article_list")
     * 
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        $person = [
            'name'=>'patryk',
            'surname'=>'sosnowski',
        ];

        $data = [
            'person'=>$person,
            'articles'=>$articles
        ];

     //   return new Response('<html>HHHH</html>');
        return $this->render("articles/index.html.twig", array('articles'=> $articles));

    }

    /**
     * @Route("/article/new", name="article_new");
     * Method({"GET", "POST"})
     */

    public function new(Request $request)
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('title', TextType::class, array('attr'=>array('class'=> 'form-control')))
                     ->add('body', TextareaType::class, array(
                           'required'=> false,
                           'attr'=>[
                               'class'=>'form-control'
                           ]
                       ))
                     ->add('Save', SubmitType::class, array(
                         'label'=> 'Create',
                         'attr' => [
                             'class' => 'btn btn-primary mt-3'
                         ]
                     ))
                     ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_list');
        }

        return $this->render('articles/new.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/article/show/{id}" , name="article_show");
     */

    public function show($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render("articles/show.html.twig", array('article'=>$article));
    }

    /**
     * @Route("/article/save")
     */

    // public function save(){
    //     $entityManager = $this->getDoctrine()->getManager();

    //     $article = new Article();
    //     $article->setTitle('Article secondary');
    //     $article->setBody('This is a body of two');

    //     $entityManager->persist($article);
    //     $entityManager->flush();

    //     return new Response('Zapisano jako art o numerze '. $article->getId());
    // }
}