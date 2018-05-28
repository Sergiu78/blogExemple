<?php
 $allCategories = getAll('category');
?>
<form action="/blog/createCategory" method="post">
    <input type="text" name="title">
    <select name="parent_id">
        <option selected value='0'>No parent</option>
        <?php
          if(!empty($allcategories)):
              foreach($allCategories as $cat):
        ?>
        <option value="<?= $cat['id']?>"><?= $cat['title']?></option>
        <?php
          endforeach;
          endif;
        ?>
    </select>
    <button>Create</button>
</form>
