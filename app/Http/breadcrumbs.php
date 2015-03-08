<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('首页', route('home'),['icon' => 'home']);
});

// Home > roles
Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('角色', route('roles'),['icon' => 'angle-right']);
});

// Home > roles
Breadcrumbs::register('showchart', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('用户消费趋势', route('showchart'),['icon' => 'angle-right']);
});
Breadcrumbs::register('members', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('会员', route('members.index'),['icon' => 'angle-right']);
});

// // Home > Blog
// Breadcrumbs::register('blog', function($breadcrumbs)
// {
//     $breadcrumbs->parent('home');
//     $breadcrumbs->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::register('category', function($breadcrumbs, $category)
// {
//     $breadcrumbs->parent('blog');
//     $breadcrumbs->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Page]
// Breadcrumbs::register('page', function($breadcrumbs, $page)
// {
//     $breadcrumbs->parent('category', $page->category);
//     $breadcrumbs->push($page->title, route('page', $page->id));
// });