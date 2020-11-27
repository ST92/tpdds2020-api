<?php


namespace App\Form;



use App\Entity\Participante;
use App\Utils\Form\DataTransformer\ObjectToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipanteType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){

        $competenciaTransformer = new ObjectToIdTransformer($options['em'], Competencia::class);

        $builder
            ->add('nombre')
            ->add('email')
            ->add($builder->create('competenciaId', TextType::class)->addModelTransformer($competenciaTransformer));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participante::class,
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
