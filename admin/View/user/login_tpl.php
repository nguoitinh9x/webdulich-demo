<!-- Top fixed navigation -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="Assets/images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- Main content wrapper -->
<div class="loginWrapper">
    <!--<div class="loginLogo"><img src="images/logo.png" alt="" /></div>-->
    <div class="widget" id="loginForm">
        <div class="title"><img src="Assets/images/icons/dark/files.png" alt="" class="titleIcon" /><h6>Đăng nhập</h6></div>
        <form action="#" id="validate" class="" method="post">
            <fieldset>
                <div class="formRow">
                    <label for="login">Tên đăng nhập :</label>
                    <div class="loginInput"><input type="text" name="username" class="validate[required]" id="username" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Mật khẩu :</label>
                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="pass" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <input type="submit" value="Đăng nhập" class="dredB logMeIn" />
                    <div class="clear"></div>
                </div>
                <div class="ajaxloader"><img src="Assets/images/loader.gif" alt="loader" /></div>
                <div id="loginError">
                </div>
            </fieldset>
        </form>
    </div>

    </div>
</div>    