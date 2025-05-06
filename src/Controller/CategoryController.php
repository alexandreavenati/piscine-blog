<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {

    #[Route('/categories', name:'category-list')]
    public function displayListCategory(CategoryRepository $categoryRepository) {
        
        $categories = $categoryRepository->findAll();

        return $this->render('category-list.html.twig', ['categories' => $categories]);
    }

    #[Route('/categorie/{id}', name:'show-category')]
    public function showCategory(CategoryRepository $categoryRepository,$id) {

        $category = $categoryRepository->find($id);

        if(!$category) {

            return $this->redirectToRoute('404');
        }

        return $this->render('show-category.html.twig', ['category' => $category]);
    }
}