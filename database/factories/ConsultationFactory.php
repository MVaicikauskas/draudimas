<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            
            'user_id' =>User::factory()->create()->id, //paimame user id, tu kurie bus sukurti per factory
            'topic' => 'Draudimo produktai',
            'type' => 'Telefonu', 
            'additional_info' => $this->faker->paragraph(),
            'consultation_date' => $this->faker->date(),
        ];
    }
}
