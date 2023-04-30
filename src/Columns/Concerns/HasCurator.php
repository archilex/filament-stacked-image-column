<?php

namespace Archilex\ImageGroupColumn\Columns\Concerns;

trait HasCurator
{
    protected bool $isCurator = false;

    public function curator(bool $condition = true): static
    {
        $this->isCurator = $condition;
        
        return $this;
    }

    public function isCurator(): bool
    {
        return $this->evaluate($this->isCurator);
    }

    public function getCuratorPath(): string
    {
        $urlBuilder = \League\Glide\Urls\UrlBuilderFactory::create('/curator/', config('app.key'));
            
        return $urlBuilder->getUrl($image['path'], ['w' => $this->getCuratorSizes(), 'h' => $this->getCuratorSizes(), 'fit' => 'crop', 'fm' => 'webp']);
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