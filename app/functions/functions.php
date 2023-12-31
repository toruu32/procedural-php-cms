<!-- SELECT -->
<?php
require_once('../database/database.php');

// RENDER CATEGORIES
function printCategories()
{
    global $connection;

    $query = "SELECT CATEGORY_NAME FROM CATEGORIES";

    if ($stmt = mysqli_prepare($connection, $query)) {

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $CATEGORY_NAME = $row['CATEGORY_NAME'];
            echo  "<li><a href='#'>{$CATEGORY_NAME}</a></li>";
        }

        mysqli_stmt_close($stmt);
    };
};

// RENDER POSTS
function renderPosts()
{
    global $connection;

    $postTemplate = null;

    $query = "SELECT * FROM POSTS";

    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
                $postTemplate .= getPostsTemplate($row);
        }
    } else {

        die('Statement preparation failed: ' . mysqli_error($connection));
    }

    // CHECK IF THERE ARE ANY POSTS
    echo !empty($postTemplate) ? $postTemplate : 'No posts yet.';

    mysqli_stmt_close($stmt);
}

// GET POSTS TEMPLATE
function getPostsTemplate($row)
{
    $postId = $row['POST_ID'];
    $postCategoryName = $row['POST_CATEGORY_NAME'];
    $postTitle = $row['POST_TITLE'];
    $postCreator = $row['POST_CREATOR'];
    $postDate = $row['POST_DATE'];
    $postImage = $row['POST_IMAGE'];
    $postContent = htmlspecialchars(strip_tags($row['POST_CONTENT']));
    $postViews = $row['POST_VIEWS'];
    $postTags = $row['POST_TAGS'];
    $postComments = $row['POST_COMMENTS'];

    return "
        <h2><a href='#'>$postTitle</a></h2>
        <p class='lead'>by <a href='index.php'>$postCreator</a></p>
        <p><span class='glyphicon glyphicon-time'></span> Posted on $postDate</p>
        <hr>
        <img class='img-responsive' src='http://placehold.it/900x300' alt=''>
        <hr>
        <p>$postContent</p>
        <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";
}
?>