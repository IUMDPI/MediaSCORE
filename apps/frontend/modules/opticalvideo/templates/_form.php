<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('opticalvideo/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>

        </tfoot>
        <tbody>
            <tr>
                <th>
                    <?php echo $form->renderHiddenFields(); ?>
                    <?php echo $form['format']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['format']->render(); ?> 
                    <?php echo $form['format']->renderError(); ?>
                </td>

            </tr> 
            <tr>
                <th>
                    <?php echo $form['opticalDiscType']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['opticalDiscType']->render(); ?> 
                    <?php echo $form['opticalDiscType']->renderError(); ?>
                </td>

            </tr> 
            <tr>
                <th>
                    <?php echo $form['reflectiveLayer']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['reflectiveLayer']->render(); ?> 
                    <?php echo $form['reflectiveLayer']->renderError(); ?>
                </td>

            </tr> 
            <tr>
                <th>
                    <?php echo $form['dataLayer']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['dataLayer']->render(); ?> 
                    <?php echo $form['dataLayer']->renderError(); ?>
                </td>

            </tr> 
            <tr>
                <th>
                    <?php echo $form['physicalDamage']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['physicalDamage']->render(); ?> 
                    <?php echo $form['physicalDamage']->renderError(); ?>
                </td>

            </tr> 
            <tr>
                <th>
                    <?php echo $form['materialsBreakdown']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['materialsBreakdown']->render(); ?> 
                    <?php echo $form['materialsBreakdown']->renderError(); ?>
                </td>

            </tr> 
        </tbody>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $("#optical_video_dataLayer").multiselect({
            'height':'auto',
            'minWidth':145
        });
        $("#optical_video_reflectiveLayer").multiselect({
            'height':'auto',
            'minWidth':145
        });
        
        
    });
</script>


<script type="text/javascript">
    $(function(){
        $("#format_type_off_brand").parents(".row").show();
        $("#format_type_fungus").parents(".row").show();
    });
</script>