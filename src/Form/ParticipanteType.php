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
            'constraints' =>[
                new Callback(function(Participante $data, ExecutionContextInterface $context)
                {

                    $Sintaxis='#^[a-zA-z]+[\w.-]+@[\w.-]+\.[a-zA-Z]{2,20}$#';
                    //$Sintaxis='#^[a-zA-z]+[a-zA-z0-9.-]+@[\w.-]+\.[a-zA-Z]{2,20}$#';
                    if(!preg_match($Sintaxis,$data->getEmail())){

                        $context->buildViolation('El email ingresado no posee una estructura válida. Ingrese de nuevo el email.')
                            ->atPath('email')
                            ->addViolation();

                    }

                    if($data->getNombre()==null || $data->getNombre()==""){
                        $context->buildViolation('El nombre ingresado no posee una estructura válida. Ingrese de nuevo el nombre.')
                            ->atPath('nombre')
                            ->addViolation();
                    }


                })]
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
