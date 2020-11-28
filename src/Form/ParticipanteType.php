<?php


namespace App\Form;



use App\Entity\Competencia;
use App\Entity\Participante;
use App\Utils\Form\DataTransformer\ObjectToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Validator\Constraints as Assert;

class ParticipanteType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){

        $competenciaTransformer = new ObjectToIdTransformer($options['em'], Competencia::class);

        $builder
            ->add('nombre')
            ->add('email', Type\EmailType::class,[
                'label' => 'Email',
                'constraints' =>[
                    new Assert\Email([
                        'message'=>'El formato del email no es correcto. Ingrese un email válido'
                    ])
                ]])
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
