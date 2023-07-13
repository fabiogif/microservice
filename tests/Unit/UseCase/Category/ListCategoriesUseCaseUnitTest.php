<?php

namespace Test\Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\Interface\PaginationInterface;
use Core\UseCase\Category\ListCategoriesUseCase;
use Core\UseCase\DTO\Category\{ListCategoriesInputDto , ListCategoriesOutputDto};
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testListCategoriesEmpty()
    {
        $mock = Mockery::mock('MyClass');
        $mock->shouldReceive('name_of_method');


        $mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class);
        $mockPagination->shouldReceive('items')->andReturn([]);

        $mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepo->shouldReceive('paginate')->andReturn($mockPagination);

        $mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter'. 'order']);

        $useCase = new ListCategoriesUseCase($mockRepo);
        $responseUseCase = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(ListCategoriesOutputDto::class, $responseUseCase);
        $this->assertCount(0, count($responseUseCase->items));

    }


}
