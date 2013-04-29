Recording Date Report

<?php echo isset($Bug) ? 'sadasdsa'.$Bug : 'NOps'; ?>
<form action="<?php echo url_for('reports/assetsgroupsscoringreports') ?>" method="post">
    <?php echo $form['listUnits_RRD']->render(); ?>
    <?php echo $form['format_id']->render(); ?>
    <?php echo $form['ExportType']->render(); ?>
    <input type="submit" value="Export" />
</form>