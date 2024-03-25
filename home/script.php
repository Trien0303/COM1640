<script src="./js/jquery.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/slick.min.js"></script>
<script src="./js/jquery.sticky-sidebar.min.js"></script>
<script src="./js/custom.js"></script>
<script>
      function confirmLogout() {
        var confirmLogout = confirm("Are you sure you want to log out?");
        if (confirmLogout) {
          window.location.href = '?page=logout';
        }
      }
      
</script>
</body>
</html>