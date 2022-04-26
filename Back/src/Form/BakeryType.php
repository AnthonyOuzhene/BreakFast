<?php

namespace App\Form;

use App\Entity\Bakery;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BakeryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'nom'
            ])
            ->add('address', TextType::class, [
                'label' => 'adresse'
            ])
            ->add('profile_img', UrlType::class, [
                'label' => 'photo de la boutique'
            ])
            ->add('phone_number', NumberType::class, [
                'label' => 'numéro de téléphone'
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'note',
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                ],
                'multiple' => false,
                'expanded' => false
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'statut',
                'choices'  => [
                    'Activé' => '1',
                    'Desactivé' => '0'
                ],
                'expanded' => true
                ])
            ->add('delivery_fees', NumberType::class, [
                'label' => 'frais de livraison'
            ])
            ->add('delivery_time', NumberType::class, [
                'label' => 'délai de livraison'
            ])
            ->add('user', EntityType::class, [
                'label' => 'utilisateur',
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bakery::class,
        ]);
    }
}
