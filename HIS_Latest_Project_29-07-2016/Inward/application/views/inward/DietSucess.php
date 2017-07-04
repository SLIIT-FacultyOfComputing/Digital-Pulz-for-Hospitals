<?php if ($status == "sucess") {
    ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">
            &times;
        </a>

        <strong><span class="glyphicon glyphicon-ok"></span>   Patient Diet Requested Successfully..! </strong>
    </div>
    <?php
} elseif ($status == "fail") {
    ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">
            &times;
        </a>

        <strong><span class="glyphicon glyphicon-ok"></span>   Patient Diet is Requested Not Successfully..! </strong>
    </div>
    <?php
}
?>