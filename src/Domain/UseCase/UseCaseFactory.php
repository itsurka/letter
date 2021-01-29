<?php

declare(strict_types=1);

namespace App\Domain\UseCase;


class UseCaseFactory
{
    /** @var array */
    protected $useCases = [];

    public function __construct(iterable $useCases)
    {
        /** @var UseCaseInterface $useCase */
        foreach ($useCases as $useCase) {
            $this->useCases[$useCase::getMethod()] = $useCase;
        }
    }

    public function getUseCase(string $method): UseCaseInterface
    {
        $useCase = $this->useCases[$method] ?? null;
        if ($useCase === null) {
            throw new \Exception('Use case not found: ' . $method);
        }

        return $useCase;
    }
}