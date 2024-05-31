<?php
/*
Widget-title: Clients
Widget-preview-image: /assets/img/widgets_preview/bottom_partners.jpg
*/
?>

<!-- CLIENTS -->
<section class="slice bg-white">
    <div class="wp-section">
        <div class="container">
            <div class="row">
                <?php foreach($all_agents as $agent): ?>
                <?php if(isset($agent['image_sec_url'])): ?>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="client">
                        <a href="<?php echo $agent['agent_url']; ?>">
                            <img src="<?php echo $agent['image_sec_url']; ?>" alt="">
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>