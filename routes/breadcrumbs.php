<?php
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->push('Sklep', url('/'));
    if ($category->category) {
        $breadcrumbs->push($category->category->name, url($category->category->getPath()));
    }
    $breadcrumbs->push($category->name, url($category->getPath()));
});

Breadcrumbs::register('product', function ($breadcrumbs, $product) {
    $breadcrumbs->push('Sklep', url('/'));
    if ($product->defaultCategory->category) {
        $breadcrumbs->push($product->defaultCategory->category->name, url($product->defaultCategory->category->getPath()));
    }
    $breadcrumbs->push($product->defaultCategory->name, url($product->defaultCategory->getPath()));

    $breadcrumbs->push($product->name, url($product->getPath()));
});

Breadcrumbs::register('manufacturer', function ($breadcrumbs, $manufacturer) {
    $breadcrumbs->push('Sklep', url('/'));

    $breadcrumbs->push($manufacturer->name, url($manufacturer->getPath()));
});

Breadcrumbs::register('cart', function ($breadcrumbs) {
    $breadcrumbs->push('Sklep', url('/'));
    $breadcrumbs->push('Koszyk', url('/koszyk/'));

});