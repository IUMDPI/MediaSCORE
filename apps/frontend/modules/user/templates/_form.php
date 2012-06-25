<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('user/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table style="width: 50%;">
        <tfoot>
            <tr>
                <td colspan="2">


                    <input type="submit" value="Save" />&nbsp;or <a href="<?php echo url_for('user/index') ?>">Cancel</a>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderHiddenFields(); ?>
            <?php if ($sf_user->getGuardUser()->getRole() == 1 || !$form->getObject()->isNew()) { ?>
                <tr>
                    <th>

                        <?php echo $form['first_name']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['first_name']->render(); ?> 
                        <?php echo $form['first_name']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>

                        <?php echo $form['last_name']->renderLabel(); ?>
                    </th>
                    <td>
                        <?php echo $form['last_name']->render(); ?> 
                        <?php echo $form['last_name']->renderError(); ?>
                    </td>

                </tr>
            <?php } ?>
            <tr>
                <th>

                    <?php echo $form['email_address']->renderLabel(); ?>
                </th>
                <td>
                    <?php echo $form['email_address']->render(); ?> 
                    <?php echo $form['email_address']->renderError(); ?>
                </td>

            </tr>

            <?php if ($sf_user->getGuardUser()->getRole() == 1 || !$form->getObject()->isNew()) { ?>
                <tr>
                    <th>

                        <?php echo $form['password']->renderLabel(); ?>
                    </th>
                    <td>
                       
                        <?php
                        if (!$form->getObject()->isNew()) {
                            echo $form['password']->render(array('title' => 'User may reset password by selecting "forgot password" link at login'));
                        } else {
                            echo $form['password']->render();
                        }
                        ?>
                        <?php echo $form['password']->renderError(); ?>
                    </td>

                </tr>
                <tr>
                    <th>

                        <?php echo $form['password_again']->renderLabel(); ?>
                    </th>
                    <td>

                        <?php
                        if (!$form->getObject()->isNew()) {
                            echo $form['password_again']->render(array('title' => 'User may reset password by selecting "forgot password" link at login'));
                        } else {
                            echo $form['password_again']->render();
                        }
                        ?>


    <?php echo $form['password_again']->renderError(); ?>
                    </td>

                </tr>
<?php } ?>
            <tr>
                <th>

<?php echo $form['phone']->renderLabel(); ?>
                </th>
                <td>
<?php echo $form['phone']->render(); ?> 
                    <?php echo $form['phone']->renderError(); ?>
                </td>

            </tr>
<?php if ($sf_user->getGuardUser()->getRole() == 0) {
    $style = 'style="display:none;"';
} else {
    $style = '';
} ?>
            <tr <?php echo $style; ?>>
                <th>

                    <?php echo $form['role']->renderLabel(); ?>
                </th>
                <td>
<?php echo $form['role']->render(array('title' => 'Select the role of the user within this application')); ?> 
<?php echo $form['role']->renderError(); ?>
                </td>

            </tr>

        </tbody>
    </table>
</form>
