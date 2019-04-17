<?php
namespace App\Controller;

use App\Entity\Article;

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
     * @Route("/article/{id}" , name="article_show");
     */

     public function show($id){
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