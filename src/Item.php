<?php

namespace Ottaviano\Comparator;

class Item implements ItemInterface
{
    private $key;
    private $previousValue;
    private $value;
    private $isModified = false;
    private $isDeleted = false;
    private $isAdded = true;
    private $children = [];

    private $valueInitialized = false;

    public function getKey()
    {
        return $this->key;
    }

    public function getPreviousValue()
    {
        return $this->previousValue;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function isModified(): bool
    {
        return $this->isModified;
    }

    public function isAdded(): bool
    {
        return $this->isAdded;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function setKey($key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setValue($value): ItemInterface
    {
        if (true === $this->valueInitialized) {
            $this->isModified = $this->value !== $value;
            $this->isAdded = false;
        } else {
            $this->valueInitialized = true;
        }

        $this->previousValue = $this->value;
        $this->value = $value;

        return $this;
    }

    public function markAsDeleted(): void
    {
        $this->isDeleted = true;
        $this->isAdded = false;
        $this->isModified = false;
    }

    public function hasChildren(): bool
    {
        return !empty($this->children);
    }

    public function setChildren(array $items): self
    {
        if (true === $this->valueInitialized) {
            $this->isModified = !empty(array_filter($items, function (ItemInterface $item) {
                return $item->isModified();
            }));
            $this->isAdded = false;
        } else {
            $this->valueInitialized = true;
        }

        $this->children = $items;

        return $this;
    }
}
