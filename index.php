<?php
if (strpos($_SERVER['REQUEST_URI'], '/uploads/') === false && strpos($_SERVER['REQUEST_URI'], '/assets/') === false) {
    header("Location: f/web/");
}
