<?php

function getAllResouces( $num){
    
        $pdo = Database::getInstance()->getConnection();
        $queryAll = "SELECT * FROM tbl_resources WHERE res_published = 1 OR 2 ORDER BY res_date DESC LIMIT $num";
        $results = $pdo->query($queryAll);
    
        if ($results) {
            return $results;
        } else {
            return 'There was a problem accessing this info';
        }
    
}

function getAllPubResouces( $num){
    
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_resources WHERE res_published = 1 ORDER BY res_date DESC LIMIT $num";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }

}

function getSingleRes($id){
    
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_resources WHERE res_id = $id";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }

}

function getLatestRes(){
    
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_resources ORDER BY res_date DESC LIMIT 1";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }

}

function getRandRes(){
    
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_resources ORDER BY RAND() LIMIT 1";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }

}

function createRes($resource){

$pdo = Database::getInstance()->getConnection();

$check_exist_query = 'SELECT COUNT(res_title) FROM tbl_resources WHERE res_title = :title'; // sanitation
$user_set = $pdo->prepare($check_exist_query);
$user_set->execute( // sanitation pt2
    array(
        ':title'=> $resource['title']
    )
);

if($user_set->fetchColumn() == 0){
        try{
        $pdo = Database::getInstance()->getConnection();


            //image processing
            if($resource['image'] != ''){
                $image = $resource['image'];
                $upload_file = pathinfo($image['name']);
                $accepted_types = array('jpg', 'png', 'jpeg', 'JPG');
                if(!in_array($upload_file['extension'], $accepted_types)){
                    //throw new Exception('Wrong file type...');
                    $generated_filename = '';

                }else{
                    $image_path = '../images/res-images/';
                    
                    //changing file name
                    $generated_name = md5($upload_file['filename'].time());
                    $generated_filename = $generated_name.'.'.$upload_file['extension'];
                    $targetPath = $image_path.$generated_filename;

                    
                    if(!move_uploaded_file($image['tmp_name'], $targetPath)){
                        throw new Exception('failed to move uploaded file, check permissions');
                    }


                }
                
            }else{
                $generated_filename = '';
            }
            
            

            $insert_res_query = "INSERT INTO tbl_resources (res_title, res_subheader, res_author, res_image, res_published, res_link, res_date, res_tags) VALUES (:title, :subheader, :author, :image, :published, :link, :date, :tags)";
            $insert_res_set = $pdo->prepare($insert_res_query);
            $insert_res_result = $insert_res_set->execute(
                array(
                    ':image'=> $generated_filename,
                    ':title'=> $resource['title'],
                    ':author'=> $resource['author'],
                    ':subheader'=> $resource['subheader'],
                    ':published'=> $resource['published'],
                    ':link'=> $resource['link'],
                    ':date'=> $resource['date'],
                    ':tags'=> $resource['tags'],

                )
            );



            if($insert_res_result){
                redirect_to('./dashboard');
            }else{
                return 'An error occured';
            }
    }catch(Exception $e) {
        $error = $e->getMessage();
        return $error;
    }
}else{
    return 'This is a duplicate title. Please change the title of the post.';
}



}


function editRes($resource, $id){

$pdo = Database::getInstance()->getConnection();

$check_exist_query = 'SELECT COUNT(res_title) FROM tbl_resources WHERE res_title = :title AND res_id != :id'; // sanitation
$user_set = $pdo->prepare($check_exist_query);
$user_set->execute( // sanitation pt2
    array(
        ':title'=> $resource['title'],
        ':id'=>$id
    )
);

if($user_set->fetchColumn() == 0){
    try{
        $pdo = Database::getInstance()->getConnection();

        // processing yt video url
        $url = $resource['videoLink'];


            //image processing
            if($resource['image'] != ''){
                $image = $resource['image'];
                $upload_file = pathinfo($image['name']);
                $accepted_types = array('jpg', 'png', 'jpeg', 'JPG');
                if(!in_array($upload_file['extension'], $accepted_types)){
                    //throw new Exception('Wrong file type...');


                    // if file upload fails
                    $insert_res_query = "UPDATE tbl_resources SET res_title = :title, res_subheader = :subheader, res_author = :author, res_published = :published, res_link = :link, res_date = :date, res_tags = :tags WHERE res_id = :id";
                    $insert_res_set = $pdo->prepare($insert_res_query);
                    $insert_res_result = $insert_res_set->execute(
                        array(
                            ':title'=> $resource['title'],
                            ':author'=> $resource['author'],
                            ':subheader'=> $resource['subheader'],
                            ':published'=> $resource['published'],
                            ':link'=> $resource['link'],
                            ':date'=> $resource['date'],
                            ':tags'=> $resource['tags'],
                            ':id'=> $id

                        )
                    );


                    if($insert_res_result){
                        redirect_to('./dashboard');
                    }else{
                        return 'An error occured';
                    }
                    

                }else{

                    // if file upload success
                    $image_path = '../images/res-images/';
                    
                    //changing file name
                    $generated_name = md5($upload_file['filename'].time());
                    $generated_filename = $generated_name.'.'.$upload_file['extension'];
                    $targetPath = $image_path.$generated_filename;

                    
                    if(!move_uploaded_file($image['tmp_name'], $targetPath)){
                        throw new Exception('failed to move uploaded file, check permissions');
                    }


                    $insert_res_query = "UPDATE tbl_resources SET res_title = :title, res_subheader = :subheader, res_author = :author, res_image = :image, res_published = :published, res_link = :link, res_date = :date, res_tags = :tags WHERE res_id = :id";
                    $insert_res_set = $pdo->prepare($insert_res_query);
                    $insert_res_result = $insert_res_set->execute(
                        array(
                            ':image'=> $generated_filename,
                            ':title'=> $resource['title'],
                            ':author'=> $resource['author'],
                            ':subheader'=> $resource['subheader'],
                            ':published'=> $resource['published'],
                            ':link'=> $resource['link'],
                            ':date'=> $resource['date'],
                            ':tags'=> $resource['tags'],
                            ':id'=> $id

                        )
                    );
                }
                
            }else{

                // if NO file upload 
                $insert_res_query = "UPDATE tbl_res SET res_title = :title, res_subheader = :subheader, res_author = :author = :category, res_published = :published, res_link = :link, res_date = :date, res_tags = :tags WHERE res_id = :id";
                $insert_res_set = $pdo->prepare($insert_res_query);
                $insert_res_result = $insert_res_set->execute(
                    array(
                            ':title'=> $resource['title'],
                            ':author'=> $resource['author'],
                            ':subheader'=> $resource['subheader'],
                            ':published'=> $resource['published'],
                            ':link'=> $resource['link'],
                            ':date'=> $resource['date'],
                            ':tags'=> $resource['tags'],
                            ':id'=> $id

                    )
                );
            }
            
        
        if($insert_res_result){
            redirect_to('./dashboard');
        }else{
            return 'An error occured';
        }
        
            
    }catch(Exception $e) {
        $error = $e->getMessage();
        return $error;
    }

}else{
    return 'This is a duplicate title. Please change the title of the post.';
}



}




function deleteRes($id){

$pdo = Database::getInstance()->getConnection();

try{
        $delete_res_query = 'DELETE FROM tbl_resources WHERE res_id = :id';
        $delete_res_set = $pdo->prepare($delete_res_query);
        $delete_res_result = $delete_res_set->execute(
            array(
                ':id'=>$id
            )
        );


        if($delete_res_result){
            redirect_to('./dashboard');
        }else{
            return 'An error occured';
        }

}catch(Exeption $e){
    $error =$e->getMessage();
    return $error;
}
}