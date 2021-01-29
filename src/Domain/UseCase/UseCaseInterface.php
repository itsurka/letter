<?php

declare(strict_types=1);

namespace App\Domain\UseCase;


interface UseCaseInterface
{
    public function execute(): void;

    /**
     * @return string
     */
    public static function getMethod(): string;
}