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

        $mockPagination = $this->mockPagination();

        $this->mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);

        $this->mockRepo->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter', 'desc']);

        $useCase = new ListCategoriesUseCase($this->mockRepo);

        $resposeUseCase = $useCase->execute($this->mockInputDto);

        $this->assertCount(0,$resposeUseCase->items);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $resposeUseCase);
    }

    protected function mockPagination()
    {
        $this->mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn([]);
        $this->mockPagination->shouldReceive('total')->andReturn(0);
        $this->mockPagination->shouldReceive('lastPage')->andReturn(0);
        $this->mockPagination->shouldReceive('firstPage')->andReturn(0);
        $this->mockPagination->shouldReceive('perPage')->andReturn(0);
        $this->mockPagination->shouldReceive('to')->andReturn(0);
        $this->mockPagination->shouldReceive('from')->andReturn(0);

        return $this->mockPagination;

    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

}
