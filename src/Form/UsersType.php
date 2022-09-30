<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('email', EmailType::class)
      ->add('roles', CollectionType::class, [
        'entry_type' => ChoiceType::class,
        'entry_options' => [
          'choices' => [
            'Responsable d\'une salle de sport' => 'ROLE_MANAGER',
            'Partenaire' => 'ROLE_PARTNER',
            'Equipe technique' => 'ROLE_ADMIN'
          ]
        ] ,
        'label' => 'Type de compte'
      ])
      ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
      ->add('name', TextType::class, ['label' => 'Nom'])
      ->add('phone_number', TelType::class, ['label' => 'Numéro de téléphone'])
      ->add('is_active', CheckboxType::class, [
        'label' => 'Souhaitez-vous activer le compte ? (cocher la case pour l\'activer)',
        'required' => false
      ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Users::class,
    ]);
  }
}