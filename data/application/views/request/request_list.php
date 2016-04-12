<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$pagination = $data->total_pages == 1 ? false : mo_html::get_pagination($data->total_pages, [
    "url" => "request_list",
    "current_page" => $data->page
]);
?>

<div>
    
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Manage Emails</div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
                <tr class="font14 padding-left-10">
                    <th></th>
                    <th>From email</th>
                    <th class='width-40-percent'>Message</th>
                    <th class='table-text-center'>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->comm_arr as $key => $comm) {
                    $date = date::get_date($comm->com_date_created, date::$DATE_FORMAT_8);
                    $status_title = $comm->com_status == 2 ? "mark as unread" : "mark as read";
                    $status_class = $comm->com_status == 2 ? "glyphicon glyphicon-ok-sign color-green" : "glyphicon glyphicon-exclamation-sign color-light-red";
                    echo "
                        <tr class='font14'>
                            <td class='width-5-percent'>
                                <a title='View Email' href='view_request?com_id={$comm->id}' class='glyphicon glyphicon glyphicon-search padding-left-10'></a>
                                <a title='Delete Email' class='glyphicon glyphicon-remove deleteAlbumPopup cursor-pointer' albid='{$comm->id}'></a>
                            </td>
                            <td>{$comm->com_from}</td>
                            <td>{$comm->com_message}</td>
                            <td class='table-text-center'><a title='$status_title' class='$status_class cursor-pointer markEmail'comstatus='{$comm->com_status}' comid='{$comm->id}' page='$data->page'></a></td>
                            <td>$date</td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    
</div>
