<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_users_can_be_persisted()
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    /**
     * @dataProvider invalidUsersData
     */
    public function test_users_can_not_be_persisted_without_required_field($requiredNull)
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        $user = User::factory()->create($requiredNull);
        $user->save();
    }

    public function invalidUsersData()
    {
        return [
            [['name' => null]],
            [['email' => null]],
            [['password' => null]],
            [['cpf' => null]],
            [['sexo' => null]],
            [['tipo' => null]],
            [['data_de_nascimento' => null]],
        ];
    }
}
