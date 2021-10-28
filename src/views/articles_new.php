<?php

namespace kwiqKB;

// $cats = (new Category())->listCategories();
$cats = [
    ["id" => 1, "category" => "Cat One"],
    ["id" => 2, "category" => "Cat Two"],
    ["id" => 3, "category" => "Cat Three"]
];

$msg = new \Plasticbrain\FlashMessages\FlashMessages();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
</head>

<body>
    <form class="" method="POST" id="addItem">
        <div class="modal-body">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mr-auto">
                        <div class="col-md-12 mb-5"><?php echo $msg->display(); ?></div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="entry form-control" name="title" id="title" aria-describedby="title" value="<?php echo $_POST['title'] ?? ''; ?>" placeholder="Enter post title here" required>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4 col-12">
                                <label for="category">Category</label>
                                <select type="text" class="entry form-control" name="category" id="category" aria-describedby="category" required>
                                    <option value="" selected>Please select category</option>
                                    <?php foreach ($cats as $cat) : ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="status">Type</label>
                                <select type="text" class="entry form-control" name="type" id="type" aria-describedby="status" required>
                                    <option value="" selected>Please select Type</option>
                                    <option>General</option>
                                    <option>HRGeniee</option>
                                    <option>ProjectGeniee</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="status">Is Published?</label>
                                <select type="text" class="entry form-control" name="status" id="status" aria-describedby="status" required>
                                    <option value="" selected>Please select category</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contents">Contents</label>
                            <textarea type="text" rows=10 class="form-control" name="contents" id="summernote" aria-describedby="contents" placeholder="Type pot contents here here"><?php echo $_POST['contents'] ?? ''; ?></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>