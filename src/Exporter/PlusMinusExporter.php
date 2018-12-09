<?php

namespace Ottaviano\Comparator\Exporter;

use Ottaviano\Comparator\ItemInterface;

class PlusMinusExporter extends AbstractExporter
{
    protected function generateIndex(ItemInterface $item)
    {
        $prefix = '=';

        if ($item->isDeleted()) {
            $prefix = '-';
        } elseif ($item->isModified()) {
            $prefix = '*';
        } elseif ($item->isAdded()) {
            $prefix = '+';
        }

        return sprintf('[%s]%s', $prefix, parent::generateIndex($item));
    }
}
