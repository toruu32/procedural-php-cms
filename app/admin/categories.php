<?php include_once('./templates/head.php'); ?>
<?php include_once('../functions/functions.php'); ?>
<div id="wrapper">

    <?php include_once('./templates/navigation.php'); ?>

    <div id="page-wrapper bg-dark">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="" style="color: #777;">
                        Add Category
                    </h1>
                    <form action="" role="form" method="post">
                        <div class="form-group">
                            <label for="addCategory" style="color: #777;">Category Name</label>
                            <input type="text" class="form-control" id="addCategory" name="categoryName" placeholder="Enter category name">
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                        <?php manageCategoryList(); ?>
                    </form>
                </div>  
                <div class="col-lg-6">
                    <h1 class="" style="color: #777;">
                        Categories List
                    </h1>
                    <table class="table">
                        <thead class="text-primary">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-warning">
                            <?php categoriesList(); ?>
                        </tbody>
                    </table>
                </div>  
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include_once('../templates/footer.php') ?>