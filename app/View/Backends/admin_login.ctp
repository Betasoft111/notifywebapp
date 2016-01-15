<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?php echo WEBSITE?></title>
    
    <?php echo $this->Html->script(array('jquery-1.9.0.js','admin/ui/ui.widget.js','admin/ui/ui.tabs.js','admin/coustom/login.js'))?>
    <?php echo $this->Html->css(array('ui/ui.login.css','ui/ui.base.css','themes/apple_pie/ui.css'))?>

</head>
<body>
	<div id="page_wrapper">
		<div id="page-header">
			<div id="page-header-wrapper">
				<div id="top">					
                   <span class="logo"><?php echo WEBSITE?></span>
				</div>
			</div>
		</div>
        <div id="sub-nav">
            <div class="page-title">
                <h1>Admin Login</h1>
            </div>										
            <div id="page-layout">
                <div id="page-content">
                    <div id="page-content-wrapper">
                        <div id="tabs">
                            <ul>
                                <li><a href="#login">Login</a></li>
                                <li><a href="#recover">Recover password</a></li>
                            </ul>
                            <?php echo $this->Session->flash();?>
                            <div id="login">
                                <form action="<?php echo HTTP_ROOT.'admin/backends/login'?>" method="post">
                                    <ul>
                                        <li>
                                            <label for="email" class="desc">User Name:</label>
                                            <div>
                                                <input type="text" class="field text full required" name="username"/>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="password" class="desc">Password:</label>
                                            <div>
                                                <input type="password" value="" class="field text full required" name="password" />
                                            </div>
                                        </li>
                                        <li class="buttons">
                                            <div>
                                                <input class="ui-state-default ui-corner-all float-right ui-button" type="submit" value="Submit" />
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <div id="recover">                               
                                <ul>
                                    <form action="<?php echo HTTP_ROOT?>admin/backends/forgot_password" method="post">
                                         <li>
                                            <label for="email" class="desc">User Name:</label>
                                            <div>
                                                <input type="text" class="field text full required" name="username"/>
                                            </div>
                                        </li>
                                        <li class="buttons">
                                            <div>
                                                <input class="ui-state-default ui-corner-all float-right ui-button" type="submit" value="Get Password" />
                                            </div>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
	</div>
</body>
</html>
