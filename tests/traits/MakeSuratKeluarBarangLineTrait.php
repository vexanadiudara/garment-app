<?php

use Faker\Factory as Faker;
use App\Models\SuratKeluarBarangLine;
use App\Repositories\SuratKeluarBarangLineRepository;

trait MakeSuratKeluarBarangLineTrait
{
    /**
     * Create fake instance of SuratKeluarBarangLine and save it in database
     *
     * @param array $suratKeluarBarangLineFields
     * @return SuratKeluarBarangLine
     */
    public function makeSuratKeluarBarangLine($suratKeluarBarangLineFields = [])
    {
        /** @var SuratKeluarBarangLineRepository $suratKeluarBarangLineRepo */
        $suratKeluarBarangLineRepo = App::make(SuratKeluarBarangLineRepository::class);
        $theme = $this->fakeSuratKeluarBarangLineData($suratKeluarBarangLineFields);
        return $suratKeluarBarangLineRepo->create($theme);
    }

    /**
     * Get fake instance of SuratKeluarBarangLine
     *
     * @param array $suratKeluarBarangLineFields
     * @return SuratKeluarBarangLine
     */
    public function fakeSuratKeluarBarangLine($suratKeluarBarangLineFields = [])
    {
        return new SuratKeluarBarangLine($this->fakeSuratKeluarBarangLineData($suratKeluarBarangLineFields));
    }

    /**
     * Get fake data of SuratKeluarBarangLine
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSuratKeluarBarangLineData($suratKeluarBarangLineFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'code' => $fake->word,
            'name' => $fake->word,
            'quantity' => $fake->word,
            'unit_id' => $fake->randomDigitNotNull,
            'reason' => $fake->text,
            'suratkeluarbarang_id' => $fake->word,
            'kilogram' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $suratKeluarBarangLineFields);
    }
}
