<?php
/*
Widget-title: Parallax Widget
Widget-preview-image: /assets/img/widgets_preview/bottom_parallax2.jpg
*/
?>
<section class="prlx-bg inset-shadow-1 p-50" data-stellar-ratio="2" style="min-height: 250px; height: auto; background-image: url(assets/img/sections/section-bg-1.jpg)">
    <!-- Section mask -->
    <div class="mask mask-1"></div>

    <div class="container">
        <div class="section-title-wr">
            <h3 class="section-title center">
                <span class="c-white"><?php _l('Over 10 000 Properties In Our Directory');?></span>
                <!--<small class="c-white">Here are some of the statistics that recommend us</small>-->
            </h3>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="milestone-counter">
                    <div class="milestone-count c-white" data-from="0" data-to="3000" data-speed="3000" data-refresh-interval="100"></div>
                    <h4 class="milestone-info c-white"><?php echo _l('Apartments');?></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="milestone-counter">
                    <div class="milestone-count c-white" data-from="0" data-to="3000" data-speed="5000" data-refresh-interval="50"></div>
                    <h4 class="milestone-info c-white"><?php echo _l('Houses');?></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="milestone-counter">
                    <div class="milestone-count c-white" data-from="0" data-to="5000" data-speed="5000" data-refresh-interval="80"></div>
                    <h4 class="milestone-info c-white"><?php echo _l('Condos');?></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="milestone-counter">
                    <div class="milestone-count c-white" data-from="0" data-to="3500" data-speed="5000" data-refresh-interval="80"></div>
                    <h4 class="milestone-info c-white"><?php echo _l('Areas');?></h4>
                </div>
            </div>
        </div>
    </div>
</section>
