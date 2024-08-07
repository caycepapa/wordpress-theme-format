<?php
    /**
    * @package WordPress
    * @subpackage valo
    * @since 2024
    */

    if ( !defined('ABSPATH') ) {
        die( 'Forbidden' );
    }
?>
        </main><!-- /.l-main -->
        <?php get_template_part('template-parts/footer/common'); ?>
    </div><!-- /.l-container -->
    <script src="<?php echo esc_url(get_template_directory_uri());?>/assets/js/bundle.js?<?php echo date('YmdHis'); ?>"> </script>
    <?php wp_footer(); ?>
</body>
</html>