<?php

namespace Archilex\ImageGroupColumn\Columns\Concerns;

use Closure;

trait HasOverlap
{
    protected string | Closure | null $overlap = null;

    public function overlap(string | Closure | null $overlap): static
    {
        $this->overlap = $overlap;

        return $this;
    }

    public function getOverlap(): ?string
    {
        return $this->evaluate($this->overlap);
    }
}