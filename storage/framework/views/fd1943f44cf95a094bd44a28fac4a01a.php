<?php
    $id = $getId();
    $isContained = $getContainer()->getParentComponent()->isContained();

    $visibleStepClasses = \Illuminate\Support\Arr::toCssClasses([
        'p-6' => $isContained,
        'mt-6' => ! $isContained,
    ]);

    $invisibleStepClasses = 'invisible h-0 overflow-y-hidden p-0';
?>

<div
    x-bind:class="step === <?php echo \Illuminate\Support\Js::from($id)->toHtml() ?> ? <?php echo \Illuminate\Support\Js::from($visibleStepClasses)->toHtml() ?> : <?php echo \Illuminate\Support\Js::from($invisibleStepClasses)->toHtml() ?>"
    x-on:expand-concealing-component.window="
        error = $el.querySelector('[data-validation-error]')

        if (! error) {
            return
        }

        if (! isStepAccessible(step, <?php echo \Illuminate\Support\Js::from($id)->toHtml() ?>)) {
            return
        }

        step = <?php echo \Illuminate\Support\Js::from($id)->toHtml() ?>

        if (document.body.querySelector('[data-validation-error]') !== error) {
            return
        }

        setTimeout(
            () =>
                $el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                    inline: 'start',
                }),
            200,
        )
    "
    x-ref="step-<?php echo e($id); ?>"
    <?php echo e($attributes
            ->merge([
                'aria-labelledby' => $id,
                'id' => $id,
                'role' => 'tabpanel',
                'tabindex' => '0',
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->class(['fi-fo-wizard-step outline-none'])); ?>

>
    <?php echo e($getChildComponentContainer()); ?>

</div>
<?php /**PATH C:\xampp2\htdocs\gestao\vendor\filament\forms\src\/../resources/views/components/wizard/step.blade.php ENDPATH**/ ?>