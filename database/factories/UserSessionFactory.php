<?php
namespace Database\Factories;

use App\Models\UserSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserSessionFactory extends Factory
{
    protected $model = UserSession::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'datetimes' => [Carbon::now()->subHours(rand(1, 24)), Carbon::now()],
        ];
    }
}

