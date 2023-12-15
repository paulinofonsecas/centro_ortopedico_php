<dl>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.grid.index','data' => ['default' => $getColumns('default'),'sm' => $getColumns('sm'),'md' => $getColumns('md'),'lg' => $getColumns('lg'),'xl' => $getColumns('xl'),'twoXl' => $getColumns('2xl'),'class' => 'fi-in-component-ctn gap-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['default' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumns('default')),'sm' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumns('sm')),'md' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumns('md')),'lg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumns('lg')),'xl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumns('xl')),'two-xl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumns('2xl')),'class' => 'fi-in-component-ctn gap-6']); ?>
        <?php $__currentLoopData = $getComponents(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infolistComponent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.grid.column','data' => ['default' => $infolistComponent->getColumnSpan('default'),'sm' => $infolistComponent->getColumnSpan('sm'),'md' => $infolistComponent->getColumnSpan('md'),'lg' => $infolistComponent->getColumnSpan('lg'),'xl' => $infolistComponent->getColumnSpan('xl'),'twoXl' => $infolistComponent->getColumnSpan('2xl'),'defaultStart' => $infolistComponent->getColumnStart('default'),'smStart' => $infolistComponent->getColumnStart('sm'),'mdStart' => $infolistComponent->getColumnStart('md'),'lgStart' => $infolistComponent->getColumnStart('lg'),'xlStart' => $infolistComponent->getColumnStart('xl'),'twoXlStart' => $infolistComponent->getColumnStart('2xl'),'class' => \Illuminate\Support\Arr::toCssClasses([
                    match ($maxWidth = $infolistComponent->getMaxWidth()) {
                        'xs' => 'max-w-xs',
                        'sm' => 'max-w-sm',
                        'md' => 'max-w-md',
                        'lg' => 'max-w-lg',
                        'xl' => 'max-w-xl',
                        '2xl' => 'max-w-2xl',
                        '3xl' => 'max-w-3xl',
                        '4xl' => 'max-w-4xl',
                        '5xl' => 'max-w-5xl',
                        '6xl' => 'max-w-6xl',
                        '7xl' => 'max-w-7xl',
                        default => $maxWidth,
                    },
                ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::grid.column'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['default' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnSpan('default')),'sm' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnSpan('sm')),'md' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnSpan('md')),'lg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnSpan('lg')),'xl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnSpan('xl')),'twoXl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnSpan('2xl')),'defaultStart' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnStart('default')),'smStart' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnStart('sm')),'mdStart' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnStart('md')),'lgStart' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnStart('lg')),'xlStart' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnStart('xl')),'twoXlStart' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($infolistComponent->getColumnStart('2xl')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                    match ($maxWidth = $infolistComponent->getMaxWidth()) {
                        'xs' => 'max-w-xs',
                        'sm' => 'max-w-sm',
                        'md' => 'max-w-md',
                        'lg' => 'max-w-lg',
                        'xl' => 'max-w-xl',
                        '2xl' => 'max-w-2xl',
                        '3xl' => 'max-w-3xl',
                        '4xl' => 'max-w-4xl',
                        '5xl' => 'max-w-5xl',
                        '6xl' => 'max-w-6xl',
                        '7xl' => 'max-w-7xl',
                        default => $maxWidth,
                    },
                ]))]); ?>
                <?php echo e($infolistComponent); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
</dl>
<?php /**PATH C:\xampp2\htdocs\gestao\vendor\filament\infolists\src\/../resources/views/component-container.blade.php ENDPATH**/ ?>