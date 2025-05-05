<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController {

    #[Route('/', name: 'home')]
    public function displayHome(ArticleRepository $articleRepository){

        $articles = $articleRepository->sortArticlesByDate();

        return $this->render('home.html.twig', ['articles' => array_slice($articles, 0, 2)]);
    }

    #[Route('/404', name:'404')]
    public function page404() {

        $html = $this->renderView('error404.html.twig');

        return new Response($html, 404);
    }
}