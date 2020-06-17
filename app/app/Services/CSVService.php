<?php


namespace App\Services;

use League\Csv\Reader;

class CSVService
{
    /**
     * Parses a CSV file and returns an array of objects.
     *
     * @param $file
     * @return array
     */
    public function parseCSV($file) {
        //load the CSV document from a file path
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

        $output = [];
        foreach ($records as $record) {
            $output[] = $record;
        }

        return $output;
    }
}