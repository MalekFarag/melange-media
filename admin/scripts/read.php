<?php

function getAll($tbl)
{
    $pdo = Database::getInstance()->getConnection();
    $queryAll = 'SELECT * FROM ' . $tbl;
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}

function getAllBlogs($tbl)
{
    $pdo = Database::getInstance()->getConnection();
    $queryAll = 'SELECT * FROM ' . $tbl.' ORDER BY blog_date DESC';
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}

function getAllAvailable($tbl, $num)
{
    $pdo = Database::getInstance()->getConnection();
    $queryAll = 'SELECT * FROM '.$tbl.' WHERE blog_published = 1 ORDER BY blog_date DESC LIMIT '.$num;
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}

function getAllAvailableByCat($tbl, $cat, $num)
{
    $pdo = Database::getInstance()->getConnection();
    $queryAll = 'SELECT * FROM '.$tbl.' WHERE blog_published = 1 AND blog_category = '.$cat.' ORDER BY blog_date DESC LIMIT '.$num;
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}




function searchByTag($tag, $num){
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_blog WHERE blog_published = 1 AND blog_tags LIKE '%$tag%' LIMIT $num";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}

function searchByTerm($term){
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_blog WHERE blog_title LIKE '%$term%' OR blog_body LIKE '%$term%' ORDER BY blog_date DESC LIMIT 99";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}


function searchPubByTerm($term){
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_blog WHERE blog_published = 1 AND blog_title LIKE '%$term%' OR blog_body LIKE '%$term%' ORDER BY blog_date DESC LIMIT 99";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}

function getRecommended($title, $id){
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_blog WHERE blog_id != '$id' AND blog_published = 1 ORDER BY RAND() LIMIT 4";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}
function displayRandTags(){
    $pdo = Database::getInstance()->getConnection();
    $queryAll = "SELECT * FROM tbl_blog WHERE blog_published = 1 ORDER BY RAND() LIMIT 3";
    $results = $pdo->query($queryAll);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}




function getSingleBlog($tbl, $col, $id)
{

    $pdo = Database::getInstance()->getConnection();
    $query = "SELECT * FROM $tbl WHERE $col = $id";
    $results = $pdo->query($query);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }

}

function getSingleBlogByTitle($tbl, $col, $title)
{

    $pdo = Database::getInstance()->getConnection();
    // $query = 'SELECT * FROM '.$tbl.' WHERE '$col' = '.$id;
    $query = "SELECT * FROM $tbl WHERE $col = '$title' LIMIT 1";
    $results = $pdo->query($query);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }

}




function getBlogsByCategory($args)
{
    $pdo = Database::getInstance()->getConnection();

    $filterQuery = 'SELECT * FROM ' . $args['tbl'] . ' AS t, ' . $args['tbl2'] . ' AS t2, ' . $args['tbl3'] . ' AS t3';
    $filterQuery .= ' WHERE t.' . $args['col'] . ' = t3.' . $args['col'];
    $filterQuery .= ' AND t2.' . $args['col2'] . ' = t3.' . $args['col2'];
    $filterQuery .= ' AND t2.' . $args['col3'] . ' = "' . $args['filter'] . '"';

    $results = $pdo->query($filterQuery);



    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}


function getCategory($num){
    $pdo = Database::getInstance()->getConnection();
    

    $cats = ['Art', 'Entertainement', 'Food', 'Lifestyle', 'Local'];

    echo $cats[$num - 2];


}
