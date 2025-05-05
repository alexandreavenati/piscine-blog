<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use \DateTime;

// Héritage de la classe 'ServiceEntityRepository' de Doctrine
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        // Appel du parent 'ServiceEntityRepository' qui gère l'entity 'Article'
        parent::__construct($registry, Article::class);
    }

    public function findOneById($id)
    {

        $articles = $this->findAll();
        $article = $articles[$id];

        return $article;
    }

    public function sortArticlesByDate()
    {
        $articles = $this->findAll();

        // Trie les cocktails par date de création dans un ordre décroissant
        usort($articles, function ($a, $b) {
            // Crée des objets DateTime à partir des dates de création
            $dateA = new DateTime($a['date_creation']);
            $dateB = new DateTime($b['date_creation']);
            return $dateB <=> $dateA; // Compare les dates et les retourne dans l'ordre décroissant (plus récent au plus vieux)
        });

        return $articles;
    }
}