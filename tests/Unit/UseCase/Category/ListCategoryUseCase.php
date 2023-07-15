<?php

namespace Test\Unit\UseCase\Category;


use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ListCategoryUseCaseUnitTest extends TestCase
{
    public function testeGetById()
    {
        $uuid = (string)Uuid::uuid4()->toString();
        $categoryName = 'Teste Cateogry';

        $this->mockEntity = Mockery::mock(Category::class, [$uuid, $categoryName]);
    }
}
