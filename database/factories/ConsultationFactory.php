<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'user_id' =>$this->faker->randomDigitNotNull(),
            'topic' => 'Draudimo produktai',
            'type' => 'Telefonu', 
            'additional_info' => $this->faker->paragraph(),
            'consultation_date' => $this->faker->date(),
        ];
    }
}
