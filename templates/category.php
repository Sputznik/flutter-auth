<div class="wrap">
  <?php settings_errors();?>
  <form action="options.php" method="post">
    <?php
      settings_fields( 'flutter_categories_group' );
      do_settings_sections( 'flutter_categories' );
      submit_button('Save'); ?>
  </form>
</div>
