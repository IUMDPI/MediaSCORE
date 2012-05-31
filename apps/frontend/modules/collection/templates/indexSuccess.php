<a class="button" href="<?php echo url_for('collection/new?u=' . $unitID) ?>">Create Collection</a>

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
<div id="filter-container">
    <div id="filter" class="Xhidden" style="display:none;"> <!-- toggle class "hidden" to show/hide -->
        <div class="title">Filter by:</div>
        <form>
            <strong>Text:</strong> <input type="text" class="text" />
            <strong>Date:</strong>
            <div class="filter-date">
                <select>
                    <option value="date-type">Created On</option>
                    <option value="date-type">Updated On</option>
                </select>
                <input type="text" />
                to
                <input type="text" />
            </div>
            <strong>Status:</strong>
            <select>
                <option value="date-type">Created On</option>
                <option value="date-type">Updated On</option>
            </select>
        </form>
        <div class="reset"><a href="#"><span>R</span> Reset</a></div>
    </div>
</div> 
<div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div> 
<div class="breadcrumb small"><a href="<?php echo url_for('unit/index') ?>">All Units</a>&nbsp;&gt;&nbsp;<?php echo $unitName ?></div>
<table>
    <?php if(sizeof($collections)>0){ ?>
    <thead>
        <tr>
            <th>Collection</th>
            <th>Created</th>
            <th>Created By</th>
            <th>Updated On</th>
            <th>Updated By</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($collections as $collection): ?>
            <tr>
                <td><a href="<?php echo url_for('assetgroup/index?c=' . $collection->getId()) ?>"><?php echo $collection->getName() ?></a></td>
                <td><?php echo $collection->getCreatedAt() ?></td>
                <td><?php echo $collection->getCreator()->getName() ?></td>
                <td><?php echo $collection->getUpdatedAt() ?></td>
                <td><?php echo $collection->getEditor()->getName() ?></td>
                <td class="invisible">

                    <div class="options">
                        <a href="<?php echo url_for('collection/edit?id=' . $collection->getId()) . '/u/' . $collection->getParentNodeId() ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                        <a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId(<?php echo $collection->getId();?>);"/></a>
                       
                    </div>

                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php } else{
        echo '<tr><td>No Collection Available</td></tr>';
    }?>
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
            'padding': 0,
            'showCloseButton':false
           
        });
    });
    var filter=1;
    var collectionId=null;
    function filterToggle(){
        $('#filter').slideToggle();
        if(filter==0){
            filter=1;
            $('#filter_text').html('Show Filter');
            
        }
        else{
            $('#filter_text').html('Hide Filter');
            filter=0;
        }
            
            
    }
    function getCollectionId(id){
        collectionId=id;
    }
    function deleteCollection(unit){
        window.location.href='/collection/delete?id='+collectionId+'&u='+unit;
    }
</script>
<?php if(sizeof($collections)>0){ ?>
<div style="display: none;"> 
    <div id="fancybox" style="background-color: #F4F4F4;width: 600px;" >
        <header>
            <h5  class="fancybox-heading">Warning!</h5>
        </header>
        <div style="margin: 10px;">
            <h3>Careful!</h3>
        </div>
        <div style="margin: 10px;font-size: 0.8em;">
            You are about to delete a Collection which will permanently erase all information associated with it.<br/>
            Are you sure you want to proceed?
        </div>
        <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="deleteCollection(<?php echo $unitID; ?>);">YES</a></div>
    </div>
</div>
<?php } ?>