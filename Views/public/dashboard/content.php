<?php get_header(); ?>
    <?php do_action("before_ams_main"); ?>
    <main id="ams-main">
        <?php do_action("ams_main_start"); ?>
            <?php echo apply_filters("ams_dashboard_header", null); ?>
            <div class="ams-main-dashboard">
asdasdasdasd
            </div>
        <?php do_action("ams_main_end"); ?>
    <main>
    <?php do_action("after_ams_main"); ?>
<?php get_footer(); ?>
