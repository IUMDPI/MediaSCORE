
<h2> Hello, <?php echo $user->getName();?></h2>

<h3>Enter your new password in the form below.</h3>

<form action="<?php echo url_for('sfGuardAuth/changePassword')?>" method="POST">
  <table>
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot><tr><td><input type="submit" name="change" value="Update Password" /></td></tr></tfoot>
  </table>
</form>