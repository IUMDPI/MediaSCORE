<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    var collection_score_subject_interest_obj; 
    var collection_score_content_quality_obj;
    var collection_score_rareness_obj;
    var collection_score_documentation_obj;
    var collection_score_technical_quality_obj;
    var collection_collection_score_obj;
    
    //        Calculating total score and setting value in Collection store Field 
    function calculateScore(){
        var Total_Collection_Score = 0.0;
        
        var collection_score_subject_interest = parseFloat((collection_score_subject_interest_obj.val())? collection_score_subject_interest_obj.val():0);
        var collection_score_content_quality = parseFloat((collection_score_content_quality_obj.val())? collection_score_content_quality_obj.val():0);
        var collection_score_rareness =parseFloat((collection_score_rareness_obj.val())? collection_score_rareness_obj.val():0);
        var collection_score_technical_quality = parseFloat((collection_score_technical_quality_obj.val())? collection_score_technical_quality_obj.val():0);
        var collection_score_documentation = parseFloat((collection_score_documentation_obj.val())? collection_score_documentation_obj.val():0);
        Total_Collection_Score = Total_Collection_Score + collection_score_subject_interest;
        
        Total_Collection_Score = Total_Collection_Score + collection_score_content_quality;
        Total_Collection_Score = Total_Collection_Score + collection_score_rareness;
        Total_Collection_Score = Total_Collection_Score + collection_score_technical_quality;
        Total_Collection_Score = Total_Collection_Score + collection_score_documentation
        
        return Math.round(Total_Collection_Score * 100 ) /100;
    }
    
    //        Check is values a Number 
    function IsNumeric(input){
        return !isNaN(parseFloat(input)) && isFinite(input);
    }
    //        Checking if given score is a value numaric value and less then 5.1 
    function isValidScore(value){
        var result=false;
        
        if(value !='' && typeof value != "undefined") {
            if(IsNumeric(value)){
                value = parseFloat(value);
                if(value<=5){
                    result = true;
                }else{
                    result = false;
                }
            }else{
                result = false;
            }
        }else{
            result = true;
        }
        return result;
    }
    
    //        Score Placing and Validation of input Given Score Object
    function handleValuesOfTextField(object,CollectionScoreObj){
        var score = object.val();
        if(!isValidScore(score)){
            object.val(0)    
        }
        var Total_Collection_Score = 0.0;
        Total_Collection_Score = calculateScore();
        CollectionScoreObj.val(Total_Collection_Score/5);  
        
    }

    

            
    
    $(function(){
        //        Getting all Socre input fields Objects
        collection_score_subject_interest_obj = $("#collection_score_subject_interest"); 
        collection_score_content_quality_obj = $("#collection_score_content_quality");
        collection_score_rareness_obj = $("#collection_score_rareness");
        collection_score_documentation_obj = $("#collection_score_documentation");
        collection_score_technical_quality_obj = $("#collection_score_technical_quality");
        collection_collection_score_obj = $("#collection_collection_score");
        
        //        Subject Interest Score Placing  and Validation
        collection_score_subject_interest_obj.live( "keydown keyup change", function() {
            handleValuesOfTextField(collection_score_subject_interest_obj,collection_collection_score_obj); 
                      
        });
        
        //        Content Quality Score Placing  and Validation
        collection_score_content_quality_obj.live( "keydown keyup change", function() {
            handleValuesOfTextField(collection_score_content_quality_obj,collection_collection_score_obj);
                
        });
        
        
        //        Rareness Score Placing  and Validation
        collection_score_rareness_obj.live( "keydown keyup change", function() {
            handleValuesOfTextField(collection_score_rareness_obj,collection_collection_score_obj);
      
        });
        
        
        //        Documentation Score Placing And Validation
        collection_score_documentation_obj.live( "keydown keyup change", function() {
            handleValuesOfTextField(collection_score_documentation_obj,collection_collection_score_obj);
            
        });
        
        //        Technical Quality Score Placing  and Validation
        collection_score_technical_quality_obj.live( "keydown keyup change", function() {
            handleValuesOfTextField(collection_score_technical_quality_obj,collection_collection_score_obj);
           
        });
        //        Fixing date Text and removing the time from date
        var val = $("#collection_date_completed").val().split(' ');
        $("#collection_date_completed").val(val[0]);
        
        //        Initilizing the DataPicker for  collection_date_completed
        var dates = $("#collection_date_completed").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            'dateFormat': 'yy-mm-dd',
            minDate: $("#date_depart").val(),
            onSelect: function(selectedDate) {
                $("#collection_date_completed").datepicker('hide');
            }
        });
    });
        
        
        
        
    
</script>

