<?php

namespace App\Form;


use App\Entity\Competencia;
use App\Entity\Deporte;
use App\Entity\EstadoCompetencia;
use App\Entity\Sedes;
use App\Entity\SedesCompetencia;
use App\Entity\TipoCompetencia;
use App\Entity\TipoPuntuacion;
use App\Entity\Usuario;
use App\Utils\Form\DataTransformer\ObjectToIdTransformer;
use FOS\RestBundle\Form\Transformer\EntityToIdObjectTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SedesCompetenciaType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){

        $sedesTransformer = new ObjectToIdTransformer($options['em'], Sedes::class);

        $builder
            ->add('disponibilidad')
            ->add($builder->create('sedesId', TextType::class)->addModelTransformer($sedesTransformer));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SedesCompetencia::class,
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
