<?php


namespace App\Utils\Form\DataTransformer;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ObjectToIdTransformer implements DataTransformerInterface{

    private $entityManager;
    private $clase;

    public function __construct(EntityManagerInterface $entityManager, $clase)
    {
        $this->entityManager = $entityManager;
        $this->clase = $clase;
    }

    /**
     * @inheritDoc
     */
    public function transform($object)
    {
        if (null === $object) {
            return '';
        }

        return $object->getId();
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($objectId)
    {
        // no issue number? It's optional, so that's ok
        if (!$objectId) {
            return null;
        }

        $object = $this->entityManager
            ->getRepository($this->clase)
            // query for the issue with this id
            ->find($objectId)
        ;

        if (null === $object) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An object with number "%s" does not exist!',
                $objectId
            ));
        }

        return $object;
    }
}