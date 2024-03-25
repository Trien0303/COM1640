<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <form method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple>
        <input type="submit" name="upload" value="Upload Files">
    </form> -->

    <!-- <a href="download.php">Download</a> -->

    <form action="download.php" method="post" enctype="multipart/form-data">
        <h3>Select one or more files</h3>
        <?php
        $files = glob("files/*.doc");
        foreach ($files as $doc_file) {
            ?>
            <div>
                <input type="checkbox" name="files[]" value="<?php echo $doc_file ?>">
                <label for="">
                    <?php echo basename($doc_file) ?>
                </label>
            </div>
            <?php
        }
        ?>
        <button type="submit" name="download">Download</button>
        <p class="error">
            <?php echo @$error; ?>
        </p>
    </form>

</body>

</html>