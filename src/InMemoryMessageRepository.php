<?php

namespace EventSauce\EventSourcing;

use Generator;

class InMemoryMessageRepository implements MessageRepository
{
    /**
     * @var Message[]
     */
    private $messages = [];

    /**
     * @var Event[]
     */
    private $lastCommit = [];

    /**
     * @return Event[]
     */
    public function lastCommit(): array
    {
        return $this->lastCommit;
    }

    public function purgeLastCommit()
    {
        $this->lastCommit = [];
    }

    public function persist(Message ... $messages)
    {
        $this->lastCommit = [];

        /** @var Message $event */
        foreach ($messages as $message) {
            $this->messages[] = $message;
            $this->lastCommit[] = $message->event();
        }
    }

    public function retrieveAll(AggregateRootId $id): Generator
    {
        foreach ($this->messages as $message) {
            if ($id->equals($message->metadataValue('aggregate_root_id'))) {
                yield $message;
            }
        }
    }
}