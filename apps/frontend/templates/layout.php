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
<span><a href="#">Log Out</a></span>
<div id="content">
	<div id="tabs">
		<ul>
			<li><a href="#content-container">Assess</a></li>
			<li><a href="#">Report</a></li>
			<li><a href="<?php echo url_for('storagelocation/index') ?>">Settings</a></li>
		</ul>
		<div id="content-container">
			<?php echo $sf_content ?>
		</div>
	</div>
</div>
  </body>
</html>
