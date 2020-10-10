<?php

namespace App\Form;


use App\Entity\Competencia;
use App\Entity\Deporte;
use App\Entity\EstadoCompetencia;
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
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CompetenciaType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){

        $deporteTransformer = new ObjectToIdTransformer($options['em'], Deporte::class);
        $usuarioTransformer = new ObjectToIdTransformer($options['em'], Usuario::class);
        $tipoCompetenciaTransformer = new ObjectToIdTransformer($options['em'], TipoCompetencia::class);
        $tipoPuntuacionTransformer = new ObjectToIdTransformer($options['em'], TipoPuntuacion::class);



        $builder
            ->add('nombre')
            ->add('reglamento')
            ->add('permiteEmpate',null, ['empty_data' => false])
            ->add('ptosGanado')
            ->add('ptosEmpate')
            ->add('ptosPresentacion')
            ->add('ptosAusencia')
            ->add('cantidadSets')
            ->add($builder->create('deporteId', TextType::class)->addModelTransformer($deporteTransformer))
            ->add($builder->create('usuarioId', TextType::class)->addModelTransformer($usuarioTransformer))
            ->add($builder->create('tipoCompetenciaId', TextType::class)->addModelTransformer($tipoCompetenciaTransformer))
            ->add($builder->create('tipoPuntuacionId', TextType::class)->addModelTransformer($tipoPuntuacionTransformer))
            ->add('listaSedesCompetencia', CollectionType::class, [
                'entry_type' => SedesCompetenciaType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'entry_options' => [
                    'em' => $options['em']
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competencia::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
            'em' => null,
            'constraints' =>[
                new Callback(function(Competencia $data, ExecutionContextInterface $context)
                {
                    /**
                     * -nombre_competencia unico -> UniqueEntity
                     * -cantidad_set -> impar y <10
                     * -ptos_ganado > ptos_empate
                     * -ptos_presentacion < ptos_ganado
                     */
                    if ($data->getTipoPuntuacionId()->getId()== 1 && ($data->getCantidadSets()%2 ==1 || $data->getCantidadSets() > 10)) {
                        $context->buildViolation('Cantidad de Sets debe ser un número impar y menor a 10')
                            ->atPath('cantidadSets')
                            ->addViolation();
                    }

                    if ($data->getTipoCompetenciaId()->getId() == 1 && $data->getPtosEmpate()>=$data->getPtosGanado()) {
                        $context->buildViolation('Puntos por Partido Ganado debe ser mayor que Puntos por Empate')
                            ->atPath('ptosEmpate')
                            ->addViolation();
                    }

                    if ($data->getTipoCompetenciaId()->getId()== 1 && $data->getPtosPresentacion() >= $data->getPtosGanado()){
                        $context->buildViolation('Puntos por Partido Ganado debe ser mayor que Puntos por Presentarse')
                            ->atPath('ptosPresentacion')
                            ->addViolation();
                    }
                })
            ]
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
