<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function ruangTulisan()
    {
        return view('pages.ruang-tulisan');
    }

    public function layanan()
    {
        return view('pages.layanan');
    }

    public function toko()
    {
        return view('pages.toko');
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function profil()
    {
        return view('pages.profil');
    }

    public function galeri()
    {
        return view('pages.galeri');
    }

    public function karir()
    {
        return view('pages.karir');
    }

    public function faq()
    {
        return view('pages.faq');
    }
}
