<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('film/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                    <?php echo $form['gauge']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['gauge']->render(); ?> 
                    <?php echo $form['gauge']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['color']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['color']->render(); ?> 
                    <?php echo $form['color']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['colorFade']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['colorFade']->render(); ?> 
                    <?php echo $form['colorFade']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['soundtrackFormat']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['soundtrackFormat']->render(); ?> 
                    <?php echo $form['soundtrackFormat']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['substrate']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['substrate']->render(); ?> 
                    <?php echo $form['substrate']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['strongOdor']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['strongOdor']->render(); ?> 
                    <?php echo $form['strongOdor']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['vinegarOdor']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['vinegarOdor']->render(); ?> 
                    <?php echo $form['vinegarOdor']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['ADStripLevel']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['ADStripLevel']->render(); ?> 
                    <?php echo $form['ADStripLevel']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['shrinkage']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['shrinkage']->render(); ?> 
                    <?php echo $form['shrinkage']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['levelOfShrinkage']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['levelOfShrinkage']->render(); ?> 
                    <?php echo $form['levelOfShrinkage']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['rust']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['rust']->render(); ?> 
                    <?php echo $form['rust']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['pack_deformation']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['pack_deformation']->render(); ?> 
                    <?php echo $form['pack_deformation']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['discoloration']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['discoloration']->render(); ?> 
                    <?php echo $form['discoloration']->renderError(); ?>
                </td>

            </tr>
            <tr>
                <th>
                    <?php echo $form['surfaceBlisteringBubbling']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['surfaceBlisteringBubbling']->render(); ?> 
                    <?php echo $form['surfaceBlisteringBubbling']->renderError(); ?>
                </td>

            </tr>

        </tbody>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        checkSubstracte();
        checkColor();
        
    });
    function checkSubstracte(){
        if($('#film_substrate').val()=='2'){
            $('#film_strongOdor').show();
            $('label[for="film_strongOdor"]').show();
            $('#film_discoloration').show();
            $('label[for="film_discoloration"]').show();
            $('#film_surfaceBlisteringBubbling').show();
            $('label[for="film_surfaceBlisteringBubbling"]').show();
        }
        else{
            $('#film_strongOdor').hide();
            $('label[for="film_strongOdor"]').hide();
            $('#film_discoloration').hide();
            $('label[for="film_discoloration"]').hide();
            $('#film_surfaceBlisteringBubbling').hide();
            $('label[for="film_surfaceBlisteringBubbling"]').hide();
        }
        if($('#film_substrate').val()=='1'){
            $('#film_vinegarOdor').show();
            $('label[for="film_vinegarOdor"]').show();
        }
        else{
            $('#film_vinegarOdor').hide();
            $('label[for="film_vinegarOdor"]').hide();
        }
    }
    function checkColor(){
        if($('#film_color').val()!=''){
            $('#film_colorFade').show();
            $('label[for="film_colorFade"]').show();
        }
        else{
            $('#film_colorFade').hide();
            $('label[for="film_colorFade"]').hide();
        }
    }
</script>


<script type="text/javascript">
    $(function(){
        $("#format_type_off_brand").parents(".row").show();
        $("#format_type_fungus").parents(".row").show();
    });
</script>