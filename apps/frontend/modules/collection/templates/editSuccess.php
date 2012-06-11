<div id="edit_collection">
<script src="/js/jquery_collection_form_edit.js" type="text/javascript"></script>
<header><h5 class="fancybox-heading">Edit Collection</h5></header>
<?php
    if (isset($locationError))
        $error = $locationError;
    else
        $error = '';
    ?>
<?php include_partial('form', array('form' => $form,'error'=>$error)) ?>
