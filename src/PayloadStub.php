<?php

declare(strict_types=1);

namespace EventSauce\EventSourcing;

use function compact;
use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class PayloadStub implements SerializablePayload
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toPayload(): array
    {
        return ['value' => $this->value];
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new static($payload['value']);
    }

    public static function create(string $value = null): PayloadStub
    {
        /** @var PayloadStub */
        return static::fromPayload(compact('value'));
    }
}
