<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */

// Héritage de la classe 'ServiceEntityRepository' de Doctrine
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        // Appel du parent 'ServiceEntityRepository' qui gère l'entity 'Article'
        parent::__construct($registry, Article::class);
    }

    public function sortArticlesByDate()
    {
        $articles = $this->findAll();

        // Trie les articles par date de création dans un ordre décroissant
        usort($articles, function ($a, $b) {
            // Crée des objets DateTime à partir des dates de création
            $dateA = $a->getCreatedAt();
            $dateB = $b->getCreatedAt();
            return $dateB <=> $dateA; // Compare les dates et les retourne dans l'ordre décroissant (plus récent au plus vieux)
        });

        return $articles;
    }
}