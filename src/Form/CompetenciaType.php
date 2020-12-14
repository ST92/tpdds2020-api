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
            ->add('permiteEmpate')//,null, ['empty_data' => false])
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
                     * -nombre_competencia unico -> UniqueEntity.
                    */

                    if(count($data->getListaSedesCompetencia())<1){

                        $context->buildViolation('Se requiere cargar al menos una sede para la competencia. ')
                            ->atPath('listaSedesCompetencia')
                            ->addViolation();
                    }

                    /**
                     * Validaciones respecto a la modalidad.
                     */
                    switch ($data->getTipoCompetenciaId()->getId()){

                        case TipoCompetencia::LIGA:

                            /**
                             * Liga:
                             *
                             * -ptosGanado
                             * -PermiteEmpate
                             * -ptosPresentarse
                             * -ptos_ganado > ptos_empate
                             * -ptos_presentacion < ptos_ganado
                             *
                             * -Validar que si permite_empate es true, ptos_empate sea !=null
                             *
                             */
                            if (($data->getPtosGanado()==null) ||
                                ($data->isPermiteEmpate()==null) ||
                                ($data->getPtosPresentacion()==null)
                            ) {
                                $context->buildViolation('La competencia en modalidad Liga NO es válida. Revise los campos correspondientes a dicha modalidad.')
                                    ->atPath('tipoCompetenciaId')
                                    ->addViolation();
                            }

                            if ($data->isPermiteEmpate() && $data->getPtosEmpate()==null) {

                                $context->buildViolation('Si se permite el empate como resultado, Puntos por Empate no puede tener valor nulo')
                                    ->atPath('ptosEmpate')
                                    ->addViolation();

                            }

                            if (!$data->isPermiteEmpate() && $data->getPtosEmpate()!=null) {
                                $data->setPtosEmpate(null);
                            }

                            if ($data->getPtosEmpate()>=$data->getPtosGanado()) {
                                $context->buildViolation('Puntos por Partido Ganado debe ser mayor que Puntos por Empate')
                                    ->atPath('ptosEmpate')
                                    ->addViolation();
                            }

                            if ($data->getPtosPresentacion() >= $data->getPtosGanado()){
                                $context->buildViolation('Puntos por Partido Ganado debe ser mayor que Puntos por Presentarse')
                                    ->atPath('ptosPresentacion')
                                    ->addViolation();
                            }

                        break;

                        case TipoCompetencia::ELIMINACION_SIMPLE:
                        case TipoCompetencia::ELIMINACION_DOBLE:


                            /**
                             * Eliminación Simple o Doble:
                             *
                             * -tipoPuntuación:
                             *     -sets
                             *     -puntuacion -> ptosAusencia
                             *
                             * -Empate siempre debe ser false
                             */
                            if (($data->getPtosGanado()!=null) ||
                                ($data->getPtosPresentacion()!=null) ||
                                ($data->isPermiteEmpate()!=null && $data->isPermiteEmpate())
                            ) {
                                $context->buildViolation('La competencia en modalidad Eliminación Doble o Simple NO es válida. Revise los campos correspondientes a dicha modalidad.')
                                    ->atPath('tipoCompetenciaId')
                                    ->addViolation();
                            }


                        break;

                    }

                    /**
                     * Validación Respecto a los Campos de Puntuación
                     * -cantidad_set -> impar y <10 si tipo_puntuación == Sets
                     * -ptos_ausencia != nulo si tipo_puntuación == Puntuación
                     *
                     */

                    switch ($data->getTipoPuntuacionId()->getId()){

                        case TipoPuntuacion::SETS:

                            if ($data->getCantidadSets()==null || $data->getCantidadSets()%2 !=1 || $data->getCantidadSets() > 10) {
                                $context->buildViolation('Cantidad de Sets debe ser un número impar, mayor a 0 y menor a 10')
                                    ->atPath('cantidadSets')
                                    ->addViolation();
                            }

                        break;

                        case TipoPuntuacion::PUNTUACION:
                            if ($data->getPtosAusencia()==null) {
                                $context->buildViolation('Puntos por Ausencia no puede tener valor nulo.')
                                    ->atPath('ptosAusencia')
                                    ->addViolation();
                            }
                        break;

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
