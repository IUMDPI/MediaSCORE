
<!--<a class="button" href="<?php // echo url_for('unit/new')        ?>">Create Unit</a>-->
<a class="button create_new_unit" href="<?php echo url_for('unit/new') ?>">Create Unit</a>
<div id="search-box">
    <form>
        <div class="search-input">
<!--            <div class="token">Token One<span> <a href="#">X</a></span></div>
          <div class="token">Token One<span> <a href="#">X</a></span></div>-->
            <input type="search" placeholder="Search all records"/>
            <div class="container">
                <a class="search-triangle" href="#"></a>
                <!--              <a class="search-close" href="#"></a>-->
            </div>
            <input class="button" type="submit" value="" />
            <!--            <div class="dropdown-container">
                          <div class="dropdown clearfix Xhidden">  toggle class "hidden" to show/hide 
                            <ul class="left-column">
                              <li><h1>Format</h1></li>
                              <li><a href="#">Format One</a></li>
                              <li><a href="#">Format Two</a></li>
                              <li><a href="#">Format Three</a></li>
                              <li><a href="#">Format Four</a></li>
                            </ul>
                            <ul class="right-column">
                              <li><h1>Type</h1></li>
                              <li><a href="#">Unit</a></li>
                              <li><a href="#">Collection</a></li>
                              <li><a href="#">Asset Group</a></li>
                            </ul>
                          </div>
                        </div>-->
        </div>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th>Unit</th>
            <th>Created</th>
            <th>Created By</th>
            <th>Updated On</th>
            <th>Updated By</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($units as $unit): ?>
            <tr>
                <td><a href="<?php echo url_for('collection/index?u=' . $unit->getId()) ?>"><?php echo $unit->getName() ?></a></td>
                <td><?php echo $unit->getCreatedAt() ?></td>
                <td>
                    <?php
//print_r( Doctrine_Core::getTable('User')->find( $unit->getCreatorId() )->getFirstName() );
                    echo $unit->getCreator()->getName();

                    /* $evaluatorName = $creators[$unit->getId()];
                      if($evaluatorName == ' ')
                      echo 'Administrator';
                      else
                      echo $evaluatorName; */
                    ?>
                </td>
                <td><?php echo $unit->getUpdatedAt() ?></td>
                <td>
                    <?php
                    echo $unit->getEditor()->getName();
                    /* $lastEditorName = $editors[$unit->getId()];
                      if($lastEditorName == ' ')
                      echo 'Administrator';
                      else
                      echo $lastEditorName; */
                    ?>
                </td>

                <td class="invisible">
                    <div class="options">
                        <a href="<?php echo url_for('unit/edit?id=' . $unit->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                        <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
       
        $(".delete_unit").fancybox({
            'width': '100%',
            'height': '100%',
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'inline',
            'padding': 0
           
        });
        $(".create_new_unit").fancybox({
            'width': '50%',
            'height': '100%',
            'autoScale': true,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'iframe',
            'padding': 0
        });
    });
    
</script>
<div style="display: none;"> 
    <div id="fancybox1" style="background-color: #F4F4F4;width: 600px;" >
        <header>
            <h5  class="fancybox-heading">Warning!</h5>
        </header>
        <div style="margin: 10px;">
            <h3>Careful!</h3>
        </div>
        <div style="margin: 10px;font-size: 0.8em;">
            You are about to changes the format type which will erase any data you've entered.<br/>
            Are you sureyou want to proceed and erase your entered data?
        </div>
        <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo url_for('unit/delete?id=' . $unit->getId()) ?>">YES</a></div>
    </div>
</div>