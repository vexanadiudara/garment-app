<?php

use Faker\Factory as Faker;
use App\Models\SuratKeluarBarang;
use App\Repositories\SuratKeluarBarangRepository;

trait MakeSuratKeluarBarangTrait
{
    /**
     * Create fake instance of SuratKeluarBarang and save it in database
     *
     * @param array $suratKeluarBarangFields
     * @return SuratKeluarBarang
     */
    public function makeSuratKeluarBarang($suratKeluarBarangFields = [])
    {
        /** @var SuratKeluarBarangRepository $suratKeluarBarangRepo */
        $suratKeluarBarangRepo = App::make(SuratKeluarBarangRepository::class);
        $theme = $this->fakeSuratKeluarBarangData($suratKeluarBarangFields);
        return $suratKeluarBarangRepo->create($theme);
    }

    /**
     * Get fake instance of SuratKeluarBarang
     *
     * @param array $suratKeluarBarangFields
     * @return SuratKeluarBarang
     */
    public function fakeSuratKeluarBarang($suratKeluarBarangFields = [])
    {
        return new SuratKeluarBarang($this->fakeSuratKeluarBarangData($suratKeluarBarangFields));
    }

    /**
     * Get fake data of SuratKeluarBarang
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSuratKeluarBarangData($suratKeluarBarangFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'code' => $fake->word,
            'name' => $fake->word,
            'start_date' => $fake->word,
            'product_departement_id' => $fake->randomDigitNotNull,
            'created_by' => $fake->randomDigitNotNull,
            'reason' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $suratKeluarBarangFields);
    }
}
