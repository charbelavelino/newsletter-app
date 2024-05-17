<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscriber;

class NewsletterSubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscribersRecords = [
            ['id'=>1,'email'=>'cs@cdbpros.com','status'=>1],
            ['id'=>2,'email'=>'charbelavelino@gmail.com','status'=>1]
        ];

        NewsletterSubscriber::insert($subscribersRecords);
    }
}
