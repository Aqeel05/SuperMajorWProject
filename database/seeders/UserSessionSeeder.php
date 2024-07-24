<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSession;

class UserSessionSeeder extends Seeder
{
    public function run()
    {
        UserSession::factory()->count(10)->create(); // Creates 10 example sessions
    }
}
