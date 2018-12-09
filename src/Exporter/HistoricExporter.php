<?php

namespace Ottaviano\Comparator\Exporter;

use Ottaviano\Comparator\ItemInterface;

class HistoricExporter extends PlusMinusExporter
{
    protected function getValue(ItemInterface $item)
    {
        if ($item->isModified()) {
            return [
                $item->getPreviousValue(),
                $item->getValue(),
            ];
        }

        return parent::getValue($item);
    }
}
