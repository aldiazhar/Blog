<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$menulisArtikel = new Permission();
        $menulisArtikel->name = 'Menulis Artikel';
        $menulisArtikel->slug = 'menulis-artikel';
        $menulisArtikel->save();

        $editArtikel = new Permission();
        $editArtikel->name = 'Mengedit Artikel';
        $editArtikel->slug = 'mengedit-artikel';
        $editArtikel->save();

        $reviewArtikel = new Permission();
        $reviewArtikel->name = 'Mereview Artikel';
        $reviewArtikel->slug = 'mereview-artikel';
        $reviewArtikel->save();

        $menerbitkanArtikel = new Permission();
        $menerbitkanArtikel->name = 'Menerbitkan Artikel';
        $menerbitkanArtikel->slug = 'menerbitkan-artikel';
        $menerbitkanArtikel->save();

        $menerbitkanKomen = new Permission();
        $menerbitkanKomen->name = 'Menerbitkan Komen';
        $menerbitkanKomen->slug = 'menerbitkan-komen';
        $menerbitkanKomen->save();

        $tamu = new Permission();
        $tamu->name = 'Tamu';
        $tamu->slug = 'tamu';
        $tamu->save();
    }
}
