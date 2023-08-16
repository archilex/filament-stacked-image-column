@php
    $images = $getImages();
    $imagesWithPath = $getImagesWithPath();
    $height = $getHeight();
    $width = $getWidth() ?? ($isCircular() || $isSquare() ? $height : null);
    $overlap = $getOverlap() ?? 1;
    $imageCount = 0;

    $defaultImageUrl = $getDefaultImageUrl();

    if ((! count($images)) && filled($defaultImageUrl)) {
        $imagesWithPath = [null];
    }


    $ring = match ($getRing()) {
        0 => 'ring-0',
        1 => 'ring-1',
        2 => 'ring-2',
        4 => 'ring-4',
        default => 'ring',
    };

    $remainingTextSize = match ($getRemainingTextSize()) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-md',
        'lg' => 'text-lg',
        default => 'text-sm',
    };
    
    $imageCount = 0;
@endphp

<div {{ $attributes->merge($getExtraAttributes())->class([
    'filament-tables-stacked-image-column',
    'px-4 py-3' => ! $isInline(),
]) }}>
    <div class="flex items-center space-x-2">
        <div 
            @class([
                'flex',
                match ($overlap) {
                    0 => 'space-x-0',
                    1 => '-space-x-1',
                    2 => '-space-x-2',
                    3 => '-space-x-3',
                    4 => '-space-x-4',
                    default => '-space-x-1',
                },
            ])
        >
            @foreach ($imagesWithPath as $image)
                @php
                    $imageCount ++;
                    $path = $getPath($image);
                @endphp
                
                <img
                    src="{{ filled($image) ? $getPath($image) : $defaultImageUrl }}"
                    style="
                        {!! $height !== null ? "height: {$height};" : null !!}
                        {!! $width !== null ? "width: {$width};" : null !!}
                    "

                    {{ $getExtraImgAttributeBag()->class([
                        'max-w-none ring-white object-cover object-center',
                        'dark:ring-gray-800' => config('tables.dark_mode'),
                        'rounded-full' => $isCircular(),
                        $ring,
                    ]) }}
                >
            @endforeach

            @if ($shouldShowRemaining() && (! $shouldShowRemainingAfterStack()) && ($imageCount < count($images)))
                <div 
                    style="
                        {!! $height !== null ? "height: {$height};" : null !!}
                        {!! $width !== null ? "width: {$width};" : null !!}
                    "
                    @class([
                        'flex items-center justify-center bg-gray-100 text-gray-500 ring-white',
                        'dark:bg-gray-600 dark:text-gray-300 dark:ring-gray-800' => config('tables.dark_mode'),
                        'rounded-full' => $isCircular(),
                        $remainingTextSize,
                        $ring,
                    ])
                >
                    <span class="-ml-1">
                        +{{ count($images) - $imageCount }}
                    </span>
                </div>
            @endif

        </div>
        
        @if ($shouldShowRemaining() && $shouldShowRemainingAfterStack() && ($imageCount < count($images)))
            <div 
                @class([
                    'text-gray-500',
                    'dark:text-gray-300' => config('tables.dark_mode'),
                    $remainingTextSize,
                ])
            >
                +{{ count($images) - $imageCount }}
            </div>
        @endif

    </div>
</div>