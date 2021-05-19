<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('password')
            ->add('email')
            ->add('name')
            ->add('imageFile', VichImageType::class, [
                'label' => "Image (JPG ou PNG)",
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer ?',
                'download_label' => '',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'imagine_pattern' => 'updateThumbnailsUser',
                'attr' => ['class' => "form-control"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
