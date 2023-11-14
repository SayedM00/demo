<?php
/**
 * The template for displaying the footer
 */
?>
    </div>
<?php
    /**
     * Before Footer area
     */
    lamaro_the_before_footer();
    lamaro_the_subscribe_block();

    /**
     * Footer widgets area
     */
    lamaro_the_footer_widgets();

    /**
     * Copyright
     */
    lamaro_the_copyrights_section();
   
    /**
     * WordPress Core Function
     */   
    wp_footer();
?>
</body>
</html>
