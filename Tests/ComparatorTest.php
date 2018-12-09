<?php

namespace Test\Ottaviano\Comparator;

use Ottaviano\Comparator\Comparator;
use Ottaviano\Comparator\ComparatorInterface;
use Ottaviano\Comparator\Exporter\ExporterInterface;
use Ottaviano\Comparator\ItemInterface;
use PHPUnit\Framework\TestCase;

class ComparatorTest extends TestCase
{
    /** @var ComparatorInterface */
    private $comparator;

    protected function setUp(): void
    {
        $this->comparator = new Comparator();
    }

    public function testCompareReturnAnArray(): void
    {
        $a = $b = [];

        self::assertIsArray($this->comparator->compare($a, $b));
    }

    public function testCompareReturnsTheSameNumberOfItemsAstTheKeys(): void
    {
        $a = [
            1 => 1,
            10 => 2,
            15 => 3,
        ];
        $b = [10 => 1];

        self::assertCount(3, $this->comparator->compare($a, $b));
    }

    public function testCompareReturnsItemInterfaceItemsIfExporterIsNull(): void
    {
        self::assertContainsOnlyInstancesOf(ItemInterface::class, $this->comparator->compare([1], []));
    }

    public function testCompareFlagsItemAsDeleted(): void
    {
        $items = $this->comparator->compare([1], []);

        self::assertTrue($items[0]->isDeleted());
    }

    public function testCompareMarksItemAsModified(): void
    {
        $items = $this->comparator->compare([1], [2]);

        self::assertTrue($items[0]->isModified());
    }

    public function testCompareMarksItemAsAdded(): void
    {
        $items = $this->comparator->compare([], [2]);

        self::assertTrue($items[0]->isAdded());
    }

    public function testCompareCallsExporterSuccessfully(): void
    {
        $exporterMock = $this->createMock(ExporterInterface::class);
        $exporterMock->expects($this->once())->method('export');

        $this->comparator->setExporter($exporterMock);

        $this->comparator->compare(1, 2);
    }
}
