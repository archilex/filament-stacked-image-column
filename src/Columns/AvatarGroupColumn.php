<?php

namespace Archilex\AvatarGroupColumn\Columns;

use Closure;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\HasSize;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\ComponentAttributeBag;
use League\Flysystem\UnableToCheckFileExistence;
use Throwable;

class AvatarGroupColumn extends Column
{
    use HasSize;

    protected string $view = 'filament-avatar-group-column::columns.avatar-group-column';
    
    protected string | Closure | null $disk = null;
    
    protected string | Closure $visibility = 'public';
    
    protected string | Closure | null $separator = null;
    
    protected int | Closure | null $limit = null;
    
    protected int | Closure | null $ring = null;

    protected string | Closure | null $overlap = null;

    protected bool $isCurator = false;

    protected bool | Closure $shouldShowRemaining = false;

    protected bool | Closure $shouldShowRemainingAsText = false;

    protected string | Closure | null $remainingTextSize = null;

    protected array $extraImgAttributes = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->disk(config('tables.default_filesystem_disk'));
    }

    public function disk(string | Closure | null $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function visibility(string | Closure $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getDisk(): Filesystem
    {
        return Storage::disk($this->getDiskName());
    }

    public function getDiskName(): string
    {
        return $this->evaluate($this->disk) ?? config('tables.default_filesystem_disk');
    }
    
    public function getImagePath($image): ?string
    {
        if (! $image) {
            return null;
        }

        if ($this->isCurator()) {
            $urlBuilder = \League\Glide\Urls\UrlBuilderFactory\UrlBuilderFactory::create('/curator/', config('app.key'));
            return $urlBuilder->getUrl($image['path'], ['w' => $this->getCuratorSizes(), 'h' => $this->getCuratorSizes(), 'fit' => 'crop', 'fm' => 'webp']);
        }

        if (filter_var($image, FILTER_VALIDATE_URL) !== false) {
            return $image;
        }

        /** @var FilesystemAdapter $storage */
        $storage = $this->getDisk();

        try {
            if (! $storage->exists($image)) {
                return null;
            }
        } catch (UnableToCheckFileExistence $exception) {
            return null;
        }

        if ($this->getVisibility() === 'private') {
            try {
                return $storage->temporaryUrl(
                    $image,
                    now()->addMinutes(5),
                );
            } catch (Throwable $exception) {
                // This driver does not support creating temporary URLs.
            }
        }

        return $storage->url($image);
    }

    public function getVisibility(): string
    {
        return $this->evaluate($this->visibility);
    }

    public function ring(string | Closure | null $ring): static
    {
        $this->ring = $ring;

        return $this;
    }

    public function getRing(): ?int
    {
        return $this->evaluate($this->ring);
    }

    public function overlap(string | Closure | null $overlap): static
    {
        $this->overlap = $overlap;

        return $this;
    }

    public function getOverlap(): ?string
    {
        return $this->evaluate($this->overlap);
    }

    public function extraImgAttributes(array | Closure $attributes, bool $merge = false): static
    {
        if ($merge) {
            $this->extraImgAttributes[] = $attributes;
        } else {
            $this->extraImgAttributes = [$attributes];
        }

        return $this;
    }

    public function getExtraImgAttributes(): array
    {
        $temporaryAttributeBag = new ComponentAttributeBag();

        foreach ($this->extraImgAttributes as $extraImgAttributes) {
            $temporaryAttributeBag = $temporaryAttributeBag->merge($this->evaluate($extraImgAttributes));
        }

        return $temporaryAttributeBag->getAttributes();
    }

    public function getExtraImgAttributeBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getExtraImgAttributes());
    }

    public function getImages(): array
    {        
        $images = $this->getState();

        if (is_array($images)) {
            return $images;
        }

        if (! ($separator = $this->getSeparator())) {
            return [];
        }

        $images = explode($separator, $images);

        if (count($images) === 1 && blank($images[0])) {
            $images = [];
        }

        return $images;
    }

    public function separator(string | Closure | null $separator = ','): static
    {
        $this->separator = $separator;

        return $this;
    }

    public function limit(int | Closure | null $limit = 3): static
    {
        $this->limit = $limit;

        return $this;
    }

    public function getSeparator(): ?string
    {
        return $this->evaluate($this->separator);
    }

    public function getLimit(): ?int
    {
        return $this->evaluate($this->limit);
    }

    public function curator(bool $condition = true): static
    {
        $this->isCurator = $condition;
        
        return $this;
    }

    public function isCurator(): bool
    {
        return $this->evaluate($this->isCurator);
    }

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

    protected function getCuratorSizes()
    {
        return match ($this->size) {
            'xs' => '32',
            'sm' => '40',
            'md' => '48',
            'lg' => '56',
            'xl' => '64',
            '2xl' => '80',
            '3xl' => '96',
            default => '56',
        };
    }
}
