<?php

use Faker\Factory as Faker;
use App\Models\OperatorBuangBenang;
use App\Repositories\OperatorBuangBenangRepository;

trait MakeOperatorBuangBenangTrait
{
    /**
     * Create fake instance of OperatorBuangBenang and save it in database
     *
     * @param array $operatorBuangBenangFields
     * @return OperatorBuangBenang
     */
    public function makeOperatorBuangBenang($operatorBuangBenangFields = [])
    {
        /** @var OperatorBuangBenangRepository $operatorBuangBenangRepo */
        $operatorBuangBenangRepo = App::make(OperatorBuangBenangRepository::class);
        $theme = $this->fakeOperatorBuangBenangData($operatorBuangBenangFields);
        return $operatorBuangBenangRepo->create($theme);
    }

    /**
     * Get fake instance of OperatorBuangBenang
     *
     * @param array $operatorBuangBenangFields
     * @return OperatorBuangBenang
     */
    public function fakeOperatorBuangBenang($operatorBuangBenangFields = [])
    {
        return new OperatorBuangBenang($this->fakeOperatorBuangBenangData($operatorBuangBenangFields));
    }

    /**
     * Get fake data of OperatorBuangBenang
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOperatorBuangBenangData($operatorBuangBenangFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'spk_id' => $fake->randomDigitNotNull,
            'article_id' => $fake->randomDigitNotNull,
            'operator_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $operatorBuangBenangFields);
    }
}