<div style="background-color: #F4F4F4;padding-left: 10px;padding-right: 5px;" id="collectionMain">
    <div id="main" class="clearfix" style="height: auto;">
        <form id="collection_form" action="<?php echo 'http://mediascore.live.geekschicago.com' . url_for('collection/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
            <?php if (!$form->getObject()->isNew()): ?>
                <input type="hidden" name="sf_method" value="put" />
            <?php endif; ?>
            <table class="normal_form" cellpadding='0' cellspacing="0" width="100%">

                <tfoot>
                    <tr>
                        <td colspan="2"> 
                            <br/>
                            <input type="submit" value="Save" id="collection_save"/>
                            &nbsp;or&nbsp;<a href="javascript:void(0);" onclick="$.fancybox.close();">cancel</a>
                        </td>
                    </tr> 
                </tfoot>
                <tbody>

                    <?php if (isset($actionType) && $actionType == 'edit') { ?>
                        <tr>
                            <th>
                                <?php echo $form['parent_node_id']->renderLabel(); ?>
                            </th>
                            <td>
                                <?php echo $form['parent_node_id']->render(array('title' => 'Collection\'s parent Unit ')); ?> 
                                <?php echo $form['parent_node_id']->renderError(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr/>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>
                            <?php echo $form['inst_id']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['inst_id']->render(array('title' => 'The main ID used by the organization.')); ?> 
                            <?php echo $form['inst_id']->renderError(); ?>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <th>
                            <?php echo $form['name']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['name']->render(array('collection_name' => 'Name of the Collection.')); ?> 
                            <?php echo $form['name']->renderError(); ?>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <th>
                            <?php echo $form['characteristics']->renderLabel(); ?>
                        </th>
                        <td >
                            <?php echo $form['characteristics']->render(array('characteristics' => 'Characteristics.')); ?> 
                            <?php echo $form['characteristics']->renderError(); ?>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr >
                        <td colspan="2">
                            <div style="float: left; padding-right:30px;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['project_title']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['project_title']->render(array('project_title' => 'Project Title.')); ?> 
                                    <?php echo $form['project_title']->renderError(); ?>
                                </div>
                            </div>
                            <!--                            <div style="float: left ; padding-right:30px;">
                                                            <div style="font-weight: bold;">
                            <?php // echo $form['iub_unit']->renderLabel();   ?>
                                                            </div>
                                                            <div style="float: left;">
                            <?php // echo $form['iub_unit']->render(array('iub_unit' => 'IUB UNIT selection.'));   ?> 
                            <?php // echo $form['iub_unit']->renderError();  ?>
                                                            </div>
                                                        </div>
                         
                                                        <div style="float: left; padding-right:30px;">
                                                            <div style="font-weight: bold;">
                            <?php // echo $form['iub_work']->renderLabel();   ?>
                                                            </div>
                                                            <div style="float: left;">
                            <?php // echo $form['iub_work']->render(array('iub_work' => 'IUB Worker selection.'));   ?> 
                            <?php // echo $form['iub_work']->renderError();  ?>
                                                            </div>
                                                        </div>-->
                        </td>

                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <th>
                            <?php echo $form['date_completed']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['date_completed']->render(array('date_completed' => 'Date Completed.')); ?> 
                            <?php echo $form['date_completed']->renderError(); ?>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>

                    <!-- -->
                    <tr>
                        <td>
                            <span style="float: left;font-weight: bold;">Subject Interest:&nbsp;&nbsp;&nbsp; </span>
                            <div style="float: right; padding-right:30px;;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['score_subject_interest']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['score_subject_interest']->render(array('score_subject_interest' => 'Score Subject Interest.')); ?> 
                                    <?php echo $form['score_subject_interest']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="float: left;">
                                <div style="float: left;font-weight: bold;">
                                    <?php echo $form['notes_subject_interest']->renderLabel(); ?>
                                </div>
                                <br/>
                                <div>
                                    <?php echo $form['notes_subject_interest']->render(array('notes_subject_interest' => 'Notes Subject Interest.')); ?> 
                                    <?php echo $form['notes_subject_interest']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td>
                            <span style="float: left;font-weight: bold;">Content Quality:&nbsp;&nbsp;&nbsp; </span>
                            <div style="float: right; padding-right:30px;;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['score_content_quality']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['score_content_quality']->render(array('score_content_quality' => 'Score Content Quality.')); ?> 
                                    <?php echo $form['score_content_quality']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="float: left;">
                                <div style="float: left;font-weight: bold;">
                                    <?php echo $form['notes_content_quality']->renderLabel(); ?>
                                </div>
                                <br/>
                                <div>
                                    <?php echo $form['notes_content_quality']->render(array('notes_content_quality' => 'Notes Content Quality.')); ?> 
                                    <?php echo $form['notes_content_quality']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td>
                            <span style="float: left;font-weight: bold;">Rareness:&nbsp;&nbsp;&nbsp; </span>
                            <div style="float: right;padding-right:30px;;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['score_rareness']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['score_rareness']->render(array('score_rareness' => 'Score Rareness.')); ?> 
                                    <?php echo $form['score_rareness']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="float: left;">
                                <div style="float: left;font-weight: bold;">
                                    <?php echo $form['notes_rareness']->renderLabel(); ?>
                                </div>
                                <br/>
                                <div>
                                    <?php echo $form['notes_rareness']->render(array('notes_rareness' => 'Notes Rareness.')); ?> 
                                    <?php echo $form['notes_rareness']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td>
                            <span style="float: left;font-weight: bold;">Documentation:&nbsp;&nbsp;&nbsp; </span>
                            <div style="float: right;padding-right:30px;;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['score_documentation']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['score_documentation']->render(array('score_documentation' => 'Score Documentation.')); ?> 
                                    <?php echo $form['score_documentation']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="float: left;">
                                <div style="float: left;font-weight: bold;">
                                    <?php echo $form['notes_documentation']->renderLabel(); ?>
                                </div>
                                <br/>
                                <div>
                                    <?php echo $form['notes_documentation']->render(array('notes_documentation' => 'Notes Documentation.')); ?> 
                                    <?php echo $form['notes_documentation']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td>
                            <span style="float: left;font-weight: bold;">Technical Quality:&nbsp;&nbsp;&nbsp; </span>
                            <div style="float: left;padding-right:6px;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['unknown_technical_quality']->renderLabel(); ?>
                                </div>
                                <div style="float: left;margin-left: 30px;">
                                    <?php echo $form['unknown_technical_quality']->render(array('unknown_technical_quality' => 'Unknown Technical Quality.')); ?> 
                                    <?php echo $form['unknown_technical_quality']->renderError(); ?>
                                </div>
                            </div>
                            <div style="margin-left: 10px;float: right;padding-right:30px;;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['score_technical_quality']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['score_technical_quality']->render(array('score_technical_quality' => 'Score Technical Quality.')); ?> 
                                    <?php echo $form['score_technical_quality']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="float: left;">
                                <div style="float: left;font-weight: bold;">
                                    <?php echo $form['notes_technical_quality']->renderLabel(); ?>
                                </div>
                                <br/>
                                <div>
                                    <?php echo $form['notes_technical_quality']->render(array('notes_technical_quality' => 'Notes Technical Quality.')); ?> 
                                    <?php echo $form['notes_technical_quality']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <th>
                            <?php echo $form['collection_score']->renderLabel(); ?>
                        </th>
                        <td>
                            <?php echo $form['collection_score']->render(array('collection_score' => 'Collection Score.')); ?> 
                            <?php echo $form['collection_score']->renderError(); ?>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td>
                            <div style="float: left;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['generation_statement']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['generation_statement']->render(array('generation_statement' => 'Generation Statement.')); ?> 
                                    <?php echo $form['generation_statement']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="float: left;">
                                <div style="float: left;font-weight: bold;">
                                    <?php echo $form['generation_statement_notes']->renderLabel(); ?>
                                </div>
                                <br/>
                                <div>
                                    <?php echo $form['generation_statement_notes']->render(array('generation_statement_notes' => 'Generation Satement Notes.')); ?> 
                                    <?php echo $form['generation_statement_notes']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td>
                            <div style="float: left;">
                                <div style="font-weight: bold;">
                                    <?php echo $form['ip_statement']->renderLabel(); ?>
                                </div>
                                <div style="float: left;">
                                    <?php echo $form['ip_statement']->render(array('ip_statement' => 'IP Statement.')); ?> 
                                    <?php echo $form['ip_statement']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="float: left;">
                                <div style="float: left;font-weight: bold;">
                                    <?php echo $form['ip_statement_notes']->renderLabel(); ?>
                                </div>
                                <br/>
                                <div>
                                    <?php echo $form['ip_statement_notes']->render(array('ip_statement_notes' => 'IP Statement Notes.')); ?> 
                                    <?php echo $form['ip_statement_notes']->renderError(); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <th>
                            <?php echo $form['general_notes']->renderLabel(); ?>
                        </th>
                        <td >
                            <?php echo $form['general_notes']->render(array('general_notes' => 'General Notes.')); ?> 
                            <?php echo $form['general_notes']->renderError(); ?>
                        </td>
                    </tr>
                    <!-- -->
                    <tr>
                        <td colspan="2">
                            <hr/>
                        </td>
                    </tr>

                </tbody> 
            </table>
            <?php echo $form->renderHiddenFields() ?>
        </form>
    </div>
</div></div>
<script type="text/javascript">
    $(function(){
        $("#format_type_off_brand").parents(".row").show();
        $("#format_type_fungus").parents(".row").show();
    });
</script>