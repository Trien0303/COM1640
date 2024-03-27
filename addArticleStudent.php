<head>
    <meta name="viewport" content="width=device-width">
    <title>Submit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-YHM+0q4qoym3zT4iuZUzRSVfLRtTjxiN0PF/Kea0I3ftgXg5H2iM3uT4vKl3gjFj" crossorigin="anonymous">

</head>
<style>
    .btn-primary.btn-black {
        background-color: #000;
        border-color: #000;
    }

    .btn-primary.btn-black:hover {
        background-color: #333;
        border-color: #333;
    }

    .btn-primary.btn-black:focus,
    .btn-primary.btn-black.focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.5);
    }

    .btn-primary.btn-black.disabled,
    .btn-primary.btn-black:disabled {
        background-color: #000;
        border-color: #000;
    }

    .btn-primary.btn-black:not(:disabled):not(.disabled):active,
    .btn-primary.btn-black:not(:disabled):not(.disabled).active,
    .show>.btn-primary.btn-black.dropdown-toggle {
        background-color: #333;
        border-color: #333;
    }

    .btn-primary.btn-black:not(:disabled):not(.disabled):active:focus,
    .btn-primary.btn-black:not(:disabled):not(.disabled).active:focus,
    .show>.btn-primary.btn-black.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.5);
    }

    .glyphicon-plus:before {
        content: "\002b";
        color: #fff;
        /* Màu của biểu tượng cộng */
    }


    .btn-black {
        background-color: #000;
        border-color: #000;
        color: #fff;
    }

    .btn-black:hover {
        background-color: #333;
        border-color: #333;
    }

    .btn-black:focus,
    .btn-black.focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.5);
    }

    .rounded-image {
        border-radius: 50%;
        /* Tạo hình tròn */
        overflow: hidden;
        /* Đảm bảo hình ảnh không vượt ra khỏi khung hình tròn */
        width: 200px;
        /* Điều chỉnh kích thước của khung hình tròn */
        height: 200px;
        border: 2px solid #ccc;
        /* Thêm viền cho hình tròn */
    }

    .rounded-image img {
        width: 100%;
        /* Đảm bảo hình ảnh đầy đủ kích thước trong khung hình tròn */
        height: auto;
    }
</style>


<?php
$idMagazine = $_GET['id'];
?>
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <form action="upload.php" method="post" enctype="multipart/form-data" class="p-3 shadow-sm rounded bg-white">
                        <h2 class="card-title fw-bold mb-4 text-center" style="font-size: 2rem; color: #333;">Submit Article Form</h2>

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image:</label>
                                <input type="file" class="form-control" id="thumb" name="image" accept=".jpg, .png" required>
                                <div class="col-md-4">
                                    <div class="rounded-image">
                                        <img id="preview" src="" alt="Image Preview" style="display:none; max-width: 200px; max-height:200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="article_title" class="form-label">Title:</label>
                                <input type="text" class="form-control" id="article_title" name="article_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="article_content" class="form-label">Content:</label>
                                <input type="text" class="form-control" id="article_content" name="article_content" required></textarea>
                                <div class="mb-3">
                                    <label for="files" class="form-label">Upload Files:</label><br>
                                    <div class="text-center">
                                        <br>
                                        <div class="d-block mb-3">
                                            <label for="files" class="btn btn-primary btn-black">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </label>
                                            <input type="file" class="form-control" id="files" name="files[]" accept=".docx, .doc" multiple style="display: none;">
                                        </div>
                                        <div class="d-block">
                                            <p id="selectedFiles"></p>
                                        </div>

                                    </div>
                                    <input type="hidden" id="magazineId" name="magazineId" value="<?= $idMagazine ?>">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="confirmation_checkbox" name="confirmation_checkbox" required>
                                        <label class="form-check-label" for="confirmation_checkbox">I agree to Terms and Conditions</label>
                                    </div>
                                    <div class="text-center">
                                        <button id="Submit" name="Submit" type="submit" class="btn btn-black btn-lg">Submit</button>
                                    </div>
                                    <span id="submit-error"></span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('files').addEventListener('change', function() {
        const input = document.getElementById('files');
        const files = input.files;
        const selectedFilesDiv = document.getElementById('selectedFiles');

        for (let i = 0; i < files.length; i++) {
            const fileDiv = document.createElement('div');
            fileDiv.classList.add('d-flex', 'align-items-center');

            const fileName = document.createElement('span');
            fileName.innerText = files[i].name;
            fileName.classList.add('me-2');
            fileDiv.appendChild(fileName);

            const removeButton = document.createElement('button');
            removeButton.innerHTML = '&times;';
            removeButton.classList.add('btn', 'btn-sm', 'btn-danger');
            removeButton.type = 'button';
            removeButton.addEventListener('click', function() {
                fileDiv.remove();
            });
            fileDiv.appendChild(removeButton);

            selectedFilesDiv.appendChild(fileDiv);
        }
    });
</script>