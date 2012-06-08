<div id="search-box">
    <form action="<?php echo url_for('unit/search') ?>" method="post" onkeypress="return event.keyCode != 13;">
        <div class="search-input">
            <div id="token_string" style="float: left;">
                <?php foreach ($searchString as $key => $value) { ?>
                    <div class="token" id="div_<?php echo $key + 1; ?>">
                        <span id="search_string_<?php echo $key + 1; ?>"><?php echo $value; ?></span>
                        <span> 
                            <a href="javascript:void(0);" onclick="removeTokenDiv(<?php echo $key + 1; ?>);">X</a>
                        </span>
                    </div>
                <?php } ?>

            </div>
            <input type="hidden" id="search_values" name="search_values" value="<?php echo $searchValues; ?>"/>
            <input type="search" placeholder="Search all records" id="mainsearch" onkeyup="makeToken(event);"/>
            <div class="container">
                <a class="search-triangle" href="javascript:void(0);" onclick="$('.dropdown-container').slideToggle();$('.dropdown-container').css('width',$('.search-input').width()+26);"></a><b class="token-count"><?php echo count($searchString); ?></b>
                <a class="search-close" href="javascript:void(0);" onclick="removeAllTokenDivs();"></a>
            </div>
            <input class="button" type="submit" value="" />
            <div class="dropdown-container" style="height: 200px;overflow-y: scroll;display: none;">
                <div class="dropdown clearfix Xhidden">
                    <ul class="left-column">
                        <li><h1>Format</h1></li>
                        <?php
                        foreach (FormatType::$formatTypesValue as $formatTypeArray):
                            foreach ($formatTypeArray as $formatTypeModelName => $formatTypeStr):
                                ?>
                                <li><a id="type_<?php echo $formatTypeModelName ?>" value="<?php echo $formatTypeModelName ?>" onclick="makeTypeToken('<?php echo $formatTypeStr ?>');"><?php echo $formatTypeStr ?></a></li>

                                <?php
                            endforeach;
                        endforeach
                        ?>

                    </ul>
                    <ul class="right-column">
                        <li><h1>Type</h1></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(0);">Unit</a></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(1);">Collection</a></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(2);">Asset Group</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<table id="searchTable" class="tablesorter">
    <thead>
        <tr>
            <th><span>Title</span></th>
            <th><span>Created</span></th>
            <th><span>Created By</span></th>
            <th><span>Updated On</span></th>
            <th><span>Updated By</span></th>
        </tr>
    </thead>
    <tbody id="unitResult">
        <?php if (isset($formatsResult) && sizeof($formatsResult) > 0) { ?>
            <?php foreach ($formatsResult as $result): ?>
                <tr>
                    <td><a href="assetgroup/edit/id/<?php echo $result->getId(); ?>/c/<?php echo $result->getParentNodeId(); ?>"><?php echo $result->getName() ?></a>&nbsp;&nbsp;<span class="help-text">Asset Group</span></td>
                    <td><?php echo $result->getCreatedAt() ?></td>
                    <td>
                        <?php echo '<span>' . $result->getCreator()->getName() . '</span>'; ?>
                    </td>
                    <td><?php echo $result->getUpdatedAt() ?></td>
                    <td>
                        <?php echo $result->getEditor()->getName(); ?>
                    </td>

                    <td class="invisible">
                        <div class="options">
                            <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID(<?php echo $result->getId(); ?>)"/></a>
                        </div>
                    </td>
                </tr>
                <?php
            endforeach;
        }
        ?>
        <?php if (isset($storeResult) && sizeof($storeResult) > 0) { ?>
            <?php
            foreach ($storeResult as $result):
                if ($result->getType() == 1) {
                    $text = 'Unit';
                    $urlOnName = '/collection?u=' . $result->getId();
                    $urlonEdit = 'unit/edit/id/' . $result->getId();
                }
                if ($result->getType() == 3) {
                    $text = 'Collection';
                    $urlOnName = '/assetgroup?c=' . $result->getId();
                    $urlonEdit = 'collection/edit/id/' . $result->getId() . '/u/' . $result->getParentNodeId();
                }
                if ($result->getType() == 4) {
                    $text = 'Asset Group';
                    $urlOnName = '/assetgroup/edit/id/' . $result->getId() . '/c/' . $result->getParentNodeId();
                }
                ?>
                <tr>
                    <td><a href="<?php echo $urlOnName; ?>"><?php echo $result->getName() ?></a>&nbsp;&nbsp;<span class="help-text"><?php echo $text; ?></span></td>
                    <td><?php echo $result->getCreatedAt() ?></td>
                    <td>
                        <?php echo '<span>' . $result->getCreator()->getName() . '</span>'; ?>
                    </td>
                    <td><?php echo $result->getUpdatedAt() ?></td>
                    <td>
                        <?php echo $result->getEditor()->getName(); ?>
                    </td>

                    <td class="invisible">
                        <div class="options">
                            <?php if ($result->getType() != 4) { ?>
                                <a href="<?php echo $urlonEdit; ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                            <?php } ?>
                            <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID(<?php echo $result->getId(); ?>)"/></a>
                        </div>
                    </td>
                </tr>
                <?php
            endforeach;
        }
        ?>
        <?php if (isset($randomSearch) && sizeof($randomSearch) > 0) { ?>
            <?php
            foreach ($randomSearch as $result):
                if ($result->getType() == 1) {
                    $text = 'Unit';
                    $urlOnName = '/collection?u=' . $result->getId();
                    $urlonEdit = 'unit/edit/id/' . $result->getId();
                }
                if ($result->getType() == 3) {
                    $text = 'Collection';
                    $urlOnName = '/assetgroup?c=' . $result->getId();
                    $urlonEdit = 'collection/edit/id/' . $result->getId() . '/u/' . $result->getParentNodeId();
                }
                if ($result->getType() == 4) {
                    $text = 'Asset Group';
                    $urlOnName = '/assetgroup/edit/id/' . $result->getId() . '/c/' . $result->getParentNodeId();
                }
                ?>
                <tr>
                    <td><a href="<?php echo $urlOnName; ?>"><?php echo $result->getName() ?></a>&nbsp;&nbsp;<span class="help-text"><?php echo $text; ?></span></td>
                    <td><?php echo $result->getCreatedAt() ?></td>
                    <td>
                        <?php echo '<span>' . $result->getCreator()->getName() . '</span>'; ?>
                    </td>
                    <td><?php echo $result->getUpdatedAt() ?></td>
                    <td>
                        <?php echo $result->getEditor()->getName(); ?>
                    </td>

                    <td class="invisible">
                        <div class="options">
                            <?php if ($result->getType() != 4) { ?>
                                <a href="<?php echo $urlonEdit; ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                            <?php } ?>
                            <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUnitID(<?php echo $result->getId(); ?>)"/></a>
                        </div>
                    </td>
                </tr>
                <?php
            endforeach;
        }
        ?>
    </tbody>
    <?php ?>
</table>
<script type="text/javascript">
    var token=0;
    $(document).ready(function() {
         $("#searchTable").tablesorter(); 
       
        
        
    });
    
    token='<?php echo count($searchString); ?>';
    token=parseInt(token);
    var removeToken=0;
    function makeToken(event){
        if (event.keyCode == 13 && $('#mainsearch').val()!='') {
            token=token+1;
            $('#token_string').append('<div class="token" id="div_'+token+'"><span id="search_string_'+token+'">'+$('#mainsearch').val()+'</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv('+token+');">X</a></span></div>');
            getRecords();
            $('#mainsearch').val('');
            $('.dropdown-container').css('width',$('.search-input').width()+26);
        }
        else if (event.keyCode == 8) {
            if($('#mainsearch').val()=='' && token!=0){
                if(removeToken==1){
                    $('.token').last().remove();
                    $('.dropdown-container').css('width',$('.search-input').width()+26);
                    token=token-1;
                    removeToken=0;
                    getRecords();
                }
                else{
                    removeToken=1;
                }
            }
        }
        if(token>0){
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
        }
        else{
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
    }
    function removeTokenDiv(id){
        $('#div_'+id).remove();
        token=token-1;
        getRecords();
        if(token>0){
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
            $('.dropdown-container').css('width',$('.search-input').width()+26);
        }
        else{
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
    }
    function removeAllTokenDivs(){
        $('.token').remove();
        token=0;
        getRecords();
        $('.token-count').html(token);
        $('.search-close').hide();
        $('.token-count').hide();
        $('.dropdown-container').css('width',$('.search-input').width()+26);

        
    }
    function makeTypeToken(type){
        if(type==0){
            value='Unit';
        }
        else if(type==1){
            value='Collection';
        }
        else if(type==2){
            value='Asset Group';
        }
        else{
            value=type;
        }
        token=token+1;
        $('#token_string').append('<div class="token" id="div_'+token+'"><span id="search_string_'+token+'">'+value+'</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv('+token+');">X</a></span></div>');
        getRecords();
        $('.dropdown-container').css('width',$('.search-input').width()+26);
        if(token>0){
            $('.token-count').html(token);
            $('.search-close').show();
            $('.token-count').show();
            
        }
        else{
            $('.token-count').html(token);
            $('.search-close').hide();
            $('.token-count').hide();
        }
    }
    function getRecords(){
        var search=new Array();
        count=1;;
        if(token>0){
            for(i=1;i<=token;){
                if($('#search_string_'+count).length>0){
                    search[i-1]=$('#search_string_'+count).text();
                    i++;
                }
                count++;
            }
        }
        $('#search_values').val(search);
    }
</script>