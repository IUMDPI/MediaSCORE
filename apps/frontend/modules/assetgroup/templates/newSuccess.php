<h1>Create an Asset Group</h1>
<?php $sessionLocation=sfContext::getInstance()->getUser()->getAttribute('storage_locations_list'); 

$sessionLocation= json_encode($sessionLocation);
 




?>
<?php include_partial('form', array('form' => $form,'type'=>1,'collectionObj'=>$collection)) ?>
<script type="text/javascript">
function getSessionStorage(){
    setSessionLocation(<?php echo $sessionLocation; ?>);
    
}
</script> 