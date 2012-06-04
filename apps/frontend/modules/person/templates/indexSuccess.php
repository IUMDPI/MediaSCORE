<a class="button" href="<?php echo url_for('person/new') ?>">Create Unit Personnel</a>
<?php //echo get_slot('settingsMenu')   ?>

<div id="settings-container">
    <table id="personTable" class="tablesorter">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Units</th>
<!--                <th></th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($persons as $person): ?>
                <tr>
                    <td><?php echo $person->getFirstName() ?></td>
                    <td><?php echo $person->getLastName() ?></td>
                    <td><?php echo $person->getEmailAddress() ?></td>
                    <td>
                        <?php foreach ($person->getUnits() as $unit): ?>
                            <div><span><?php echo $unit->getName() ?></span></div>
                        <?php endforeach ?>
                    </td>
                    <td class="invisible">
                        <div class="options">
                            <a href="<?php echo url_for('person/edit?id=' . $person->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                           <a href="#fancyboxUnitPerson" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUserID(<?php echo $person->getId(); ?>)"/></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php if (sizeof($persons) > 0) { ?>
    <div style="display: none;"> 
        <div id="fancyboxUnitPerson" style="background-color: #F4F4F4;width: 600px;" >
            <header>
                <h5  class="fancybox-heading">Warning!</h5>
            </header>
            <div style="margin: 10px;">
                <h3>Careful!</h3>
            </div>
            <div style="margin: 10px;font-size: 0.8em;">
                You are about to delete a Unit Personnel which will permanently erase all information associated with it.<br/>
                Are you sure you want to proceed?
            </div>
            <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a  href="javascript:void(0);" onclick="deleteUser();">YES</a></div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#personTable").tablesorter();
        $(".delete_unit").fancybox({
            'width': '100%',
            'height': '100%',
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'inline',
            'padding': 0,
            'showCloseButton':false
           
        });
       
        
    });
    var personID=null;
    function getUserID(id){
        personID=id;
      
    }
    function deleteUser(){
        window.location.href='/person/delete?id='+personID;
    }
    
</script>