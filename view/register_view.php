<?php
session_start();
include('view/templates/header.php');




include('view/templates/footer.php');
?>
<button onclick="goBack()" class="btn btn-secondary">Volver Atrás</button>

<script>
function goBack() {
  window.history.back();
}
</script>