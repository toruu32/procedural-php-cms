<!-- HTML HEAD -->
<?php include_once('../templates/head.php'); ?>

<!-- NAVBAR -->
<?php include_once('../templates/navbar.php'); ?>

<?php include_once('../functions/functions.php'); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>
            
            <?php renderPosts(); ?>
            
            <!-- Pager -->
            <hr>
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>
        <?php include_once('../templates/sidebar.php'); ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php
    include_once('../templates/footer.php');
    ?>