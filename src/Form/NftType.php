<?php

namespace App\Form;

use App\Entity\Nft;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NftType extends AbstractType
{
    private array $categories;

    public function __construct(private CategoryRepository $categoryRepository) {
        $this->categories=$categoryRepository->findAll();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageUrl', TextType::class)
            ->add('name', TextType::class)
            ->add('price', NumberType::class)
            ->add('category', ChoiceType::class, [
                'choices' =>$this->categories,
                'choice_label' =>"name",
                'required'=>true, 
                'expanded'=>true,
                'multiple'=>true,
                'data'=>[""]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nft::class,
        ]);
    }
}
