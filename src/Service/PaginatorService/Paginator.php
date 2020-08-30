<?php

declare(strict_types=1);

namespace App\Service\PaginatorService;

use App\Model\Pagination;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Paginator
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * Paginator constructor.
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Create pagination.
     */
    public function createPagination(
        string $routeName,
        int $count,
        int $page,
        int $totalRows
    ): Pagination {
        $pagination = new Pagination();
        $totalPages = ceil($totalRows / $count);

        $pagination->setFirst($this->generateUrl($routeName, 1, $count));
        $pagination->setLast($this->generateUrl($routeName, (int) $totalPages, $count));
        $pagination->setPrev($this->generateUrl(
                $routeName,
                $page > 1 ? $page - 1 : 1,
                $count
            )
        );
        $pagination->setNext($this->generateUrl(
                $routeName,
                $page < $totalPages ? $page + 1 : $totalPages,
                $count
            )
        );

        return $pagination;
    }

    /**
     * Return generated url.
     */
    private function generateUrl(string $routeName, int $page, int $count): string
    {
        return $this->urlGenerator->generate($routeName, [
            'page' => $page,
            'count' => $count,
        ], UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
