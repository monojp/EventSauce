<?php

namespace Group\With\Defaults;

use EventSauce\EventSourcing\Event;

final class EventWithDescription implements Event
{
    /**
     * @var string
     */
    private $description;

    public function __construct(
        string $description
    ) {
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }
    public static function fromPayload(array $payload): Event
    {
        return new EventWithDescription(
            (string) $payload['description']);
    }

    public function toPayload(): array
    {
        return [
            'description' => (string) $this->description,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public function withDescription(string $description): EventWithDescription
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     */
    public static function with(): EventWithDescription
    {
        return new EventWithDescription(
            (string) 'This is a description.'
        );
    }
}
