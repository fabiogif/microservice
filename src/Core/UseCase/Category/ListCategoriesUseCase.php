<?php
namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategoriesOutputDto;

class ListCategoriesUseCase {

    public function __construct(protected CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    } 

    public function execute(ListCategoriesInputDto $input) :ListCategoriesOutputDto
    {
        $categories = $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage);

         return new ListCategoriesOutputDto(
            filter: $categories->filter,
            order: $categories->order,
            page: $categories->page,
            totalPage: $categories->totalPage
         );
    }



}