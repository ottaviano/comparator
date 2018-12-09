<?php

namespace Ottaviano\Comparator\Exporter;

use Ottaviano\Comparator\ItemInterface;

interface ExporterInterface
{
    /** @param ItemInterface[] */
    public function export(array $items): array;
}
