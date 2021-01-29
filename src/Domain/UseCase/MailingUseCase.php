<?php

declare(strict_types=1);

namespace App\Domain\UseCase;


use App\Domain\Data\UserIteratorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class MailingUseCase implements UseCaseInterface
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
        foreach ($this->userIterator as $user) {
            if (in_array($user['user_id'], $userIds)) {
                continue;
            }
            $userIds[] = $user['user_id'];

            echo $this->twig->render('mailing.html.twig', [
                'targetEmail' => $user['email'],
                'name' => $user['name'],
            ]) . PHP_EOL . PHP_EOL;
        }
    }

    public static function getMethod(): string
    {
        return 'mailing';
    }
}