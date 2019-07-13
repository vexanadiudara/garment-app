<?php

use Faker\Factory as Faker;
use App\Models\OperatorGosok;
use App\Repositories\OperatorGosokRepository;

trait MakeOperatorGosokTrait
{
    /**
     * Create fake instance of OperatorGosok and save it in database
     *
     * @param array $operatorGosokFields
     * @return OperatorGosok
     */
    public function makeOperatorGosok($operatorGosokFields = [])
    {
        /** @var OperatorGosokRepository $operatorGosokRepo */
        $operatorGosokRepo = App::make(OperatorGosokRepository::class);
        $theme = $this->fakeOperatorGosokData($operatorGosokFields);
        return $operatorGosokRepo->create($theme);
    }

    /**
     * Get fake instance of OperatorGosok
     *
     * @param array $operatorGosokFields
     * @return OperatorGosok
     */
    public function fakeOperatorGosok($operatorGosokFields = [])
    {
        return new OperatorGosok($this->fakeOperatorGosokData($operatorGosokFields));
    }

    /**
     * Get fake data of OperatorGosok
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOperatorGosokData($operatorGosokFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'spk_id' => $fake->randomDigitNotNull,
            'article_id' => $fake->randomDigitNotNull,
            'operator_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $operatorGosokFields);
    }
}
