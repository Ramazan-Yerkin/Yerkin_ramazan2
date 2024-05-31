<?php foreach($expert_module_all as $key=>$row):?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordionThree" href="#collapse3<?php echo $key;?>">
            <?php echo $row->question; ?>
            </a>
        </h4>
    </div>
    <div id="collapse3<?php echo $key;?>" class="panel-collapse collapse <?php echo ($key==0) ? 'in' : '' ;?>">
        <div class="panel-body">
            <?php echo $row->answer; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>