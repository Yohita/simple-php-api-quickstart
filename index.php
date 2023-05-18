<?php
//include all required files
include __DIR__.'/inc.php';

//include routes
include __DIR__.'/routes.php';

//script should end in above function , if not show 404 error 
Helper::sendResponse(404,'Page Not Found');