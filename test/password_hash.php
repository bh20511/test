<?php
$p = '123456';
echo sha1($p)."\n";
echo password_hash($p,PASSWORD_DEFAULT);