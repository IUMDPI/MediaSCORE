<!--<a style="float: right;text-decoration: none;font-size: 14px;font-weight: bold;" href="<?php // echo $url     ?>">< Back to Collections</a>
<br/>
<br/>-->

<div id="edit_collection">
    <script src="/js/jquery_collection_form_edit.js" type="text/javascript"></script>
    <header><h5 class="fancybox-heading">Edit Collection</h5></header>
		<?php
		if (isset($locationError))
			$error = $locationError;
		else
			$error = '';
		?>

	<?php
	if ($formType == 'river')
	{
		include_partial('formrivers', array('unit' => $unitId, 'form' => $form, 'error' => $error, 'view' => $view, 'actionType' => $actionType, 'cancelUrl' => $url, 'collection' => $collection));
		?>
		<?php
	}
	else
	{
		include_partial('form', array('form' => $form, 'error' => $error, 'view' => $view, 'actionType' => $actionType))
		?>
<?php }
?>
    