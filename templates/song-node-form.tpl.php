<?php dpm($variables); ?>
<div class="right">
  <?php if($right): ?>
    <?php print render($right); ?>
  <?php endif; ?>
</div>
<div class="left">
  <?php if($form): ?>
    <?php print drupal_render_children($form); ?>
  <?php endif; ?>
</div>
<?php if($buttons): ?>
	<div class="node-buttons">
		<?php print render($buttons); ?>
	</div>
<?php endif; ?>