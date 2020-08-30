<?php


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

    /**
     * @return string
     */
    public function getFirst(): string
    {
        return $this->first;
    }

    /**
     * @param string $first
     */
    public function setFirst(string $first): void
    {
        $this->first = $first;
    }

    /**
     * @return string
     */
    public function getLast(): string
    {
        return $this->last;
    }

    /**
     * @param string $last
     */
    public function setLast(string $last): void
    {
        $this->last = $last;
    }

    /**
     * @return string
     */
    public function getPrev(): string
    {
        return $this->prev;
    }

    /**
     * @param string $prev
     */
    public function setPrev(string $prev): void
    {
        $this->prev = $prev;
    }

    /**
     * @return string
     */
    public function getNext(): string
    {
        return $this->next;
    }

    /**
     * @param string $next
     */
    public function setNext(string $next): void
    {
        $this->next = $next;
    }
}