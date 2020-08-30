<?php

declare(strict_types=1);

namespace App\Model;

class Pagination
{
    /**
     * @var string
     */
    private $first;

    /**
     * @var string
     */
    private $last;

    /**
     * @var string
     */
    private $prev;

    /**
     * @var string
     */
    private $next;

    public function getFirst(): string
    {
        return $this->first;
    }

    public function setFirst(string $first): void
    {
        $this->first = $first;
    }

    public function getLast(): string
    {
        return $this->last;
    }

    public function setLast(string $last): void
    {
        $this->last = $last;
    }

    public function getPrev(): string
    {
        return $this->prev;
    }

    public function setPrev(string $prev): void
    {
        $this->prev = $prev;
    }

    public function getNext(): string
    {
        return $this->next;
    }

    public function setNext(string $next): void
    {
        $this->next = $next;
    }
}
