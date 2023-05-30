<?php

namespace Archilex\StackedImageColumn\Columns;

use Archilex\StackedImageColumn\Columns\Concerns\HasOverlap;
use Archilex\StackedImageColumn\Columns\Concerns\HasRemaining;
use Archilex\StackedImageColumn\Columns\Concerns\HasRing;
use Closure;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\ComponentAttributeBag;
use League\Flysystem\UnableToCheckFileExistence;
use Throwable;

class StackedImageColumn extends ImageColumn
{
    use HasOverlap;
    use HasRemaining;
    use HasRing;

    protected string $view = 'filament-stacked-image-column::columns.stacked-image-column';

    protected string | Closure | null $disk = null;

    protected string | Closure $visibility = 'public';

    protected string | Closure | null $separator = null;

    protected int | Closure | null $limit = null;

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

    public function getDisk(): Filesystem
    {
        return Storage::disk($this->getDiskName());
    }

    public function getDiskName(): string
    {
        return $this->evaluate($this->disk) ?? config('tables.default_filesystem_disk');
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

    public function getImagesWithPath(): array
    {
        return collect($this->getImages())
            ->filter(fn ($image) => $this->getPath($image) !== null)
            ->take($this->getLimit())
            ->toArray();
    }

    public function separator(string | Closure | null $separator = ','): static
    {
        $this->separator = $separator;

        return $this;
    }

    public function getSeparator(): ?string
    {
        return $this->evaluate($this->separator);
    }

    public function getPath(string | null $image = null): ?string
    {
        $state = $image ?? $this->getState();

        if (! $state) {
            return null;
        }

        if (filter_var($image, FILTER_VALIDATE_URL) !== false) {
            return $state;
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
                    $state,
                    now()->addMinutes(5),
                );
            } catch (Throwable $exception) {
                // This driver does not support creating temporary URLs.
            }
        }

        return $storage->url($state);
    }

    public function visibility(string | Closure $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getVisibility(): string
    {
        return $this->evaluate($this->visibility);
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

    public function limit(int | Closure | null $limit = 3): static
    {
        $this->limit = $limit;

        return $this;
    }

    public function getLimit(): ?int
    {
        return $this->evaluate($this->limit);
    }
}
