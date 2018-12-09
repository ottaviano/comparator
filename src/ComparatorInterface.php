<?php

namespace Ottaviano\Comparator;

use Ottaviano\Comparator\Exporter\ExporterInterface;

interface ComparatorInterface
{
    /** @return ItemInterface[]|mixed[] */
    public function compare($a, $b): array;

    public function setExporter(ExporterInterface $exporter = null): void;
}
