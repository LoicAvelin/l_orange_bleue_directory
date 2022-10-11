<?php

namespace App\Form;

use App\Entity\Permissions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionsType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add("name", TextType::class, ["label" => "Nom"])
      ->add("description", TextType::class, ["label" => "Description"])
      ->add("Valider", SubmitType::class, [
        "attr" => ["class" => "form__input--button"]
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      "data_class" => Permissions::class,
    ]);
  }
}