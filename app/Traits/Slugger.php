<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger {
    public static function slugger($string) { // Ciao a tutti
        // Post::slugger($title)

        // generare lo slug base
        $baseSlug = Str::slug($string); // ciao-a-tutti
        $i = 1;

        $slug = $baseSlug;
        // finchè lo slug generato è presente nella tabella
        while (self::where('slug', $slug)->first()) {
            // genera un nuovo slug concatenando il contatore
            $slug = $baseSlug . '-' . $i; // ciao-a-tutti-1
            // incrementa il contatore
            $i++; // 2
        }

        // ritornare lo slug trovato
        return $slug;
    }
}