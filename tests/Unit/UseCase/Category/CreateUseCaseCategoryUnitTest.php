<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateDtoInput;
use Core\UseCase\DTO\Category\CategoryCreateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
      public function testCreateNewCategory()
    {
        $uuid = (string)Uuid::uuid4()->toString();
        $categoryName = 'Category Name';
     
        $mockEntity = Mockery::mock(Category::class, [$uuid, $categoryName]);
        $mockEntity->shouldReceive('id')->andReturn($uuid);


        $mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepo->shouldReceive('insert')->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CategoryCreateDtoInput::class, [$categoryName]);

        $useCase = new CreateCategoryUseCase($mockRepo);

        $reponseUseCase = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDto::class, $reponseUseCase);
        $this->assertEquals($categoryName, $reponseUseCase->name);
        $this->assertEquals('', $reponseUseCase->description);

        Mockery::close();
    }
}
