<?php

declare(strict_types=1);

namespace App\Model;

class PaginatedResponse
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var Pagination
     */
    private $links;

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getLinks(): Pagination
    {
        return $this->links;
    }

    public function setLinks(Pagination $links): self
    {
        $this->links = $links;

        return $this;
    }
}
