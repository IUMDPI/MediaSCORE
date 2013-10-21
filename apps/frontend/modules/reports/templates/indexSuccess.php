<h1>Reports List</h1>
<hr/>
<table>
    <tbody>
        <?php
        if ($IsMediaScoreAccess || $sf_user->getGuardUser()->getRole() == 1) {
            ?>
            <tr>
                <th><br/></th>
            </tr>
            <tr>
                <th><h2>Media Score</h2></th>    
    </tr>
    <tr>
        <th><hr/></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/recordingdatereport') ?>">Recording Date Report</a></label></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/assetsgroupsscoringreports') ?>">Asset Groups Scoring Reports</a></label></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/collectionstatusreport') ?>">Collection Status Report</a></label></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/problemmediareport') ?>">Problem Media Report</a></label></th>
    </tr>
    <?php
    if ($sf_user->getGuardUser()->getRole() != 2) {
        ?>
        <tr>
            <th><label><a href="<?php echo url_for('reports/alldataoutputreport') ?>">All Data output</a></label></th>
        </tr>
        <tr>
            <th><label><a href="<?php echo url_for('reports/evaluatorsreport') ?>">Evaluator's Report</a></label></th>
        </tr>
    <?php } ?>
    <tr>
        <th><label><a href="<?php echo url_for('reports/percentageofholdings') ?>">Percentage of holdings</a></label></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/durationandquantitysearch') ?>">Duration Reports</a></label></th>
    </tr>
<?php } else { ?>
    <tr><th><center><label><a>You don't have Reports Access</a></label></center></th></tr>
<?php } ?>
<tr>
    <th><br/></th>
</tr>
<tr>
    <th><h2>Media River</h2></th>    
</tr>
<tr>
    <th><hr/></th>
</tr>
<tr>
    <th><label><a href="<?php echo url_for('reports/mediariversfullreport') ?>">Full Media River Report</a></label></th>
</tr>
<tr>
    <th><label><a href="<?php echo url_for('reports/mediariversfullreport') ?>">Media Rivers Scoring Report</a></label></th>
</tr>
</tbody>
</table>


