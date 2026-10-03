<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@flight.ru'],
            [
                'fio' => 'Администратор Администратор Администраторович',
                'password' => Hash::make('QWEasd123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@flight.ru'],
            [
                'fio' => 'Иванов Иван Иванович',
                'password' => Hash::make('password'),
                'role' => 'client',
            ]
        );

        Product::updateOrCreate(
            ['name' => 'SU-100 Москва Сочи'],
            [
                'description' => 'Рейс SU-100, Вылет 12:00, Эконом класс',
                'price' => 8500,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'SU-202 Москва Санкт-Петербург'],
            [
                'description' => 'Рейс SU-202, Вылет 15:30, Эконом класс',
                'price' => 4200,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'SU-303 Москва Казань'],
            [
                'description' => 'Рейс SU-303, Вылет 18:00, Эконом класс',
                'price' => 3500,
            ]
        );
    }
}
