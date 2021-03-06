<?php

/**
 * Copyright (C) 2016 Álvaro Orduna León
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

$request = "http://" . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
$base_url = substr($request, 0, strrpos($request, 'trabajofinal')) . 'trabajofinal';

// Define PROJECT constants
define('PROJECT_PATH', dirname(__DIR__));
define('PROJECT_NAME', 'Filosofía Joven');
define('PROJECT_BASE_URL', $base_url);
define('PROJECT_PROFILE_IMAGES', $base_url . "/public/images/profiles/");
define('PROJECT_BLOG_IMAGES', $base_url . "/public/images/blog/");

// Define PROJECT folders
define('FOLDER_UTIL', PROJECT_PATH . DIRECTORY_SEPARATOR . 'utils');
define('FOLDER_TEMPLATES', PROJECT_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'templates');
define('FOLDER_CONFIG', PROJECT_PATH . DIRECTORY_SEPARATOR . 'config');
define('FOLDER_IMAGES', PROJECT_PATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images');
define('FOLDER_PROFILE_IMAGES', FOLDER_IMAGES . DIRECTORY_SEPARATOR . 'profiles');
define('FOLDER_BLOG_IMAGES', FOLDER_IMAGES . DIRECTORY_SEPARATOR . 'blog');

// Include util files
include_once FOLDER_UTIL . DIRECTORY_SEPARATOR . 'functions.php';
include_once FOLDER_UTIL . DIRECTORY_SEPARATOR . 'loader.php';
include_once FOLDER_UTIL . DIRECTORY_SEPARATOR . 'error_handler.php';
