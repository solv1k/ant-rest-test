<?php

namespace App\DTO\Casters;

use Exception;
use Spatie\DataTransferObject\Caster;

class BaseCaster implements Caster
{
    /**
     * Класс для кастера.
     * 
     * @var string
     */
    private string $targetClass;

    public function __construct(string $targetClass)
    {
        $this->targetClass = $targetClass;
    }

    public function cast(mixed $value): mixed
    {
        if (! is_array($value)) {
            throw new Exception("В коллекцию DTO можно преобразовать только массив.");
        }

        return array_map(
            fn (array $data) => new $this->targetClass(...$data),
            $value
        );
    }
}