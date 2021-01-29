<?php

declare(strict_types=1);

namespace App\Out\Impl;


use App\Domain\Data\UserIteratorInterface;

class UserIterator implements UserIteratorInterface
{
    private $rows = [
        [
            'user_id' => 1,
            'email' => 'alex@mail.com',
            'age' => 67,
            'name' => 'Alex Norton',
        ],
        [
            'user_id' => 2,
            'email' => 'mary@gmail.com',
            'age' => 18,
            'name' => 'Marry Shawn',
        ],
        [
            'user_id' => 3,
            'email' => 'dan@ya.ru',
            'age' => 34,
            'name' => 'Dan Hoff',
        ],
        [
            'user_id' => 1,
            'email' => 'alex@mail.com',
            'age' => 67,
            'name' => 'Alex Norton',
        ],
    ];
    private $pos = 0;

    public function current()
    {
        return $this->rows[$this->pos];
    }

    public function next()
    {
        ++$this->pos;
    }

    public function key()
    {
        return $this->pos;
    }

    public function valid()
    {
        return isset($this->rows[$this->pos]);
    }

    public function rewind()
    {
        $this->pos = 0;
    }
}