<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $category_id = DB::table('category')->insertGetId(
                array('name' => 'Front-end')
        );

        DB::table('level')->insert(array(
            array('id' => 1, 'label' => 'Débutant', 'point' => '1'),
            array('id' => 2, 'label' => 'Intermédaire', 'point' => '2'),
            array('id' => 3, 'label' => 'Difficile', 'point' => '3')
        ));

        $category_id = DB::table('category')->insertGetId(
                array('name' => 'Back-end')
        );

        $category_id = DB::table('category')->insertGetId(
                array('name' => 'CSS3')
        );

    }

}
