<?php

namespace App\Form;

use App\Entity\Structures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructuresType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add("name", TextType::class, ["label" => "Nom"])
      ->add("address", TextType::class, ["label" => "Adresse postale"])
      ->add("phone_number", TelType::class, ["label" => "Numéro de téléphone"])
      ->add("Valider", SubmitType::class, [
        "attr" => ["class" => "form__input--button"]
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      "data_class" => Structures::class,
    ]);
  }
}