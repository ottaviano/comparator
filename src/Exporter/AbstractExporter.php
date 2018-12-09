<?php

namespace Ottaviano\Comparator\Exporter;

use Ottaviano\Comparator\ItemInterface;

abstract class AbstractExporter implements ExporterInterface
{
    public function export(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            $key = $this->generateIndex($item);

            if ($item->hasChildren()) {
                $result[$key] = $this->export($item->getChildren());
            } else {
                $result[$key] = $this->getValue($item);
            }
        }

        return $result;
    }

    protected function generateIndex(ItemInterface $item)
    {
        return $item->getKey();
    }

    protected function getValue(ItemInterface $item)
    {
        return $item->getValue();
    }
}
