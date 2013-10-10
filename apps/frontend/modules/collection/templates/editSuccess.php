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
    if ($view == 'river')
        include_partial('formrivers', array('form' => $form, 'error' => $error, 'view' => $view, 'actionType' => $actionType));
    else
        include_partial('form', array('form' => $form, 'error' => $error, 'view' => $view, 'actionType' => $actionType))
        ?>
