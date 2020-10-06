<?php

namespace App\Form;


use App\Entity\Competencia;
use App\Entity\Deporte;
use App\Entity\EstadoCompetencia;
use App\Entity\TipoCompetencia;
use App\Entity\TipoPuntuacion;
use App\Entity\Usuario;
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

        $deporteTransformer = new EntityToIdObjectTransformer($options['em'], Deporte::class);
        $usuarioTransformer = new EntityToIdObjectTransformer($options['em'], Usuario::class);
        $tipoCompetenciaTransformer = new EntityToIdObjectTransformer($options['em'], TipoCompetencia::class);
        $estadoCompetenciaTransformer = new EntityToIdObjectTransformer($options['em'], EstadoCompetencia::class);
        $tipoPuntuacionTransformer = new EntityToIdObjectTransformer($options['em'], TipoPuntuacion::class);

        //Fecha de baja y estado es interno
        //TODO Falta agregar las validaciones en puntos, y sobre nombre.
        //TODO agregar participante Controller

        $builder
            ->add('nombre')
            ->add('reglamento')
            ->add('permite_empate')
            ->add('ptos_ganado')
            ->add('ptos_empate')
            ->add('ptos_presentacion')
            ->add('ptos_ausencia')
            ->add('cantidad_sets')
            ->add($builder->create('deporte', TextType::class)->addModelTransformer($deporteTransformer))
            ->add($builder->create('usuario', TextType::class)->addModelTransformer($usuarioTransformer))
            ->add($builder->create('tipo_competencia', TextType::class)->addModelTransformer($tipoCompetenciaTransformer))
            ->add($builder->create('estado_competencia', TextType::class)->addModelTransformer($estadoCompetenciaTransformer))
            ->add($builder->create('tipo_puntuacion', TextType::class)->addModelTransformer($tipoPuntuacionTransformer))
            ->add('sedes_competencia', CollectionType::class, [
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
            'constraints' => [
                new Callback([$this, 'validate']),
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

    /**
     * Validaciones:
     *      Para todos -> No nulo: nombre_competencia, deporte, lugares, modealidad
     *          opcional: reglamento
     *
     *  - Sistema liga -> No nulo: ptos_ganado, permite_empate, ptos_empate,ptos_presentacion,
     *  - Eliminacion simple -> No nulo: forma puntuacion. El resto no debe considerarse (no empate, no puntos por presentarse, no puntos por partido ganado)
     *
     * -Puntuación:
     *      -Sets -> No nulo: cantidad_sets
     *      -Puntuación -> No nulo: ptos_ausencia
     *
     * -nombre_competencia unico -> UniqueEntity
     * -cantidad_set -> impar y <10
     * -ptos_ganado > ptos_empate
     * -ptos_presentacion < ptos_ganado
     *
     * @param array<string,mixed> $data
     * @param ExecutionContextInterface $context
     */
    public function validate(array $data, ExecutionContextInterface $context): void
    {
        //TODO Ver como se enviará tipo_puntuacion desde el front end.
        if ($data['tipo_puntuacion']== 1 && $data['cantidad_sets']%2 ==1 || $data['cantidad_sets'] > 10) {
            $context->buildViolation('Cantidad de Sets debe ser un número impar y menor a 10')
                ->atPath('cantidad_sets')
                ->addViolation();
        }

        if ($data['tipo_competencia'] == 1 && $data['ptos_ganado']< $data['ptos_empate']) {
            $context->buildViolation('Puntos por Partido Ganado debe ser mayor que Puntos por Empate')
                ->atPath('ptos_ganado')
                ->addViolation();
        }

        if ($data['tipo_puntuacion']== 1 && $data['ptos_presentacion'] >= $data['ptos_ganado']){
            $context->buildViolation('Puntos por Presentarse debe ser menor que Puntos por Partido Ganado')
                ->atPath('cantidad_sets')
                ->addViolation();
        }

    }
}
