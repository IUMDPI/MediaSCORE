<div id="edit_unit">
    <script src="/js/jquery_unit_form_edit.js" type="text/javascript"></script>
    <header><h5 class="fancybox-heading">Edit Unit</h5></header>
    <?php
    if (isset($locationError))
        $error = $locationError;
    else
        $error = '';
    ?>
    <?php include_partial('form', array('form' => $form,'error'=>$error)) ?>
