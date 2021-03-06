<?php

declare(strict_types=1);

namespace Chubbyphp\Negotiation;

final class NegotiatedValue implements NegotiatedValueInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var array<string, string>
     */
    private $attributes;

    /**
     * @param array<string, string> $attributes
     */
    public function __construct(string $value, array $attributes = [])
    {
        $this->value = $value;
        $this->attributes = $attributes;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return array<string, string>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
