<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('login.css')
?>
<html>
<body>
    <div style="width: 800px; margin: 0 auto; position: relative;">
    <div class="panel row">
        <h2 class ="text-center">Registration</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create($user) ?>
        <legend></legend>
        <fieldset>
        <div class="col-10">   
            <?php echo $this->Form->Control('email', array('class' => 'form-control')); ?>
            <br><br>
            <?php echo $this->Form->Control('username', array('class' => 'form-control')); ?>
            <br><br>
            <?php echo $this->Form->Control('password', array('class' => 'form-control')); ?>
            <span style="font-size: small"> * Password must be 8-20 characters long with at least one capital letter.</span>
            <br><br>
            <?php echo $this->Form->input('confirmPassword', array('type' => 'password', 'class' => 'form-control')); ?>
            <br><br><br><br>
        </div>
        </fieldset>
    <div style="position: relative; bottom: 20px; left: 680px;">
    <?= $this->Form->submit('Submit', array('class' => 'button')); ?>
    <?= $this->Form->end() ?>  
    </div>
    </div>
    </div>
</body>
</html>