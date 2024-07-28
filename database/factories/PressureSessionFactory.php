<?php
namespace Database\Factories;

use App\Models\PressureSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PressureSessionFactory extends Factory
{
    protected $model = PressureSession::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'datetimes' => [Carbon::now()->subHours(rand(1, 24)), Carbon::now()],
        ];
    }
}

