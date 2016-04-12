<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="modal fade in" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block; padding-left: 17px;">
<div class="modal-dialog">
      <div class="loginmodal-container">
            <h1 class='font-primary'>Login to Your Account</h1><br>
            <form id="loginForm" name="loginForm" action="index/xlogin" method="post">
                <input class='font-primary' type="text" id="per_username" name="per_username" placeholder="Username">
                <input class='font-primary' type="password" id="per_password" name="per_password" placeholder="Password">
                <button type="button" class="fr btn btn-style font-primary loginBtn">Login</button>
            </form>
            <div class="login-help">
                <!--<a href="#">Register</a> - <a href="#">Forgot Password</a>-->
            </div>
      </div>
  </div>
</div>