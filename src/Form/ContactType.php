<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom', 'attr' => ['placeholder' => 'nom', 'class' => 'form-control'],
                'constraints' => [new NotBlank(), new Length(['min' => 3, 'max' => 255])]
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => ['placeholder' => 'prénom', 'class' => 'form-control'],
                'constraints' => [new NotBlank(), new Length(['min' => 3, 'max' => 255])]
            ])
            ->add('tel', TelType::class, [
                'label' => 'N° de téléphone',
                'attr' => ['placeholder' => 'tel', 'class' => 'form-control'],
                'constraints' => [new NotBlank()]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'attr' => ['placeholder' => 'e-mail', 'class' => 'form-control'],
                'constraints' => [new NotBlank(), new Email()]
            ])
            ->add('subject', TextType::class, [
                'label' => 'Objet',
                'attr' => ['placeholder' => 'objet', 'class' => 'form-control'],
                'constraints' => [new NotBlank(), new Length(['min' => 3, 'max' => 255])]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => ['rows' => 8, 'class' => 'form-control'],
                'constraints' => [new NotBlank(), new Length(['min' => 3])]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn btn-lg btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
