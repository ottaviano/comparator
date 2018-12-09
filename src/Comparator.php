<?php

namespace Ottaviano\Comparator;

use Ottaviano\Comparator\Exporter\ExporterInterface;

class Comparator implements ComparatorInterface
{
    private $exporter;

    public function __construct(ExporterInterface $exporter = null)
    {
        $this->exporter = $exporter;
    }

    public function setExporter(ExporterInterface $exporter = null): void
    {
        $this->exporter = $exporter;
    }

    public function compare($a, $b): array
    {
        $a = (array) $a;
        $b = (array) $b;

        $items = $this->generateItems($a, $b);

        $this->delete($items, $b);

        return $this->exporter ? $this->exporter->export($items) : $items;
    }

    private function delete(array $items, array $data): void
    {
        foreach ($items as $item) {
            if (!array_key_exists($item->getKey(), $data)) {
                $item->markAsDeleted();
                continue;
            }
            if ($item->hasChildren()) {
                $this->delete($item->getChildren(), $data[$item->getKey()]);
            }
        }
    }

    private function generateItems(array $a, array $b): array
    {
        return $this->__($b, $this->__($a));
    }

    private function __(array $data, array $items = []): array
    {
        foreach ($data as $key => $value) {
            if (null === $item = $this->findItem($items, $key)) {
                $item = (new Item())->setKey($key);
                $items[] = $item;
            }

            if (is_array($value)) {
                $item->setChildren($this->__($value, $item->getChildren()));
            } else {
                $item->setValue($value);
            }
        }

        return $items;
    }

    private function findItem(array $items, $key): ?ItemInterface
    {
        foreach ($items as $item) {
            if ($item->getKey() === $key) {
                return $item;
            }
        }

        return null;
    }
}
