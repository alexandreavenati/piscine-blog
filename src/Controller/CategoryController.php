<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/categories', name: 'category-list')]
    public function displayListCategory(CategoryRepository $categoryRepository)
    {

        $categories = $categoryRepository->findAll();

        return $this->render('category-list.html.twig', ['categories' => $categories]);
    }

    #[Route('/categorie/{id}', name: 'show-category')]
    public function showCategory(CategoryRepository $categoryRepository, $id)
    {

        $category = $categoryRepository->find($id);

        if (!$category) {

            return $this->redirectToRoute('404');
        }

        return $this->render('show-category.html.twig', ['category' => $category]);
    }

    #[Route('/creer-categorie', name: 'category-form')]
    public function displayCreateCategory(Request $request, EntityManagerInterface $entityManager)
    {

        // Nouvelle instance de classe 'Category'
        $category = new Category();

        // Création du formulaire en utilisant la structure de 'CategoryFormType' et l'instance de Category
        $categoryForm = $this->createForm(CategoryFormType::class, $category);

        // Varaible qui stocke les données envoyées du formulaire
        $categoryForm->handleRequest($request);

        // Vérifie si il y a des données envoyées en 'POST'
        if ($categoryForm->isSubmitted()) {

            // Ajout de la date automatique (obligatoire car la date est 'NOT NULL' dans la bdd)
            $category->setCreatedAt(new \DateTime()); 

            // Sauvegarde la nouvelle catégorie et la pousse dans le tableau correspondant de la bdd
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('category_created', 'Catégorie : "' . $category->getTitle() . '" a été enregistré.');
        }

        return $this->render('create-category.html.twig', ['categoryForm' => $categoryForm->createView()]);
    }
}
