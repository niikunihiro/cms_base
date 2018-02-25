<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\DatabaseManager;

/**
 * Class ArticleSeeder
 */
class ArticleSeeder extends Seeder
{
    /** @var DatabaseManager $DB */
    private $DB;

    /**
     * ArticleSeeder constructor.
     * @param DatabaseManager $databaseManager DatabaseManager を DI する
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->DB = $databaseManager;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $this->DB->transaction(function () use ($faker) {
            foreach (range(1, 5000) as $item) {
                $this->DB->insert(
                    'INSERT INTO article (title, content) VALUES (?, ?)',
                    [$faker->company, $faker->text]
                );
                if ($item % 1000 === 0) {
                    echo '+';
                }
            }
        });
    }
}
