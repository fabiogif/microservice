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
    public function testListCategories()
    {
        $register = new StdClass();
        $register->id = 1;
        $register->name = 'name';
        $register->description = 'description';
        $register->created_at = 'created_at';
        $register->updated_at = 'updated_at';
        $register->deleted_at = 'deleted_at';
        $register->is_active = 'is_active';


        $mockPagination = $this->mockPagination(
            [
                $register
            ]
        );

        $this->mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);

        $this->mockRepo->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, ['filter', 'desc']);

        $useCase = new ListCategoriesUseCase($this->mockRepo);

        $resposeUseCase = $useCase->execute($this->mockInputDto);

        $this->assertCount(1,$resposeUseCase->items);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $resposeUseCase);

        /**
         * Spies  - garatiando que o metodo chamado foi o paginate
         */

        $this->spy = Mockery::spy(StdClass::class, CategoryRepositoryInterface::class);
        $useCase = new ListCategoriesUseCase($this->spy);
        $this->spy->shouldReceive('paginate')->andReturn($mockPagination);


        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('paginate');

    }

    protected function mockPagination(array $items = [])
    {
        $this->mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn($items);
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
