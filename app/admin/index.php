<?php include_once('./templates/head.php'); ?>

<div id="wrapper">

    <?php include_once('./templates/navigation.php'); ?>

    <div id="page-wrapper bg-dark">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="color: #777;">
                        Welcome, User!
                    </h1>
                    <?php include_once('./pages/categories.php'); ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include_once('./templates/footer.php') ?>