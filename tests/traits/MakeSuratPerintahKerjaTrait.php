<?php

use Faker\Factory as Faker;
use App\Models\SuratPerintahKerja;
use App\Repositories\SuratPerintahKerjaRepository;

trait MakeSuratPerintahKerjaTrait
{
    /**
     * Create fake instance of SuratPerintahKerja and save it in database
     *
     * @param array $suratPerintahKerjaFields
     * @return SuratPerintahKerja
     */
    public function makeSuratPerintahKerja($suratPerintahKerjaFields = [])
    {
        /** @var SuratPerintahKerjaRepository $suratPerintahKerjaRepo */
        $suratPerintahKerjaRepo = App::make(SuratPerintahKerjaRepository::class);
        $theme = $this->fakeSuratPerintahKerjaData($suratPerintahKerjaFields);
        return $suratPerintahKerjaRepo->create($theme);
    }

    /**
     * Get fake instance of SuratPerintahKerja
     *
     * @param array $suratPerintahKerjaFields
     * @return SuratPerintahKerja
     */
    public function fakeSuratPerintahKerja($suratPerintahKerjaFields = [])
    {
        return new SuratPerintahKerja($this->fakeSuratPerintahKerjaData($suratPerintahKerjaFields));
    }

    /**
     * Get fake data of SuratPerintahKerja
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSuratPerintahKerjaData($suratPerintahKerjaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'code' => $fake->word,
            'line_id' => $fake->randomDigitNotNull,
            'date' => $fake->word,
            'suratkeluarbarang_id' => $fake->randomDigitNotNull,
            'brand_id' => $fake->randomDigitNotNull,
            'article_id' => $fake->randomDigitNotNull,
            'color_id' => $fake->randomDigitNotNull,
            'size_id' => $fake->randomDigitNotNull,
            'quantity_pcs' => $fake->randomDigitNotNull,
            'quantity_lsn' => $fake->word,
            'created_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $suratPerintahKerjaFields);
    }
}
