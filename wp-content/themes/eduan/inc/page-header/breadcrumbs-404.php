<?php
    global $tp_theme_option;    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($tp_theme_option['header-grid']) ? $tp_theme_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>

<?php 
    $post_meta_data = '';
    if(!empty($tp_theme_option['page_banner_main']['url'])):
      $post_meta_data = $tp_theme_option['page_banner_main']['url'];
    endif;
 
if($post_meta_data !=''){   
?>
<div class="themephi-breadcrumbs porfolio-details">
    <div class="breadcrumbs-single" style="background:<?php echo esc_attr($tp_theme_option['breadcrumb_bg_color']);?>">
      <img src="<?php echo esc_url($post_meta_data); ?>" alt="<?php echo esc_attr__('breadcrumb image', 'eduan'); ?>">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumbs-inner">             
                
                <h1 class="page-title">
                    <?php echo esc_html__("404 Page",'eduan');?>
                </h1>            
                 
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<?php }


    else{
      ?>
    <div class="themephi-breadcrumbs porfolio-details">
    <div class="breadcrumbs-single">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrumbs-inner">             
                
                <h1 class="page-title">
                    <?php echo esc_html__("404 Page",'eduan');?>
                </h1>            
                 
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    <?php } 

    
?>