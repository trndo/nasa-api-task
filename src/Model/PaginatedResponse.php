<?php


namespace App\Model;


use App\Model\Asteroid\AsteroidItem;

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

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return PaginatedResponse
     */
    public function setData(array $data): PaginatedResponse
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return Pagination
     */
    public function getLinks(): Pagination
    {
        return $this->links;
    }

    /**
     * @param Pagination $links
     * @return PaginatedResponse
     */
    public function setLinks(Pagination $links): PaginatedResponse
    {
        $this->links = $links;

        return $this;
    }


}