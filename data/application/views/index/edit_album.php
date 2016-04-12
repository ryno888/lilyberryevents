<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$nav = mo_html::get_nav(["save_button" => "xadd_album", "return_button" => "gallery"]);
?>

<div>
    <form id="edit_album_form" name="edit_album_form" enctype="multipart/form-data" action="xupload" method="post">
        <?php echo $nav; ?>
        <div class="clear"></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-left">Panel title</h3>
            </div>
            <div class="panel-body">
                <div class="container pull-left">
                    <table class="table font14">
                        <tr>
                            <td>
                                Album name: 
                                <input id="alb_name" name="alb_name" value="<?php echo $data->album->alb_name ?>" type="text" class="form-control width-20-percent">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Album summary: 
                                <div class="input-group width-25-percent">
                                    <textarea  id="alb_detail" name="alb_detail" class="form-control custom-control border-radius-5" rows="3"><?php echo $data->album->alb_detail ?></textarea>     
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Album Visibility:<br/>
                                <div class="radio">
                                    <label><input checked="true" type="radio" name="alb_is_visible" value="1">Visible</label>
                                  </div>
                                  <div class="radio">
                                    <label><input type="radio" name="alb_is_visible" value="2">Not Visible</label>
                                  </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="padding-left-23 pull-left text-left">
                    <span class="font14">Album Photos</span>
                    <?php echo mo_html::get_file_uploader(["label" => false]); ?>
                </div>
            </div>
        </div>
    </form>
</div>