<?php

namespace App\Form;

use App\Entity\Foto;
use App\Entity\Rol;
use App\Entity\Usuario;
use FOS\RestBundle\Form\Transformer\EntityToIdObjectTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $rolTransformer = new EntityToIdObjectTransformer($options['em'], Rol::class);
        $fotoTransformer = new EntityToIdObjectTransformer($options['em'], Foto::class);

        $builder
            ->add('nombre')
            ->add('email')
            ->add('celular')
            ->add('ctaCte')
            ->add('activo')
            ->add('emailValidado')
            ->add('password', null, [
                'required' => false,
                'mapped' => false
            ])
            ->add($builder->create('rol', TextType::class)->addModelTransformer($rolTransformer))
            ->add($builder->create('foto', TextType::class)->addModelTransformer($fotoTransformer));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
            'em' => null,
        ])
            ->setRequired('em');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
