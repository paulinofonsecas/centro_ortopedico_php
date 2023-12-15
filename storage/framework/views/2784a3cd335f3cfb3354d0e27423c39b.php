<div class="fi-resource-relation-manager">
    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.relation-manager.before', scopes: $this->getRenderHookScopes())); ?>


    <?php echo e($this->table); ?>


    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::resource.relation-manager.after', scopes: $this->getRenderHookScopes())); ?>

</div>
<?php /**PATH C:\xampp2\htdocs\gestao\vendor\filament\filament\src\/../resources/views/resources/relation-manager.blade.php ENDPATH**/ ?>