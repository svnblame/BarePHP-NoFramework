<?php declare(strict_types=1);

$books = [
    [
        'name' => 'Do Androids Dream of Electric Sheep',
        'author' => 'Philip K. Dick',
        'purchaseUrl' => 'http://example.com',
        'releaseYear' => '2010',
    ],
    [
        'name' => 'Project Hail Mary',
        'author' => 'Andy Weir',
        'purchaseUrl' => 'http://example.com',
        'releaseYear' => '2002',
    ],
    [
        'name' => 'The Martian',
        'author' => 'Andy Weir',
        'purchaseUrl' => 'http://example.com',
        'releaseYear' => '1968',
    ],
    [
        'name' => 'Software Engineering',
        'author' => 'Gene Kelley',
        'purchaseUrl' => 'http://example.com',
        'releaseYear' => '2024',
    ]
];

$filteredItems = array_filter($books, function ($book) {
    return $book['releaseYear'] >= '2000';
});

require 'index.view.php';
