<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
?>
<html>
<body>
<div class="container">
<div style="width: 800px; margin: 0 auto; position: relative;">
    <div class="panel row">
        <h2 class ="text-center">Login</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create(); ?>
        <legend><?= __('Please enter your username and password') ?></legend>
            Username: <br> <input type="text" name="username" style="border-width: 1px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <br><br>
            Password: <br> <input type="password" name="password" style="border-width: 1px; border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <br><br><br><br>
            <div style="position: relative; bottom: 20px; left: 130px;">
            <?= $this->Form->submit('Login', array('class' => 'button')); ?>
            <?= $this->Form->end(); ?>
            </div>
    </div>
</div>
</div>
</body>
</html>