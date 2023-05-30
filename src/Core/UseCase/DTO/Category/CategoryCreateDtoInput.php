<?php

namespace Core\UseCase\DTO\Category;

class CategoryCreateDtoInput
{
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $is_active = true,
    ) {
    }
}
