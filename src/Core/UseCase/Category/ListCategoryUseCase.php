<?php
namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\CategoryOutputDto;
use Core\UseCase\DTO\Category\CategoryOutupDto;

class ListCategoryUseCase {

    public function __construct(protected CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    } 

    public function execute(CategoryInputDto $input): CategoryOutputDto
    {

         $category = $this->repository->findById($input->id);

         return new CategoryOutputDto(
            id: $category->id,
            name: $category->name,
            description: $category->description,
            is_active: $category->isActive
         );


    }

}