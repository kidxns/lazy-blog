<?php

use App\Models\Post;



Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', url('/admin/posts'));
});
//Home > Dashboard
Breadcrumbs::for('dashboard.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard.index'));
});


// Home > Post
Breadcrumbs::for('posts.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Posts', route('posts.index'));
});

Breadcrumbs::for('posts.create', function ($trail) {
    $trail->parent('posts.index');
    $trail->push('Create', route('posts.create'));
});

// Home > Posts > [Category]
Breadcrumbs::for('posts.edit', function ($trail, $id) {
    $trail->parent('posts.index');
    $post = Post::findOrFail($id);
    $trail->push($post->title, route('posts.edit', $post->id));
});


// Home > Categores
Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Categories', route('categories.index'));
});


// Home > Comments
Breadcrumbs::for('comments.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Comments ', route('comments.index'));
});


// Home > Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});

// Home > Account
Breadcrumbs::for('setting.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Account', route('setting.index'));
});

Breadcrumbs::for('errors.404', function ($trail) {
    $trail->parent('home');
    $trail->push('Page Not Found');
});

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });
