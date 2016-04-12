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
    <form action="xadd_album" enctype="multipart/form-data" method="post">
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
                                        <span class="h5 font-bold">Sender Name:</span>
                                        <div>
                                            Ryno van Zyl
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="h5 font-bold">Date Sent:</span>
                                        <div>
                                            6th February 2016
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="h5 font-bold">Sender Email Address:</span>
                                        <div>
                                            ryno888@gmail.com
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="h5 font-bold">Message:</span>
                                        <div>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>