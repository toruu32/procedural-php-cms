<!-- SELECT -->

<?php
// Including the database connection file
require_once('../database/database.php');

// Function to print categories in a list
function printCategories()
{
    global $connection;

    // Query to select category names from the CATEGORIES table
    $query = "SELECT CATEGORY_NAME FROM CATEGORIES";

    // Prepare and execute the query
    if ($stmt = mysqli_prepare($connection, $query)) {

        mysqli_stmt_execute($stmt);

        // Get the result set
        $result = mysqli_stmt_get_result($stmt);

        // Loop through the result set and print category names in a list
        while ($row = mysqli_fetch_assoc($result)) {
            $CATEGORY_NAME = $row['CATEGORY_NAME'];
            echo  "<li><a href='#'>{$CATEGORY_NAME}</a></li>";
        }

        mysqli_stmt_close($stmt);
    }
}

// Function to render posts
function renderPosts()
{
    global $connection;

    $postTemplate = null;

    // Query to select all columns from the POSTS table
    $query = "SELECT * FROM POSTS";

    // Prepare the query
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {

        mysqli_stmt_execute($stmt);

        // Get the result set
        $result = mysqli_stmt_get_result($stmt);

        // Loop through the result set and generate a template for each post
        while ($row = mysqli_fetch_assoc($result)) {
            $postTemplate .= getPostsTemplate($row);
        }
    } else {

        // Handle an error if statement preparation fails
        die('Statement preparation failed: ' . mysqli_error($connection));
    }

    // Check if there are any posts and echo the post template
    echo !empty($postTemplate) ? $postTemplate : 'No posts yet.';

    mysqli_stmt_close($stmt);
}

// Function to generate a template for posts
function getPostsTemplate($row)
{
    // Extracting values from the row
    $postId = $row['POST_ID'];
    $postCategoryName = $row['POST_CATEGORY_NAME'];
    $postTitle = $row['POST_TITLE'];
    $postCreator = $row['POST_CREATOR'];
    $postDate = $row['POST_DATE'];
    $postImage = $row['POST_IMAGE'];
    $postViews = $row['POST_VIEWS'];
    $postTags = $row['POST_TAGS'];
    $postComments = $row['POST_COMMENTS'];

    // Building an image path based on whether there is a post image or not
    $imagePath = $postImage ? "../../assets/images/$postImage" : "http://placehold.it/900x300";

    // Cleaning and formatting post content
    $postContent = htmlspecialchars(strip_tags($row['POST_CONTENT']));

    // Constructing and returning a post template
    return "
        <h2><a href='#'>$postTitle</a></h2>
        <p class='lead'>by <a href='index.php'>$postCreator</a></p>
        <p><span class='glyphicon glyphicon-time'></span> Posted on $postDate</p>
        <hr>
        <img class='img-responsive' style='min-width: 750px; max-width: 750px; min-height: 250px; max-height: 250px;'  src='$imagePath' alt='post image'>
        <hr>
        <p>$postContent</p>
        <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";
}

// Function to print categories list in categories.php
function categoriesList()
{
    global $connection;

    // Query to select category IDs and names from the CATEGORIES table
    $query = "SELECT CATEGORY_ID, CATEGORY_NAME FROM CATEGORIES";

    if ($stmt = mysqli_prepare($connection, $query)) {

        mysqli_stmt_execute($stmt);

        // Get the result set
        $result = mysqli_stmt_get_result($stmt);

        // Loop through the result set and print category details in a table
        while ($row = mysqli_fetch_assoc($result)) {
            $categoryId = intval($row["CATEGORY_ID"]);
            $categoryName = htmlspecialchars($row["CATEGORY_NAME"]);
            echo '<tr>';
            echo "<td>$categoryId</td>";
            echo "<td>$categoryName</td>";
            echo "<td><a href='categories.php?delete=$categoryId'>Delete</a></td>";
            echo '<tr>';
        }
    } else {
        // Handle an error if statement preparation fails
        die('Statement preparation failed: ' . mysqli_error($connection));
    }

    // Free the result set and close the statement
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
}

// Function to manage category list (add/delete categories)
function manageCategoryList()
{
    global $connection;

    // Adding a new category
    if (isset($_POST['submit'])) {

        $categoryName = mysqli_escape_string($connection, $_POST['categoryName']);

        if (!empty($categoryName)) {

            $query = "INSERT INTO CATEGORIES (CATEGORY_NAME) VALUES ('$categoryName')";

            if ($stmt = mysqli_prepare($connection, $query)) {

                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);
            } else {
                // Handle an error if statement preparation fails
                die('Error' . mysqli_error($connection));
            }
        } else {
            echo 'Empty input';
        }
    }

    // Deleting a category
    if (isset($_GET['delete'])) {
        $categoryId =  $_GET['delete'];
        $query = "DELETE FROM CATEGORIES WHERE CATEGORY_ID = $categoryId";
        if ($stmt = mysqli_prepare($connection, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}
?>