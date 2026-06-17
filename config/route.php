<?php
return [
    ['/project', 'ProjectController@index'],
    ['/', 'HomeController@index'],
    ['/glav', 'HomeController@index'],
    ['/journal', 'JournalController@journal'],
    ['/journal', 'JournalController@journal', 'POST'],
    ['/login', 'AuthController@login', 'GET'],
    ['/login', 'AuthController@login', 'POST'],
    ['/register', 'AuthController@register', 'GET'],
    ['/register', 'AuthController@register', 'POST'],
    ['/rename', 'AuthController@rename', 'GET'],
    ['/rename', 'AuthController@rename', 'POST'],
    ['/recovery', 'AuthController@recovery', 'GET'],
    ['/recovery', 'AuthController@recovery', 'POST'],
    ['/logout', 'AuthController@logout', 'GET'],
    ['/about', 'AboutController@about'],
    ['/library', 'LibraryController@index'],
    ['/topic/{id}', 'LibraryController@topic'], // ID категории (HTML, CSS и т.д.)
    ['/page/{id}', 'LibraryController@page'],   // ID конкретного учебника
    ['/lesson/{id}', 'LibraryController@lesson'], // ID конкретного урока
    ['/admin', 'AdminController@index'],
    ['/account', 'AccountController@index'],
    ['*', 'DYNAMIC_MODULES_FALLBACK'],
    ['*', 'DYNAMIC_MODULES_FALLBACK', 'POST']
];