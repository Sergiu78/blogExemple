<?php
function action_index(){
    
}

function action_category(){
    $categoryName = explode('/', strtolower($_GET['url']))[2];
    if(is_null($categoryName)){
        show404page();
    }
    $result = findCategoryById($categoryName);
    if($result->num_rows == 0){
        show404page();
    }
    $categoryData = mysqli_fetch_assoc($result)['id'];
    $allPosts = getAllPostInCategory($categoryData['id']);
    
    renderView('category',['posts'=> $allPosts,'categoryData'=> $categoryData]);

}

function action_createCategory(){
    if(!is_admin()){
        show404page;
        return false;
    }
    if($_SERVER('REQUEST_METHOD') == 'POST'){
        $catId = saveNewCategory(['title'=>$_POST['title'],'parent_id'=>$_POST['parent_id']]);
        header('location: /blog/category/$catId');
    }
    renderView('createCategory',[]);
}

function action_updateCategory(){
    $categoryName = getUrlSegment(2);
     if(is_null($categoryName) || !is_admin()){
        show404page;
    }
    $category = findModelById('category',$categoryName);
      if($categoryName->num_rows == 0){
        show404page();
    }
    if($_SERVER('REQUEST_METHOD') == 'POST'){
        $catId = updateCategory(['id'=> $categoryName,'title'=>$_POST['title'],'parent_id'=>$_POST['parent_id']]);
        header('location: /blog/category/$catId');
    }
    renderView('updateCategory',['category'=> mysqli_fetch_assoc($category)]);
}