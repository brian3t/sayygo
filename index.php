<?php
if (strpos($_SERVER['REQUEST_URI'], '/uploads/') === false) {
    header("Location: f/web/");
}
