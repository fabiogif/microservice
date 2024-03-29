<?php
namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategoriesOutputDto;

class ListCategoriesUseCase {

    public function __construct(protected CategoryRepositoryInterface $repository)
    {

    }

    public function execute(ListCategoriesInputDto $input) :ListCategoriesOutputDto
    {

        $categories = $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage);


        return new ListCategoriesOutputDto(
            items: array_map(function($data){
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'description' => $data->description,
                    'is_active' => $data->is_active
                ];
            },  $categories->items()),
                total: $categories->total(),
                last_page: $categories->lastPage(),
                first_page: $categories->firstPage(),
                per_page: $categories->perPage(),
                to: $categories->to(),
                from: $categories->from());
    }



}
