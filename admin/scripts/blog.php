<?php

function createBlog($blog){

    $pdo = Database::getInstance()->getConnection();

    $check_exist_query = 'SELECT COUNT(blog_title) FROM tbl_blog WHERE blog_title = :title'; // sanitation
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute( // sanitation pt2
        array(
            ':title'=> $blog['title']
        )
    );

    if($user_set->fetchColumn() == 0){
            try{
            $pdo = Database::getInstance()->getConnection();


                //image processing
                if($blog['image'] != ''){
                    $image = $blog['image'];
                    $upload_file = pathinfo($image['name']);
                    $accepted_types = array('jpg', 'png', 'jpeg', 'JPG');
                    if(!in_array($upload_file['extension'], $accepted_types)){
                        //throw new Exception('Wrong file type...');
                        $generated_filename = '';

                    }else{
                        $image_path = '../images/blog-images/';
                        
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
                

                // processing yt video url
                $url = $blog['videoLink'];

                // if(!empty($url)){
                //     parse_str( parse_url( $url, PHP_URL_QUERY ), $ytVideoLink );
                //     // $ytVideoLink['v'];
                // }
                

                $insert_blog_query = "INSERT INTO tbl_blog (blog_title, blog_author, blog_subheader, blog_image, blog_category, blog_published, blog_end_link, blog_yt_video, blog_body, blog_date, blog_tags) VALUES (:title, :author, :subheader, :image, :category, :published, :end_link, :yt_video, :body, :date, :tags)";
                $insert_blog_set = $pdo->prepare($insert_blog_query);
                $insert_blog_result = $insert_blog_set->execute(
                    array(
                        ':image'=> $generated_filename,
                        ':title'=> $blog['title'],
                        ':author'=> $blog['author'],
                        ':subheader'=> $blog['subheader'],
                        ':category'=> $blog['category'],
                        ':published'=> $blog['published'],
                        ':end_link'=> $blog['buttonLink'],
                        ':yt_video'=> $url,
                        ':body'=> $blog['body'],
                        ':date'=> $blog['date'],
                        ':tags'=> $blog['tags'],

                    )
                );


                
                    





                    //updating category lists
                $last_uploaded_id = $pdo->lastInsertId();
                if($insert_blog_result && !empty($last_uploaded_id)){
                    $update_category_query = "INSERT INTO tbl_blog_category(blog_id, category_id) VALUES (:blogid, :catid)";
                    $update_category_set = $pdo->prepare($update_category_query);

                    $update_blog_result = $update_category_set->execute(
                        array(
                            ':blogid'=>$last_uploaded_id,
                            ':catid'=>$blog['category']
                        )
                    );


                }


                if($insert_blog_result){
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


function editBlog($blog, $id){

    $pdo = Database::getInstance()->getConnection();

    $check_exist_query = 'SELECT COUNT(blog_title) FROM tbl_blog WHERE blog_title = :title AND blog_id != :id'; // sanitation
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute( // sanitation pt2
        array(
            ':title'=> $blog['title'],
            ':id'=>$id
        )
    );

    if($user_set->fetchColumn() == 0){
        try{
            $pdo = Database::getInstance()->getConnection();

            // processing yt video url
            $url = $blog['videoLink'];


                //image processing
                if($blog['image'] != ''){
                    $image = $blog['image'];
                    $upload_file = pathinfo($image['name']);
                    $accepted_types = array('jpg', 'png', 'jpeg', 'JPG');
                    if(!in_array($upload_file['extension'], $accepted_types)){
                        //throw new Exception('Wrong file type...');


                        // if file upload fails
                        $insert_blog_query = "UPDATE tbl_blog SET blog_title = :title, blog_author = :author,  blog_subheader = :subheader, blog_category = :category, blog_published = :published, blog_end_link = :end_link, blog_yt_video = :yt_video, blog_body = :body, blog_date = :date, blog_tags = :tags WHERE blog_id = :id";
                        $insert_blog_set = $pdo->prepare($insert_blog_query);
                        $insert_blog_result = $insert_blog_set->execute(
                            array(
                                ':title'=> $blog['title'],
                                ':author'=> $blog['author'],
                                ':subheader'=> $blog['subheader'],
                                ':category'=> $blog['category'],
                                ':published'=> $blog['published'],
                                ':end_link'=> $blog['buttonLink'],
                                ':yt_video'=> $url,
                                ':body'=> $blog['body'],
                                ':date'=> $blog['date'],
                                ':tags'=> $blog['tags'],
                                ':id'=> $id

                            )
                        );


                        if($insert_blog_result){
                            redirect_to('./dashboard');
                        }else{
                            return 'An error occured';
                        }
                        

                    }else{

                        // if file upload success
                        $image_path = '../images/blog-images/';
                        
                        //changing file name
                        $generated_name = md5($upload_file['filename'].time());
                        $generated_filename = $generated_name.'.'.$upload_file['extension'];
                        $targetPath = $image_path.$generated_filename;

                        
                        if(!move_uploaded_file($image['tmp_name'], $targetPath)){
                            throw new Exception('failed to move uploaded file, check permissions');
                        }


                        $insert_blog_query = "UPDATE tbl_blog SET blog_title = :title, blog_author = :author, blog_subheader = :subheader, blog_image = :image, blog_category = :category, blog_published = :published, blog_end_link = :end_link, blog_yt_video = :yt_video, blog_body = :body, blog_date = :date, blog_tags = :tags WHERE blog_id = :id";
                        $insert_blog_set = $pdo->prepare($insert_blog_query);
                        $insert_blog_result = $insert_blog_set->execute(
                            array(
                                ':image'=> $generated_filename,
                                ':title'=> $blog['title'],
                                ':author'=> $blog['author'],
                                ':subheader'=> $blog['subheader'],
                                ':category'=> $blog['category'],
                                ':published'=> $blog['published'],
                                ':end_link'=> $blog['buttonLink'],
                                ':yt_video'=> $url,
                                ':body'=> $blog['body'],
                                ':date'=> $blog['date'],
                                ':tags'=> $blog['tags'],
                                ':id'=> $id

                            )
                        );
                    }
                    
                }else{

                    // if NO file upload 
                    $insert_blog_query = "UPDATE tbl_blog SET blog_title = :title, blog_author = :author, blog_subheader = :subheader, blog_category = :category, blog_published = :published, blog_end_link = :end_link, blog_yt_video = :yt_video, blog_body = :body, blog_date = :date, blog_tags = :tags WHERE blog_id = :id";
                    $insert_blog_set = $pdo->prepare($insert_blog_query);
                    $insert_blog_result = $insert_blog_set->execute(
                        array(
                            ':title'=> $blog['title'],
                            ':author'=> $blog['author'],
                            ':subheader'=> $blog['subheader'],
                            ':category'=> $blog['category'],
                            ':published'=> $blog['published'],
                            ':end_link'=> $blog['buttonLink'],
                            ':yt_video'=> $url,
                            ':body'=> $blog['body'],
                            ':date'=> $blog['date'],
                            ':tags'=> $blog['tags'],
                            ':id'=> $id

                        )
                    );
                }
                

                    //updating category lists
                
                if($insert_blog_result && !empty($last_uploaded_id)){
                    $update_category_query = "UPDATE tbl_blog_category SET category_id = :catid WHERE blog_id = :id";
                    $update_category_set = $pdo->prepare($update_category_query);

                    $update_blog_result = $update_category_set->execute(
                        array(
                            ':id'=>$id,
                            ':catid'=>$blog['category']
                        )
                    );

                
                }
            
            if($insert_blog_result){
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




function deleteBlog($id){

    $pdo = Database::getInstance()->getConnection();

    try{
            $delete_blog_query = 'DELETE FROM tbl_blog WHERE blog_id = :id';
            $delete_blog_set = $pdo->prepare($delete_blog_query);
            $delete_blog_result = $delete_blog_set->execute(
                array(
                    ':id'=>$id
                )
            );


            if($delete_blog_result){
                redirect_to('./dashboard');
            }else{
                return 'An error occured';
            }

    }catch(Exeption $e){
        $error =$e->getMessage();
        return $error;
    }
}