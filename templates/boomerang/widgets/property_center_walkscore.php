                <?php if(config_db_item('walkscore_enabled') == TRUE && !empty($estate_data_address) && !empty($estate_data_gps)): ?>
                <br />
                <script type='text/javascript'>
                var ws_wsid = '';
                <?php
                echo "var ws_address = '$estate_data_address';";
                $base_url = base_url();
                $url_protocol='http://';
                if(strpos( $base_url,'https')!== false){
                    $url_protocol='https://';
                }
                ?> 
                var ws_width = '500';
                var ws_height = '336';
                var ws_layout = 'horizontal';
                var ws_commute = 'true';
                var ws_transit_score = 'true';
                var ws_map_modules = 'all';
                            </script><style type='text/css'>#ws-walkscore-tile{padding-bottom: 15px !important;position:relative;text-align:left}#ws-walkscore-tile *{float:none;}#ws-footer a,#ws-footer a:link{font:11px/14px Verdana,Arial,Helvetica,sans-serif;margin-right:6px;white-space:nowrap;padding:0;color:#000;font-weight:bold;text-decoration:none}#ws-footer a:hover{color:#777;text-decoration:none}#ws-footer a:active{color:#b14900}#ws-street{height: 30px !important;border: 1px solid #e2e2e2 !important;padding-left: 10px !important;}#ws-a{line-height: 30px !important;} #ws-go{right: -15px !important;height: 30px;background: #eee;padding: 0 10px !important;;border: 1px solid #eee;border: 1px solid #e2e2e2 !important;margin-left: 0px;font-size: 14px;}#ws-go:hover{background: #dedede !important;}</style><div id='ws-walkscore-tile'><div id='ws-footer' style='position:absolute;top:318px;left:8px;width:488px'><form id='ws-form'><a id='ws-a' href='<?php echo $url_protocol;?>www.walkscore.com/' target='_blank'>What's Your Walk Score?</a><input type='text' id='ws-street' style='position:absolute;top:0px;left:170px;width:286px' /><input type='submit' id='ws-go' value="<?php echo lang_check('Go');?>" border='0' alt='get my Walk Score' style='position:absolute;top:0px;right:0px' /></form></div></div><script type='text/javascript' src='<?php echo $url_protocol;?>www.walkscore.com/tile/show-walkscore-tile.php'></script>
                <hr>
                <?php endif; ?>