<?php

namespace Archilex\StackedImageColumn\Columns\Concerns;

use Closure;

trait HasRemaining
{
    protected bool | Closure $shouldShowRemaining = false;

    protected bool | Closure $shouldShowRemainingAfterStack = false;

    protected string | Closure | null $remainingTextSize = null;

    public function showRemaining(bool | Closure $condition = true, bool | Closure $showRemainingAfterStack = false, string | Closure $remainingTextSize = null): static
    {
        $this->shouldShowRemaining = $condition;
        $this->showRemainingAfterStack($showRemainingAfterStack);
        $this->remainingTextSize($remainingTextSize);

        return $this;
    }

    public function showRemainingAfterStack(bool | Closure $condition = true): static
    {
        $this->shouldShowRemainingAfterStack = $condition;

        return $this;
    }

    public function shouldShowRemaining(): bool
    {
        return (bool) $this->evaluate($this->shouldShowRemaining);
    }

    public function shouldShowRemainingAfterStack(): bool
    {
        return (bool) $this->evaluate($this->shouldShowRemainingAfterStack);
    }

    public function remainingTextSize(string | Closure | null $remainingTextSize): static
    {
        $this->remainingTextSize = $remainingTextSize;

        return $this;
    }

    public function getRemainingTextSize(): ?string
    {
        return $this->evaluate($this->remainingTextSize);
    }
}
