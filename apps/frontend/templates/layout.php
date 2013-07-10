<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
		
        <script type="text/javascript">
			
            $(function(){
                $('.ui-multiselect-checkboxes li label span').attr('style','margin-left:5px') ;
            });
			
        </script>
    </head>
    <body>

        <header>
            <div id="header" class="clearfix">
                <h1 class="ir"><a href="/">Indiana University MediaSCORE</a></h1>
                <?php if ($sf_user->isAuthenticated()) { ?>
                    <div class="log-out"><a href="<?php echo url_for('sfGuardAuth/signout') ?>">Log Out</a></div>
                <?php } ?>
            </div>

        </header>

        <nav>

            <div id="nav" class="clearfix">
                <?php if ($sf_user->isAuthenticated()) { ?>
                    <?php
                    if (($sf_context->getInstance()->getModuleName() == "unit") || ($sf_context->getInstance()->getModuleName() == "collection") || ($sf_context->getInstance()->getModuleName() == "assetgroup")) {
                        echo '<div class="assess selected"><a href="' . url_for("@homepage") . '"><img src="/images/wireframes/assess-icon.png" alt="Assess"><h2>Assess</h2></a></div>';
                    } else {
                        echo '<div class="assess"><a href="' . url_for("@homepage") . '"><img src="/images/wireframes/assess-icon.png" alt="Assess"><h2>Assess</h2></a></div>';
                    }
                    ?>
                    <?php if (($sf_context->getInstance()->getModuleName() == "reports")) { ?>
                        <div class="report selected"><a href="<?php echo url_for('reports/index') ?>"><img src="/images/wireframes/report-icon.png" alt="Report"><h2>Report</h2></a></div>
                    <?php } else { ?>
                        <div class="report"><a href="<?php echo url_for('reports/index') ?>"><img src="/images/wireframes/report-icon.png" alt="Report"><h2>Report</h2></a></div>
                    <?php } ?>

                    <?php
                    if (($sf_context->getInstance()->getModuleName() == "storagelocation") || ($sf_context->getInstance()->getModuleName() == "person") || ($sf_context->getInstance()->getModuleName() == "user")) {

                        echo '<div class="settings selected"><a href="' . url_for('storagelocation/index') . '"><img src="/images/wireframes/settings-icon.png" alt="Settings"><h2>Settings</h2></a></div>';
                    } else {
                        echo '<div class="settings"><a href="' . url_for('storagelocation/index') . '"><img src="/images/wireframes/settings-icon.png" alt="Settings"><h2>Settings</h2></a></div>';
                    }
                    ?> 

                <?php } else { ?>
                    <div class="assess"><img src="/images/wireframes/assess-icon.png" alt="Assess"><h2>Assess</h2></div>
                    <div class="report"><img src="/images/wireframes/report-icon.png" alt="Report"><h2>Report</h2></div>
                    <div class="settings"><img src="/images/wireframes/settings-icon.png" alt="Settings"><h2>Settings</h2></div>
                <?php } ?>

            </div>
        </nav>



        <div id="main-container">

            <div id="main" class="clearfix">
                <?php if (($sf_context->getInstance()->getModuleName() == "storagelocation") || ($sf_context->getInstance()->getModuleName() == "person") || ($sf_context->getInstance()->getModuleName() == "user")) { ?>
                    <ul id="settings-navigation">
                        <?php if ($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getRole() == 1) { ?>
                            <li class=""><a class="menu-link" href="<?php echo url_for('user/index') ?>">Users</a></li>
                        <?php } ?>
                        <li class=""><a class="menu-link" href="<?php echo url_for('person/index') ?>">Unit Personnel</a></li>
                        <li class=""><a class="menu-link" href="<?php echo url_for('storagelocation/index') ?>">Storage Locations</a></li>
                        <li class=""><a class="menu-link" href="<?php echo url_for('user/edit?id=') . $sf_user->getGuardUser()->getId() ?>">Edit Profile </a></li>
    <!--			<li class=""><?php //echo link_to2('Edit Profile', 'sf_guard_user_edit', $sf_user->getGuardUser(), array('class' => 'menu-link'))         ?></li>-->
                    </ul>
                <?php } ?>
                <?php echo $sf_content ?>
            </div>
        </div>

        <footer><img src="/images/wireframes/indiana-university-footer-logo.png" alt="Indiana University" /><a href="#">Copyright</a> ©2008 The Trustees of <a href="#">IndianaUniversity</a> | <a href="#">Copyright Complaints</a></footer>

    </body>
</html>
