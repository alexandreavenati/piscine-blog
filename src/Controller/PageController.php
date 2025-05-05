<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController {

    #[Route('/', name: 'home')]
    public function displayHome(ArticleRepository $articleRepository){

        $articles = $articleRepository->findAll();

        return $this->render('home.html.twig', ['articles' => $articles]);
    }
}