<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// Formulaire créé grâce à la commande 'php bin/console make:form'
class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'attr' => ['placeholder' => 'Titre de la catégorie']])
            ->add('description', null, [
                'attr' => ['placeholder' => 'Description de la catégorie']])
            ->add('color', null, [
                'attr' => ['placeholder' => 'Ecrivez une couleur']])
            // Bouton de type submit pour valider l'envoi du formulaire
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
