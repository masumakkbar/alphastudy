<?php

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
  return;}
?>
<div class="col-lg-4">
  <aside id="secondary" class="widget-area sticky-sidebar">
    <div class="themephi-sideabr dynamic-sidebar">
      <?php
        dynamic_sidebar( 'sidebar-1' );
      ?>
    </div>
  </aside>
  <!-- #secondary --> 
</div>
<?php
?>
