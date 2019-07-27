<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $genres = [
      [
        'id' => 1,
        'name' => 'artes',
      ],
      [
        'id' => 2,
        'name' => 'ciencia',
      ],
      [
        'id' => 3,
        'name' => 'economía',
      ],
      [
        'id' => 4,
        'name' => 'infantiles',
      ],
      [
        'id' => 5,
        'name' => 'novelas',
      ],
      [
        'id' => 6,
        'name' => 'turismo',
      ]
    ];

    $novedades = [
      [
        'id' => 1,
        'title' => 'Luciérnagas en frascos',
        'cover_img_url' => 'mr_luciernagas.png',
        'price' => 735.0,
      ],

      [
        'id' => 2,
        'title' => 'Templanza (Irma)',
        'cover_img_url' => 'js_templanza.png',
        'price' => 735.0,
      ],

      [
        'id' => 3,
        'title' => 'La muerte del padre',
        'cover_img_url' => 'kok_lamuerte.png',
        'price' => 735.0,
      ],
    ];

    $masVendidos = [
      [
        'id' => 1,
        'title' => 'Luciérnagas en frascos',
        'cover_img_url' => 'mr_luciernagas.png',
        'price' => 735.0,
      ],

      [
        'id' => 2,
        'title' => 'Templanza (Irma)',
        'cover_img_url' => 'js_templanza.png',
        'price' => 735.0,
      ],

      [
        'id' => 3,
        'title' => 'La muerte del padre',
        'cover_img_url' => 'kok_lamuerte.png',
        'price' => 735.0,
      ],
    ];

    return view(
      'index',
      [
        'genres' => $genres,
        'novedades' => $novedades,
        'masVendidos' => $masVendidos,
      ]
    );
});
