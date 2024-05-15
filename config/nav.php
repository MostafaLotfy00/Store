<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt ',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'badge' => 'new',
        'active' => 'dashboard.dashboard'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'active' => 'dashboard.categories.*'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'products',
        'active' => 'dashboard.products.*'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'active' => 'dashboard.orders.*'
    ],
    
];