<!DOCTYPE html>
<html>  
    <head>
        <?php _widget('head'); ?>
    </head>
    <body class="body-wrap <?php _widget('custom_paletteclass'); ?>">
        <?php _widget('slidebar'); ?>
        <!-- MAIN WRAPPER -->
        <div class="">
            <?php _widget('custom_palette'); ?>
            <!-- HEADER -->
            <div id="divHeaderWrapper">
                <header class="header-standard-3"> 
                    <?php
                    foreach ($widgets_order->header as $widget_filename) {
                        _widget($widget_filename);
                    }
                    ?>
                </header>   
            </div>
            <!-- MAIN CONTENT -->
            <?php
            foreach ($widgets_order->top as $widget_filename) {
                _widget($widget_filename);
            }
            ?>
            <section class="slice bg-white bb">
                <div class="wp-section">
                    <div id="content-block" class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <?php
                                foreach ($widgets_order->center as $widget_filename) {
                                    _widget($widget_filename);
                                }
                                ?>
                            </div>
                            <div class="col-md-3">
                                <div class="sidebar">
                                    <?php
                                    foreach ($widgets_order->right as $widget_filename) {
                                        _widget($widget_filename);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            foreach ($widgets_order->bottom as $widget_filename) {
                _widget($widget_filename);
            }
            ?>
            <!-- FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <?php
                        foreach ($widgets_order->footer as $widget_filename) {
                            _widget($widget_filename);
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="pull-left copyright" style="line-height: 40px;">
                            <?php _l('All Right reserved'); ?>
                        </div>
                        <div class="pull-right">
                          <a class="developed_by" href="http://iwinter.com.hr" target="_blank"><img height='40px' src="assets/img/partners/winter.png" alt="winter logo" /></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <?php _widget('custom_javascript'); ?>
    </body>
</html>