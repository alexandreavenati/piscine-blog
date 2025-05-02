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

    // Création d'un article lorsqu'on envoie la requête en post (quand on clique sur le bouton de type submit)
    // Utilisation de la classe Request de Symfony pour récupérer le type de données envoyées
    // Utilisation de la classe EntityManagerInterface de Symfony pour sauvegarder et pousser le contenu de l'article
    // créée dans lle tableau de la bdd
    public function displayCreateArticle(Request $request, EntityManagerInterface $entityManager){

        if ($request->isMethod('POST')) {

            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $content = $request->request->get('content');
            $image = $request->request->get('image');

            $article = new Article($title, $description, $content, $image);

            // sauvegarde l'article créé
            $entityManager->persist($article);

            // pousse l'article créé dans la base de donnée
			$entityManager->flush();

            // msg flash
            $this->addFlash("success", "Article : " . $article->getTitle() . " a été enregistré.");
        }

        return $this->render('create-article.html.twig');
    }
}