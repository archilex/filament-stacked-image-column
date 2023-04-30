<?

namespace Archilex\ImageGroupColumn\Columns\Concerns;

use Closure;

trait HasRemaining
{
    protected bool | Closure $shouldShowRemaining = false;

    protected bool | Closure $shouldShowRemainingAsText = false;

    protected string | Closure | null $remainingTextSize = null;
    
    public function showRemaining(bool | Closure $condition = true, bool | Closure $showRemainingAsText = false, string | Closure | null $remainingTextSize = null): static
    {
        $this->shouldShowRemaining = $condition;
        $this->showRemainingAsText($showRemainingAsText);
        $this->remainingTextSize($remainingTextSize);

        return $this;
    }

    public function showRemainingAsText(bool | Closure $condition = true): static
    {
        $this->shouldShowRemainingAsText = $condition;

        return $this;
    }

    public function shouldShowRemaining(): bool
    {
        return $this->evaluate($this->shouldShowRemaining);
    }

    public function shouldShowRemainingAsText(): bool
    {
        return $this->evaluate($this->shouldShowRemainingAsText);
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