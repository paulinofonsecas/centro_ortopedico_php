<?php
    use Filament\Infolists\Components\TextEntry\TextEntrySize;
    use Filament\Support\Enums\FontFamily;
    use Filament\Support\Enums\FontWeight;
    use Filament\Support\Enums\IconPosition;
?>

<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getEntryWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entry' => $entry]); ?>
    <?php
        $isBadge = $isBadge();
        $iconPosition = $getIconPosition();
        $isListWithLineBreaks = $isListWithLineBreaks();
        $isProse = $isProse();
        $url = $getUrl();

        $arrayState = $getState();

        if ($arrayState instanceof \Illuminate\Support\Collection) {
            $arrayState = $arrayState->all();
        }

        if (is_array($arrayState)) {
            if ($listLimit = $getListLimit()) {
                $limitedArrayState = array_slice($arrayState, $listLimit);
                $arrayState = array_slice($arrayState, 0, $listLimit);
            }

            if ((! $isListWithLineBreaks) && (! $isBadge)) {
                $arrayState = implode(
                    ', ',
                    array_map(
                        fn ($value) => $value instanceof \Filament\Support\Contracts\HasLabel ? $value->getLabel() : $value,
                        $arrayState,
                    ),
                );
            }
        }

        $arrayState = \Illuminate\Support\Arr::wrap($arrayState);
    ?>

    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-infolists::components.affixes','data' => ['prefixActions' => $getPrefixActions(),'suffixActions' => $getSuffixActions(),'attributes' => 
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class(['fi-in-text'])
        ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-infolists::affixes'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['prefix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getPrefixActions()),'suffix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getSuffixActions()),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class(['fi-in-text'])
        )]); ?>
        <<?php echo e($isListWithLineBreaks ? 'ul' : 'div'); ?>

            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'list-inside list-disc' => $isBulleted(),
                'flex flex-wrap items-center gap-1.5' => $isBadge,
            ]); ?>"
        >
            <?php $__currentLoopData = $arrayState; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(filled($formattedState = $formatState($state))): ?>
                    <?php
                        $color = $getColor($state);
                        $copyableState = $getCopyableState($state) ?? $state;
                        $copyMessage = $getCopyMessage($state);
                        $copyMessageDuration = $getCopyMessageDuration($state);
                        $fontFamily = $getFontFamily($state);
                        $icon = $getIcon($state);
                        $itemIsCopyable = $isCopyable($state);
                        $size = $getSize($state);
                        $weight = $getWeight($state);

                        $proseClasses = \Illuminate\Support\Arr::toCssClasses([
                            'prose max-w-none dark:prose-invert [&>*:first-child]:mt-0 [&>*:last-child]:mb-0',
                            'pt-2' => ! $isLabelHidden(),
                            match ($size) {
                                TextEntrySize::ExtraSmall, 'xs' => 'prose-xs',
                                TextEntrySize::Small, 'sm', null => 'prose-sm',
                                TextEntrySize::Medium, 'base', 'md' => 'prose-base',
                                TextEntrySize::Large, 'lg' => 'prose-lg',
                                default => $size,
                            },
                        ]);

                        $iconClasses = \Illuminate\Support\Arr::toCssClasses([
                            'fi-in-text-item-icon h-5 w-5 shrink-0',
                            match ($color) {
                                'gray', null => 'text-gray-400 dark:text-gray-500',
                                default => 'text-custom-500',
                            },
                        ]);

                        $iconStyles = \Illuminate\Support\Arr::toCssStyles([
                            \Filament\Support\get_color_css_variables($color, shades: [500]) => $color !== 'gray',
                        ]);
                    ?>

                    <<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>

                        <?php if($itemIsCopyable): ?>
                            x-data="{}"
                            x-on:click="
                                window.navigator.clipboard.writeText(<?php echo \Illuminate\Support\Js::from($copyableState)->toHtml() ?>)
                                $tooltip(<?php echo \Illuminate\Support\Js::from($copyMessage)->toHtml() ?>, { timeout: <?php echo \Illuminate\Support\Js::from($copyMessageDuration)->toHtml() ?> })
                            "
                            class="cursor-pointer max-w-max"
                        <?php endif; ?>
                    >
                        <?php if($isBadge): ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $color,'icon' => $icon,'iconPosition' => $iconPosition]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconPosition)]); ?>
                                <?php echo e($formattedState); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php else: ?>
                            <div
                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                    'fi-in-text-item inline-flex items-center gap-1.5',
                                    'transition duration-75 hover:underline focus:underline' => $url,
                                    match ($size) {
                                        TextEntrySize::ExtraSmall, 'xs' => 'text-xs',
                                        TextEntrySize::Small, 'sm', null => 'text-sm leading-6',
                                        TextEntrySize::Medium, 'base', 'md' => 'text-base',
                                        TextEntrySize::Large, 'lg' => 'text-lg',
                                        default => $size,
                                    },
                                    match ($color) {
                                        null => 'text-gray-950 dark:text-white',
                                        'gray' => 'text-gray-500 dark:text-gray-400',
                                        default => 'text-custom-600 dark:text-custom-400',
                                    },
                                    match ($weight) {
                                        FontWeight::Thin, 'thin' => 'font-thin',
                                        FontWeight::ExtraLight, 'extralight' => 'font-extralight',
                                        FontWeight::Light, 'light' => 'font-light',
                                        FontWeight::Medium, 'medium' => 'font-medium',
                                        FontWeight::SemiBold, 'semibold' => 'font-semibold',
                                        FontWeight::Bold, 'bold' => 'font-bold',
                                        FontWeight::ExtraBold, 'extrabold' => 'font-extrabold',
                                        FontWeight::Black, 'black' => 'font-black',
                                        default => $weight,
                                    },
                                    match ($fontFamily) {
                                        FontFamily::Sans, 'sans' => 'font-sans',
                                        FontFamily::Serif, 'serif' => 'font-serif',
                                        FontFamily::Mono, 'mono' => 'font-mono',
                                        default => $fontFamily,
                                    },
                                ]); ?>"
                                style="<?php echo \Illuminate\Support\Arr::toCssStyles([
                                    \Filament\Support\get_color_css_variables($color, shades: [400, 600]) => ! in_array($color, [null, 'gray']),
                                ]) ?>"
                            >
                                <?php if($icon && in_array($iconPosition, [IconPosition::Before, 'before'])): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['icon' => $icon,'class' => $iconClasses,'style' => $iconStyles]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses),'style' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconStyles)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>

                                <div
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        $proseClasses => $isProse,
                                    ]); ?>"
                                >
                                    <?php echo e($formattedState); ?>

                                </div>

                                <?php if($icon && in_array($iconPosition, [IconPosition::After, 'after'])): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['icon' => $icon,'class' => $iconClasses,'style' => $iconStyles]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses),'style' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconStyles)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($limitedArrayStateCount = count($limitedArrayState ?? [])): ?>
                <<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>

                    class="text-sm text-gray-500 dark:text-gray-400"
                >
                    <?php echo e(trans_choice('filament-infolists::components.text_entry.more_list_items', $limitedArrayStateCount)); ?>

                </<?php echo e($isListWithLineBreaks ? 'li' : 'div'); ?>>
            <?php endif; ?>
        </<?php echo e($isListWithLineBreaks ? 'ul' : 'div'); ?>>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH C:\xampp2\htdocs\gestao\vendor\filament\infolists\src\/../resources/views/components/text-entry.blade.php ENDPATH**/ ?>