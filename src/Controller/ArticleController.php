<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
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
    // créée dans le tableau de la bdd
    public function displayCreateArticle(Request $request, EntityManagerInterface $entityManager){

        // Vérifie le type de méthode envoyée par l'utilisateur
        if ($request->isMethod('POST')) {

            // Récupère les données envoyées via les 'name' du formulaire
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
            $this->addFlash('success', 'Article : "' . $article->getTitle() . '" a été enregistré.');
        }

        return $this->render('create-article.html.twig');
    }

    #[Route('/liste-articles', name:'list-articles')]

    // On utilise le 'ArticleRepository' pour afficher les données de la bdd
    public function displayListArticle(ArticleRepository $articleRepository) {

        // Récupère tout les articles enregistrés dans le tableau de la bdd
        $articles = $articleRepository->findAll();

        return $this->render('articles-list.html.twig', ['articles'=> $articles]);
    }

    #[Route('/article/{id}', name:'show-article')]
    
    public function showArticle(ArticleRepository $articleRepository, $id) {

        // Récupère les articles par leur id pour pouvoir en afficher qu'un
        $article = $articleRepository->find($id);

        if(!$article) {

            return $this->redirectToRoute('404');
        }

        return $this->render('show-article.html.twig', ['article' => $article]);
    }

    #[Route('/supprimer-article/{id}', name:'delete-article')]

    public function deleteArticle(ArticleRepository $articleRepository, EntityManagerInterface $entityManager, $id) {

        $article = $articleRepository->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

        $this->addFlash("success", "L'article a été supprimé");

        return $this->redirectToRoute('list-articles');
    }
}