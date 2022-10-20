
<?php
  $value = data_get($entry, $column['name']);
  
  if($value) {
    $column['height'] = $column['height'] ?? "25px";
    $column['width'] = $column['width'] ?? "auto";
    $column['radius'] = $column['radius'] ?? "3px";
    $column['prefix'] = $column['prefix'] ?? '';

    if (is_array($value)) {
      $value = json_encode($value);
    }

    if (preg_match('/^data\:image\//', $value)) { // base64_image
      $href = $src = $value;
    } elseif (isset($column['disk'])) { // image from a different disk (like s3 bucket)
      $href = $src = Storage::disk($column['disk'])->url($column['prefix'].$value);
    } else { // plain-old image, from a local disk
      $href = $src = asset( $column['prefix'] . $value);
    }

    $column['wrapper']['element'] = $column['wrapper']['element'] ?? 'a';
    $column['wrapper']['href'] = $column['wrapper']['href'] ?? $href;
    $column['wrapper']['target'] = $column['wrapper']['target'] ?? '_blank';
  }
?>

<span>
  <?php if( empty($value) ): ?>
    -
  <?php else: ?>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <img src="<?php echo e($src); ?>" style="
        max-height: <?php echo e($column['height']); ?>;
        width: <?php echo e($column['width']); ?>;
        border-radius: <?php echo e($column['radius']); ?>;"
        />
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
  <?php endif; ?>
</span>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/columns/image.blade.php ENDPATH**/ ?>