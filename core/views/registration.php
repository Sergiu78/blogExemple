<?php

?>
<h1>Reg</h1>
<form method="POST">
    <input type="text" 
           name="login"
           value="<?= (isset($_POST['login']))? $_POST['login'] : '' ?>"
           class="<?= (isset($formErrors['login']))? 'error' : '' ?>"
           placeholder="login">
    
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <?php if(isset($formErrors['login'])) : ?>
    <?php var_dump($form['login']) ?>
    <?php endif ?>
    <button>Submit</button>
</form>

