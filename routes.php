<?php
//API Routes
get('/',"Main::hello");
get('/main/hello',"Main::hello",["Middleware::pagination"]);

//example page from Views folder
get('/main/welcome','/views/index'); 