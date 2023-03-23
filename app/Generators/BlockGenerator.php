<?php

namespace App\Generators;

use Illuminate\Foundation\Testing\WithFaker;


class BlockGenerator {

	static function generateHeader(){
		return [
			'id' => fake()->ean8(),
			'type' => 'header',
			'data' => [
				'level' => fake()->randomDigit(),
				'text' => fake()->text()
			]
		];
	}

	static function generateImage(){
		return [
			'id' => fake()->ean8(),
			'type' => 'image',
			'data' => [
				'file' => [
					'url' => 'https://via.placeholder.com/640x480.png/0033ff?text=animals+animi'
				],
				'caption' => fake()->text(100),
				'stretched' => false,
				'withBackground' => false,
				'withBorder' => false
			]
		];
	}


	static function generateBlock(){
		return [
			'id' => fake()->ean8(),
			'data' => [
				'text' => fake()->text(200)
			],
			'type' => 'paragraph'
		];
	}

	/**
	 * generate a block
	 */
	static function generate($type = null){
		
		if($type == 'header'){
			return self::generateHeader();
		}else if($type == 'image'){
			return self::generateImage();
		}else{
			return self::generateBlock();
		}
	}
}