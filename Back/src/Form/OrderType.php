<?php

namespace App\Form;

use App\Entity\Bakery;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('total_price', NumberType::class)
                ->add('order_date', DateType::class, [
                    'widget' => 'single_text',
                    'data' => new \DateTime(),
                    'input'  => 'datetime',
                ])
                ->add('user', EntityType::class, [
                    'class' => User::class,
                    'attr' => ['class' => 'form-control'],
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->orderBy('u.name', 'ASC');
                    },
                    'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => false,
            ])
                ->add('product', null, [
                    'class' => Product::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.name', 'ASC');
                    },
                    'choice_label' => 'custom',
                    'multiple' => true,
                    'expanded' => true,

                ]);
        
        // // Add 2 event listeners for the form
        // $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        // $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }
    
    // protected function addElements(FormInterface $form, Bakery $bakery = null) {
    //     // Add the product element
    //     $form->add('product', EntityType::class, array(
    //         'required' => true,
    //         'data' => $bakery,
    //         'placeholder' => 'Select a Bakery...',
    //         'class' => Bakery::class
    //     ));
        
    //     // Products empty, unless there is a selected Bakery (Edit View)
    //     $products = array();
        
    //     // If there is a bakery stored in the Order entity, load the products of it
    //     if ($bakery) {
    //         // Fetch Products of the Bakery if there's a selected bakery
    //         $repoProducts = $this->em->getRepository(Product::class);
            
    //         $products = $repoProducts->createQueryBuilder("b")
    //             ->where("b.bakery = :bakeryid")
    //             ->setParameter("bakeryid", $bakery->getId())
    //             ->getQuery()
    //             ->getResult();
    //     }
        
    //     // Add the Products field with the properly data
    //     $form->add('product', EntityType::class, array(
    //         'required' => true,
    //         'placeholder' => 'Select a Bakery first ...',
    //         'class' => Product::class,
    //         'choices' => $products,
    //     ));
    // }
    
    // function onPreSubmit(FormEvent $event) {
    //     $form = $event->getForm();
    //     $data = $event->getData();
        
    //     // Search for selected Bakery and convert it into an Entity
    //     $bakery = $this->em->getRepository(Bakery::class)->find($data['bakery']);
        
    //     $this->addElements($form, $bakery);
    // }

    // function onPreSetData(FormEvent $event) {
    //     $order = $event->getData();
    //     $form = $event->getForm();

    //     // When you create a new order, the Product is always empty
    //     $product = $order->getProduct() ? $order->getProduct() : null;
        
    //     $this->addElements($form, $product);
    // }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
