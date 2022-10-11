<?php

namespace App\Form;

use App\Entity\Permissions;
use App\Entity\PermissionsUsers;
use App\Entity\Users;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionsUsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("Users", EntityType::class, [
                "class" => Users::class,
                "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
            ])
            ->add("Permissions", EntityType::class, [
                "class" => Permissions::class,
                "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                }
            ])
            ->add("Valider", SubmitType::class, [
                "attr" => ["class" => "form__input--button"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PermissionsUsers::class,
        ]);
    }
}
