<?php

    $category_id = 9;

?> 

<?php if(isset(${"category_options_$category_id"}) && ${"category_options_count_$category_id"}>0): ?>
<div class="wp-block pg-opt">
    <h2 class="title"><?php echo ${"options_name_$category_id"} ?></h2>
</div>
<?php foreach(${"category_options_$category_id"} as $key=>$row): ?>
<?php if(!empty($row['option_value'])): ?>
    <?php 
    $row['option_value'] = trim($row['option_value']);
    if(filter_var($row['option_value'], FILTER_VALIDATE_URL) && 
        (strpos($row['option_value'], 'youtube.com')!==FALSE || strpos($row['option_value'], 'youtu.be')!==FALSE)
      ):

        $youtube_id='';
        if(strpos($row['option_value'], 'youtube.com')!==FALSE)
            $youtube_id= substr($row['option_value'], strpos($row['option_value'], "v=") + 2);
        if(strpos($row['option_value'], 'youtu.be')!==FALSE)
            $youtube_id = substr($row['option_value'], strpos($row['option_value'], "e/") + 2); 
    ?>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id;?>" frameborder="0" allowfullscreen></iframe>
    <?php else :?>
        <?php echo _che($row['option_value']); ?>
    <?php endif; ?>
    <br style="clear:both;" />
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>

