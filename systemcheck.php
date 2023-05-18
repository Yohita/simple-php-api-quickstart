<?php
//file to check system file and folder permission as well as creating required folders as required by script

//check if data folder exists if not create it 
if(!is_dir("data")){
    mkdir("data");
}
//check if assets, uplaods, downloads folder exists in data if not create them
if(!is_dir("data/assets")){
    mkdir("data/assets");
}
if(!is_dir("data/uploads")){
    mkdir("data/uploads");
}
if(!is_dir("data/downloads")){
    mkdir("data/downloads");
}
//check if cache folder exists, if not create them
if(!is_dir("cache")){
    mkdir("cache");
}
