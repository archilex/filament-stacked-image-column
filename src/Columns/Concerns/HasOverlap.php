<?php

namespace Archilex\StackedImageColumn\Columns\Concerns;

use Closure;

trait HasOverlap
{
    protected int|Closure|null $overlap = null;

    public function overlap(int|Closure|null $overlap): static
    {
        $this->overlap = $overlap;

        return $this;
    }

    public function getOverlap(): ?int
    {
        return $this->evaluate($this->overlap);
    }
}
