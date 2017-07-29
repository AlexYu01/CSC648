<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
            <h1 class="text-center">Registration Form </h1>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <div class="form-group">
        <?php
            //echo $this->Form->control('firstname');
            //echo $this->Form->control('Last Name');
            echo "________________________________________________________________";
            echo "<br><br>";
            echo $this->Form->control('username',["class"=> "form-control"]);
        ?> 
        </div>
            <?= $this->Form->control('password');?>
            <span style="font-size: small">Password must be 8-20 characters long with at least one capital letter.</span>
            <?= $this->Form->control('email');?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
</div>