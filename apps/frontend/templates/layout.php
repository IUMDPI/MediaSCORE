<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>

<header><div id="header" class="clearfix">
<h1 class="ir"><a href="#">Indiana University MediaSCORE</a></h1>
<div class="log-out"><a href="<?php echo url_for('sfGuardAuth/signout') ?>">Log Out</a></div>
</div></header>

<nav>
<div id="nav" class="clearfix">
<div class="assess selected"><a href="#content-container"><img src="/images/wireframes/assess-icon.png" alt="Assess"><h2>Assess</h2></a></div>
<div class="report"><a href="#"><img src="/images/wireframes/report-icon.png" alt="Report"><h2>Report</h2></a></div>
<div class="settings"><a href="<?php echo url_for('storagelocation/index') ?>"><img src="/images/wireframes/settings-icon.png" alt="Settings"><h2>Settings</h2></a></div>
</div>
</nav>

<div id="tabs">
		<ul>
			<li><a href="#content-container">Assess</a></li>
			<li><a href="#">Report</a></li>
			<li><a href="/frontend_dev.php/storagelocation">Settings</a></li>
		</ul>

<div id="content">
	<div id="content-container">
		<?php echo $sf_content ?>
	</div>
</div>

<footer><img src="/images/wireframes/indiana-university-footer-logo.png" alt="Indiana University" /><a href="#">Copyright</a> ©2008 The Trustees of <a href="#">IndianaUniversity</a> | <a href="#">Copyright Complaints</a></footer>

</body>
</html>
