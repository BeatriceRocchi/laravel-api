<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Functions\Helper;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Front End', 'Back End', 'Laravel', 'VueJS'];

        foreach ($types as $type) {
            $new_type = new Type();

            $new_type->name = $type;
            $new_type->slug = Helper::generateSlug($new_type->name, Type::class);

            $new_type->save();
        }
    }
}
