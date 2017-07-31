<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
?>
<html>
<body>
<div class="container">
<div style="width: 800px; margin: 0 auto; position: relative;">
        <h2 class ="text-center">Registration</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create($user) ?>
        <legend></legend>
    <fieldset>
        E-mail: <br> <input type="email" name="email" style="border-width: 1px; border-radius: 5px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); ">
        <br><br>
        Username: <br> <input type="text" name="username" style="border-width: 1px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <br><br>
        Password: <br> <input type="password" name="password" style="border-width: 1px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <br><br>
        
        Confirm Password: <br> <input type="password" name="confirm_password" style="border-width: 1px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <br><br>
        <!--<span style="font-size: small">Password must be 8-20 characters long with at least one capital letter.</span>
        --><br><br><br>
    </fieldset>
    <div style="position: relative; bottom: 20px; left: 130px;">
        <?= $this->Form->submit('Submit', array('class' => 'button')); ?>
    <?= $this->Form->end() ?>  
    </div>
</div>
</div>
</body>
</html>