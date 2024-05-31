<?php
/*
Widget-title: Slider Clients reviews, support template color
Widget-preview-image: /assets/img/widgets_preview/bottom_clientsreviews.jpg
*/
?>


<section class="slice bg-base">
    <div class="wp-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div id="carouselTestimonial" class="carousel carousel-testimonials slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carouselTestimonial" data-slide-to="0" class=""></li>
                            <li data-target="#carouselTestimonial" data-slide-to="1" class="active"></li>
                            <li data-target="#carouselTestimonial" data-slide-to="2" class=""></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item">
                                <div class="text-center">
                                    <h4><i class="fa fa-quote-left fa-3x"></i></h4>
                                    <h2><?php echo _l('What our clients say');?></h2>
                                    <div class="testimonial-text">
                                        <p>
                                          <?php echo _l("client_say_message_1");?>
                                        </p>
                                        <p class="testimonial-author c-white"><?php echo _l('client_1');?></p>
                                    </div>
                                    <span class="clearfix"></span>
                                </div>
                            </div>
                            <div class="item active">
                                <div class="text-center">
                                    <h4><i class="fa fa-quote-left fa-3x"></i></h4>
                                    <h2><?php echo _l('What our clients say');?></h2>
                                    <div class="testimonial-text">
                                        <p>
                                            <?php echo _l("client_say_message_2");?>
                                        </p>
                                        <p class="testimonial-author c-white"><?php echo _l('client_2');?></p>
                                    </div>
                                    <span class="clearfix"></span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="text-center">
                                    <h4><i class="fa fa-quote-left fa-3x"></i></h4>
                                    <h2><?php echo _l('What our clients say');?></h2>
                                    <div class="testimonial-text">
                                        <p>
                                            <?php echo _l("client_say_message_3");?>
                                        </p>
                                        <p class="testimonial-author c-white"><?php echo _l('client_3');?></p>
                                    </div>
                                    <span class="clearfix"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>