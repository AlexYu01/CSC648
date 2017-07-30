<?php $this->layout = "default_no_menu";?>
<div style="width: 800px; margin: 0 auto;">
    <h1 class="text-center">Registration Form </h1>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo "________________________________________________________________";
            echo "<br><br>";
        ?> 
        <span style="font-size: small">Password must be 8-20 characters long with at least one capital letter.</span>
    </fieldset>
    <div>
        <button type="Submit" class="btn btn-default">Submit</button>
    <?= $this->Form->end() ?>  
    </div>
</div>
