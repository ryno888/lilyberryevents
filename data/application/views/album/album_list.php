<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$pagination = mo_html::get_pagination($data->total_pages, [
    "url" => "album_list",
    "current_page" => $data->page
]);
?>

<div>
    <nav>
        <div class="pull-left padding10">
            <ul class="nav nav-pills">
                <a class="btn btn-default" href="add_album">Add Album</a>
                <input type="text" id='searchText' class="searchBox" value='<?php echo $data->search; ?>' placeholder="Search">
                <a class="btn btn-default" id='searchButton'>Search</a>
                <?php if($data->search){
                    echo '<a class="btn btn-default" href="album_list">Clear</a>';
                } ?>
                
            </ul>
        </div>
        <div class="clear"></div>
    </nav>
    
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <?php if($data->gallery_arr){ ?>
            <div class="panel-heading">Manage Albums</div>
        <?php } ?>

        <!-- Table -->
        <table class="table table-striped">
            <?php if($data->gallery_arr){ ?>
                <thead>
                    <tr class="font14 padding-left-10">
                        <th></th>
                        <th>Album name</th>
                        <th>Album main image</th>
                        <th>Date added</th>
                    </tr>
                </thead>
            <?php } ?>
            <tbody>
                <?php
                    if($data->gallery_arr){
                        foreach ($data->gallery_arr as $key => $album) {
                            $date = date::get_date($album->alb_date_created, date::$DATE_FORMAT_4);
                            $image_data = mo_album::get_album_main_image($album->id);
                            if($image_data){
                                $img = mo_file::decompress_image($image_data);
                                $image = "<img class='previewImage width-20-percent cursor-pointer' src='$img'/>";
                            }else{
                                $image = "<img class='width-20-percent cursor-pointer' src='".DIR_PLACEHOLDER."'/>";
                            }
                            echo "
                                <tr class='font14'>
                                    <td class='width-5-percent table-valign-center'>
                                        <a title='Edit Album' href='edit_album?alb_id={$album->alb_id}' class='glyphicon glyphicon-edit padding-left-10'></a>
                                        <a title='Delete Album' class='glyphicon glyphicon-remove deleteAlbumPopup cursor-pointer' albid='$album->alb_id'></a>
                                    </td>
                                    <td class='width-10-percent table-valign-center'>{$album->alb_name}</td>
                                    <td class='width-20-percent table-valign-center'>$image</td>
                                    <td class='width-20-percent table-valign-center'>$date</td>
                                </tr>
                            ";
                        }
                    }else{
                        echo "
                            <tr class='font14'>
                                <td class='width-5-percent table-text-center' colspan=3 >No albums added yet</td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    
</div>
