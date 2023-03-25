<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use App\Generators\BlockGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        

        $blocks = [];
        $newBlock = [];
        $newBlock['id'] = 'o0u9yCnumx';
        $newBlock['data']['text'] = fake()->text(200);
        $newBlock['type'] = 'paragraph';
        $blocks[] = $newBlock;
        

        for($i = 0; $i < 3; $i ++){
            #generate a new block for content
            if($i == 0){
                $blocks[] = BlockGenerator::generate('header');    
            }elseif ($i == 1) {
                $blocks[] = BlockGenerator::generate();
            }elseif($i == 2){
                $blocks[] = BlockGenerator::generate('image');
            }   
        }

        #is stored as json data in database
        $blocks =  json_encode($blocks);

        return [
            'user_id' => User::factory()->create(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'blocks' => $blocks,
            'image' => fake()->image(),
            'created_at' => fake()->dateTimeBetween()
        ];
    }
}
