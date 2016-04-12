<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div>
    <nav>
        <form class="navbar-form navbar-left" role="search">
            <button type="button" onclick="location.href = 'add_album';" class="btn btn-default">Add new</button>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <div>
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true"><</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Manage Albums</div>

        <!-- Table -->
        <table class="table">
            <thead>
                <tr class="font14 padding-left-10">
                    <th></th>
                    <th>Album name</th>
                    <th>Date added</th>
                </tr>
            </thead>
            <tbody>
                <tr class="font14">
                    <td class="width-5-percent">
                        <a title="Edit Album" href="edit_album" class="glyphicon glyphicon-edit padding-left-10"></a>
                        <a title="Delete Album" href="delete" class="glyphicon glyphicon-remove"></a>
                    </td>
                    <td>cell is row 0, column 1</td>
                    <td>cell is row 0, column 1</td>
               </tr>
                <tr class="font14">
                    <td class="width-5-percent">
                        <a title="Edit Album" href="edit_album" class="glyphicon glyphicon-edit padding-left-10"></a>
                        <a title="Delete Album" href="delete" class="glyphicon glyphicon-remove"></a>
                    </td>
                    <td>cell is row 0, column 1</td>
                    <td>cell is row 0, column 1</td>
               </tr>
                <tr class="font14">
                    <td class="width-5-percent">
                        <a title="Edit Album" href="edit_album" class="glyphicon glyphicon-edit padding-left-10"></a>
                        <a title="Delete Album" href="delete" class="glyphicon glyphicon-remove"></a>
                    </td>
                    <td>cell is row 0, column 1</td>
                    <td>cell is row 0, column 1</td>
               </tr>
                <tr class="font14">
                    <td class="width-5-percent">
                        <a title="Edit Album" href="edit_album" class="glyphicon glyphicon-edit padding-left-10"></a>
                        <a title="Delete Album" href="delete" class="glyphicon glyphicon-remove"></a>
                    </td>
                    <td>cell is row 0, column 1</td>
                    <td>cell is row 0, column 1</td>
               </tr>
            </tbody>
        </table>
    </div>
    
    
</div>
