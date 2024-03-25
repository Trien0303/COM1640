<head>
    <meta name="viewport" content="width=device-width">
    <title>Submit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-YHM+0q4qoym3zT4iuZUzRSVfLRtTjxiN0PF/Kea0I3ftgXg5H2iM3uT4vKl3gjFj" crossorigin="anonymous">

</head>
<style>
    
</style>


<?php
$idMagazine = $_GET['id'];
?>
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <form action="upload.php" method="post" enctype="multipart/form-data" class="p-3 shadow-sm rounded bg-white">
                                    <h2 class="card-title fw-semibold mb-4 text-center">Submit Article Form</h5>
                                    <div class="mb-3">
                                        <label for="article_title" class="form-label">Title:</label>
                                        <input type="text" class="form-control" id="article_title" name="article_title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="article_content" class="form-label">Content:</label>
                                        <textarea class="form-control" id="article_content" name="article_content" rows="4" required></textarea>
                                        <div class="mb-3">
    <label for="files" class="form-label">Upload Files:</label>
    <input type="file" class="form-control" id="files" name="files[]" accept=".docx, .doc" multiple style="display: none;">
    <button type="button" class="btn btn-primary" onclick="document.getElementById('files').click();">Add File</button>
    <p id="selectedFiles"></p>
</div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Upload Image:</label>
                                        <input type="file" class="form-control" id="thumb" name="image" accept=".jpg, .png" required>
                                        <div class="col-md-4">
                                            <img id="preview" src="" alt="Image Preview" style="display:none; max-width: 200px; max-height:200px;">
                                        </div>
                                    </div>

                                    <input type="hidden" id="magazineId" name="magazineId" value="<?= $idMagazine ?>">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="confirmation_checkbox" name="confirmation_checkbox" required>
                                        <label class="form-check-label" for="confirmation_checkbox">I confirm that the information provided is accurate</label>
                                    </div>
                                    <button id="Submit" name="Submit" type="submit" class="btn btn-primary d-block mx-auto">Submit</button>

                                    <span id="submit-error"></span>
                                </form>
                            </div>
                        </div>
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