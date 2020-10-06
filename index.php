<?php 

    switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
        case '/':
            require 'login.php';
            break;
        case '/login.php':
            require 'login.php';
            break;
        case '/signup.php':
            require 'signup.php';
            break;
        case '/forgot.php':
                require 'forgot.php';
                break;
        case '/welcome.php':
                require 'welcome.php';
                break;
        default:
            http_response_code(404);
            exit('<h3><b>ERROR 404: Page Not Found<b></h3>');
    }
?>