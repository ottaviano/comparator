<?php

namespace Ottaviano\Comparator;

interface ItemInterface
{

    /** @return self[] */
    public function getChildren(): array;

    /** @return mixed */
    public function getValue();

    /** @return mixed */
    public function getPreviousValue();

    public function hasChildren(): bool;

    public function isDeleted(): bool;

    public function isModified(): bool;

    public function isAdded(): bool;

    /** @return string|int */
    public function getKey();

    public function setValue($value): self;
}
