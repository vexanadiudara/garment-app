<?php

use Faker\Factory as Faker;
use App\Models\OperatorJahit;
use App\Repositories\OperatorJahitRepository;

trait MakeOperatorJahitTrait
{
    /**
     * Create fake instance of OperatorJahit and save it in database
     *
     * @param array $operatorJahitFields
     * @return OperatorJahit
     */
    public function makeOperatorJahit($operatorJahitFields = [])
    {
        /** @var OperatorJahitRepository $operatorJahitRepo */
        $operatorJahitRepo = App::make(OperatorJahitRepository::class);
        $theme = $this->fakeOperatorJahitData($operatorJahitFields);
        return $operatorJahitRepo->create($theme);
    }

    /**
     * Get fake instance of OperatorJahit
     *
     * @param array $operatorJahitFields
     * @return OperatorJahit
     */
    public function fakeOperatorJahit($operatorJahitFields = [])
    {
        return new OperatorJahit($this->fakeOperatorJahitData($operatorJahitFields));
    }

    /**
     * Get fake data of OperatorJahit
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOperatorJahitData($operatorJahitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'spk_id' => $fake->randomDigitNotNull,
            'article_id' => $fake->randomDigitNotNull,
            'operator_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $operatorJahitFields);
    }
}
