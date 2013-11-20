<h1>Reports List</h1>

<table>
    <tbody>
        <?php if (($IsMediaScoreAccess && $ISMediaRiverAccess) || $sf_user->getGuardUser()->getRole() == 1) { ?>
            <tr>
                <th><br/></th>
            </tr>
            <tr>
                <th>
        <h2> MediaSCORE & MediaRIVERS Scoring Report </h2>
    </th>    
    </tr>
    <tr>
        <th><hr style="color:#7D110C;"/></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/masterscorereport') ?>">Master Score Report</a></label><br/></th>
        
    </tr>

    <?php
}
if ($IsMediaScoreAccess || $sf_user->getGuardUser()->getRole() == 1) {
    ?>
    <tr>
        <th><br/></th>
    </tr>
    <tr>
        <th><h2>MediaSCORE</h2></th>    
    </tr>
    <tr>
        <th><hr style="color:#7D110C;"/></th>
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
<!--        <tr>
            <th><label><a href="<?php // echo url_for('reports/alldataoutputreport') ?>">All Data output</a></label></th>
        </tr>-->
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
    <!--    <tr><th><center><label>You don't have Reports Access</label></center></th></tr>-->
<?php } ?>

<?php if ($ISMediaRiverAccess || $sf_user->getGuardUser()->getRole() == 1) { ?>
    <tr>
        <th><br/></th>
    </tr>
    <tr>
        <th><h2>MediaRIVERS</h2></th>    
    </tr>
    <tr>
        <th><hr style="color:#7D110C;" /></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/mediariversfullreport') ?>">Full MediaRIVERS Report</a></label></th>
    </tr>
    <tr>
        <th><label><a href="<?php echo url_for('reports/mediariversscoringreport') ?>">MediaRIVERS Scoring Report</a></label></th>
    </tr>
<?php } else { ?>
    <!--    <tr><th><center><label>You don't have Reports Access</label></center></th></tr>-->
<?php } ?>
</tbody>
</table>


