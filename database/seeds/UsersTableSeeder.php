<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        // 生成假数据集合
        $users = factory(\App\Models\User::class, 10)
                        ->make()
                        ->each(function ($user, $index) use ($faker, $avatars) {
                            $user->avatar = $faker->randomElement($avatars);
                        });

        // 让隐藏字段可见，将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库
        \App\Models\User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = \App\Models\User::find(1);
        $user->name = 'wk';
        $user->email = '123@qq.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';;
        $user->save();
    }
}
