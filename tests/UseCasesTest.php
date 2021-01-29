<?php

declare(strict_types=1);

namespace App\Tests;


use App\Domain\Data\UserIteratorInterface;
use App\Domain\UseCase\AdminReportUseCase;
use App\Domain\UseCase\MailingUseCase;
use App\Domain\UseCase\UseCaseFactory;
use App\Domain\UseCase\UseCaseInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UseCasesTest extends KernelTestCase
{
    public function testFirst()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();
        /** @var UseCaseFactory $useCaseFactory */
        $useCaseFactory = $container->get(UseCaseFactory::class);

        /** @var AdminReportUseCase $adminReportUseCase */
        $adminReportUseCase = $useCaseFactory->getUseCase(AdminReportUseCase::getMethod());
        $adminReportData = $this->getUseCaseResult($adminReportUseCase);
        $this->assertNotEmpty($adminReportData);

        /** @var MailingUseCase $useCase */
        $mailingUseCase = $useCaseFactory->getUseCase(MailingUseCase::getMethod());
        $mailingData = $this->getUseCaseResult($mailingUseCase);
        $this->assertNotEmpty($mailingData);

        $users = $container->get(UserIteratorInterface::class);
        foreach ($users as $user) {
            $this->assertStringContainsString($user['email'], $adminReportData);
            $this->assertStringContainsString($user['name'], $adminReportData);
            $this->assertStringContainsString($user['email'], $mailingData);
        }
    }

    private function getUseCaseResult(UseCaseInterface $useCase): ?string
    {
        ob_start();
        $useCase->execute();
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}