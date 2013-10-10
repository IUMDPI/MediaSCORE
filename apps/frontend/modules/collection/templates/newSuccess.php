<div id="new_collection">
    <script src="/js/jquery_collection_form.js" type="text/javascript"></script>
    <header><h5 class="fancybox-heading">Create Collection</h5></header>
    <?php
    if ($view == 'river')
        include_partial('formrivers', array('form' => $form, 'view' => $view, 'actionType' => $actionType));
    else
        include_partial('form', array('form' => $form, 'view' => $view, 'actionType' => $actionType));
    ?>


