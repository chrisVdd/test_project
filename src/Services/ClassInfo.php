<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\PropertyInfo\DoctrineExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

class ClassInfo
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getClassInfo($className)
    {
        $doctrineExtractor      = new DoctrineExtractor($this->entityManager);
        $phpDocExtractor        = new PhpDocExtractor();
        $reflectionExtractor    = new ReflectionExtractor();

        return new PropertyInfoExtractor(
            [$reflectionExtractor, $doctrineExtractor],
            [$doctrineExtractor, $phpDocExtractor, $reflectionExtractor],
//            [$phpDocExtractor],
//            [$reflectionExtractor]
        );
    }
}