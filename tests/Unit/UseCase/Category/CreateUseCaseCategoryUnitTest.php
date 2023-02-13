<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class CreateCategoryUseCaseUnitTeste extends TestCase
{
    public function testCreateNewCategory()
    {
        $categoryId = '1';
        $categoryName = 'Outros';

        /*  $this->mockEntity = Mockery::mock(Category::class, [$categoryId, $categoryName]);
*/
        $this->mockRepo  = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('insert'); //->addReturn($this->mockEntity);


        $useCase = new CreateCategoryUseCase($this->mockRepo);
        $useCase->execute();

        $this->assertTrue(true);

        Mockery::close();
    }
}
