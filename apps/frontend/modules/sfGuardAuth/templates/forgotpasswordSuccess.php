<div>
    <div>
        <h3>Do not worry, we can help you get back in to your account safely!</h3>

    </div>
    <div>
        <h4>Fill out the form below to receive an e-mail with temporary password.</h4>
    </div>
    <form action="<?php echo url_for('sfGuardAuth/forgotpassword') ?>" method="post">
        <div class="row">
            <b>Enter Email:</b>
            <input type="input" name="email" id="email" value="<?php if(isset($email)) {echo $email;}?>"/>
            <?php
            if (isset($error))
                echo '<span  class="required" style="float:none;">'.$error.'</span>';
            ?>


        </div>
       
        <div>
            <input type="submit" value="Request Password"/>  or  <a href="/"> Cancel</a>
        </div>
    </form>
</div>