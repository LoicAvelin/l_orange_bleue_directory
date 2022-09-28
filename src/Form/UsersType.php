<?php

namespace App\Form;

use App\Entity\Users;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('email', TextType::class)
      //TODO: check the type for roles because it's json in the database
      ->add('roles', TextType::class)
      ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
      ->add('name', TextType::class, ['label' => 'Nom'])
      ->add('phone_number', TextType::class, ['label' => 'Numéro de téléphone'])
      ->add('created_at', DateTimeType::class, ['label' => 'Date de création'])
      ->add('is_active', TextType::class, ['label' => 'Actif']);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Users::class,
    ]);
  }
}