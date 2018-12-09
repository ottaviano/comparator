<?php

namespace Test\Ottaviano\Comparator;

use Ottaviano\Comparator\Item;
use Ottaviano\Comparator\ItemInterface;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /** @var ItemInterface */
    private $item;

    protected function setUp()
    {
        $this->item = new Item();
    }

    public function testSetValueSavePreviousValue(): void
    {
        $this->item->setValue('initial value');
        $this->item->setValue('newest value');

        self::assertSame('initial value', $this->item->getPreviousValue());
        self::assertSame('newest value', $this->item->getValue());

        self::assertFalse($this->item->isAdded());
        self::assertTrue($this->item->isModified());
    }
}
