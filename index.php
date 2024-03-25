<?php
include_once ("./connect.php");
session_start();
if (!isset ($_SESSION['username'])) {
	header("Location: ./signin.php");
	exit();
}
include_once ("./home/header.php");

?>
<br>
<br>
<br>
<br>
<?php
if (isset ($_GET['page'])) {
	$page = $_GET['page'];
	if ($page == "profile") {
		include_once ("./profile/profile.php");
	} elseif ($page == "dangky") {
		include_once ("./dang_ky.php");
	} elseif ($page == "dangnhap") {
		include_once ("./dang_nhap.php");
	} elseif ($page == "magazineStudent") {
		include_once ("./magazineStudent.php");
	} elseif ($page == "addArticleStudent") {
		include_once ("./addArticleStudent.php");
	} elseif ($page == "updateArticleStudent") {
		include_once ("./updateArticleStudent.php");
	} elseif ($page == "view_articles.php") {
		include_once ("./view_articles.php");
	} elseif ($page == "your-articles") {
		include_once ("./your-articles.php");
	} elseif ($page == "signin") {
		include_once ("./signin.php");
	} elseif ($page == "logout") {
		include_once ("./logout.php");
	} elseif ($page == "upload.php") {
		include_once ("./test-upload.php");
	}
} else {
	include_once ("./home/home.php");
}
?>

<?php
include_once ("./home/script.php");
?>


<script>
	function confirmLogout() {
        // Sử dụng SweetAlert2 thay vì hàm confirm
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '?page=logout';
            }
        });
    }

	const fileImageInput = document.getElementById('thumb');
	const previewImage = document.getElementById('preview');

	fileImageInput.addEventListener('change', function (e) {
		const file = e.target.files[0]; // Get the selected file

		if (file && file.type.startsWith('image/')) {
			const reader = new FileReader();

			reader.onload = function (e) {
				previewImage.src = e.target.result; // Set the image source
				previewImage.style.display = 'block'; // Show the preview
			};

			reader.readAsDataURL(file); // Read the file as data URL
		} else {
			previewImage.src = ""; // Clear preview if not an image
			previewImage.style.display = 'none';
		}
	});


	const fileWordInput = document.getElementById('files');
	const selectedFilesSpan = document.getElementById('selectedFiles');

	fileWordInput.addEventListener('change', function (e) {
		const files = e.target.files;

		if (files.length > 0) {
			let selectedFileNames = "";
			for (let i = 0; i < files.length; i++) {
				selectedFileNames += files[i].name + (i < files.length - 1 ? "<br>" : "");
			}
			selectedFilesSpan.innerHTML = selectedFileNames; // Use innerHTML for HTML tags
		} else {
			selectedFilesSpan.textContent = "No files chosen";
		}
	});
</script>
</body>

</html>