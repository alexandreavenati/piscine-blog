<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController {

    #[Route('/creer-article', name: 'create-article')]
    public function displayCreateArticle(Request $request){

        if ($request->isMethod('POST')) {

            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $content = $request->request->get('content');
            $image = $request->request->get('image');

            $article = new Article($title, $description, $content, $image);

            $this->addFlash("success", "Article : " . $article->getTitle() . " a été enregistré.");
        }

        return $this->render('create-article.html.twig');
    }
}