<?php

declare(strict_types=1);

namespace App\Domain\UseCase;


use App\Domain\Data\UserIteratorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class AdminReportUseCase implements UseCaseInterface
{
    /** @var UserIteratorInterface */
    private $userIterator;

    /** @var Environment */
    private $twig;

    /** @var ParameterBagInterface */
    private $parameterBag;

    public function __construct(UserIteratorInterface $userIterator, Environment $twig, ParameterBagInterface $parameterBag)
    {
        $this->userIterator = $userIterator;
        $this->twig = $twig;
        $this->parameterBag = $parameterBag;
    }

    public function execute(): void
    {
        $this->userIterator->rewind();
        $userIds = [];
        $names = [];
        $ages = [];
        $emails = [];
        foreach ($this->userIterator as $user) {
            if (in_array($user['user_id'], $userIds)) {
                continue;
            }
            $userIds[] = $user['user_id'];
            $names[] = $user['name'];
            $ages[] = $user['age'];
            $emails[] = $user['email'];
        }

        echo $this->twig->render('report.html.twig', [
            'targetEmail' => $this->parameterBag->get('emails.admin'),
            'names' => implode(', ', $names),
            'ages' => implode(', ', $ages),
            'emails' => implode(', ', $emails),
        ]);
    }

    public static function getMethod(): string
    {
        return 'report';
    }
}