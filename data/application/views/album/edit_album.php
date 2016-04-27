<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$nav = mo_html::get_nav([
    "save_button" => "xedit_album", 
    "return_button" => "album_list"
]);
?>

<div>
    <form action="xedit_album" enctype="multipart/form-data" method="post">
        <?php echo $nav; ?>
        <div class="clear"></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-left">Panel title</h3>
            </div>
            <div class="panel-body">
               
                <table class="table">
                    <tr>
                        <td class="width-50-percent border-right-grey">
                            <table class="table font14">
                                <tr>
                                    <td>
                                        Album name: * 
                                        <input id="alb_name" name="alb_name" value="<?php echo $data->album->alb_name; ?>" type="text" class="form-control width-80-percent">
                                        <input id="alb_id" name="alb_id" value="<?php echo $data->album->id; ?>" type="hidden">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Album summary: 
                                        <div class="input-group width-90-percent">
                                            <textarea  id="alb_detail" name="alb_detail" class="form-control custom-control border-radius-5" rows="3"><?php echo $data->album->alb_detail; ?></textarea>     
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            $check_yes = "";
                                            $check_no = "checked='true'";
                                            if($data->album->alb_is_visible == 1){
                                                $check_yes = "checked='true'";
                                                $check_no = "";
                                            }
                                            echo"
                                                Album Visibility:<br/>
                                                <div class='radio'>
                                                    <label><input $check_yes type='radio' name='alb_is_visible' value='1'>Visible</label>
                                                </div>
                                                <div class='radio'>
                                                    <label><input $check_no type='radio' name='alb_is_visible' value='2'>Not Visible</label>
                                                </div>
                                            ";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width-30-percent">
                                        <div class="padding-left-23 text-left">
                                            <span class="font14">Upload Files: *</span>
                                            <input class='form-control' id='input-4' name='input4[]' type='file' multiple class='file-loading' data-show-upload='' data-show-remove='1'>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="font14 padding-left-10">
                                        <th></th>
                                        <th>Album name</th>
                                        <th>Date added</th>
                                        <th class='table-valign-center table-text-center'>Set</th>
                                        <th class="table-text-center">Image Preview</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($data->album_image_arr){
                                            $pagination = mo_html::get_pagination($data->total_pages, [
                                                "url" => "edit_album",
                                                "current_page" => $data->page,
                                                "args" => ["alb_id={$data->album->alb_id}"]
                                            ]);
                                            echo "$pagination";
                                            foreach ($data->album_image_arr as $image) {
                                                $filename = $image->img_name && $image->img_name != "" ? $image->img_name : "unknownFile";
                                                $img = $image->img_thumbnail;
                                                if(!$image->img_thumbnail){
                                                    $img = $image->img_data;
                                                }
                                                $img = mo_file::decompress_image($img);
                                                $date = date::get_date($image->img_date_created, date::$DATE_FORMAT_4);
                                                $status_title = $image->img_is_main == 1 ? "unset as main image" : "set as main image";
                                                $status_class = $image->img_is_main == 1 ? "glyphicon glyphicon-ok-sign color-green" : "glyphicon glyphicon-exclamation-sign color-light-red";
                                                echo "
                                                    <tr class='font14'>
                                                        <td class='width-5-percent table-valign-center'>
                                                            <a title='Delete Image' class='glyphicon glyphicon-remove deleteImagePopup cursor-pointer' albid='{$data->album->id}' imgid='{$image->id}'></a>
                                                        </td>
                                                        <td class='table-valign-center'>{$filename}</td>
                                                        <td class='width-30-percent table-valign-center'>$date</td>
                                                        <td class='width-10-percent table-valign-center table-text-center'><a title='$status_title' class='$status_class cursor-pointer setMainImage' albid='{$data->album->id}' imgtype='{$image->img_is_main}' imgid='{$image->id}'></a></td>
                                                        <td class='table-text-center table-valign-center'><img class='previewImage width-20-percent cursor-pointer' img_id='$image->img_id' src='$img' /></td>
                                                    </tr>
                                                ";
                                            }
                                        }else{
                                            echo "
                                                <tr class='font14'>
                                                    <td colspan='5'>No images have been added yet</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>
