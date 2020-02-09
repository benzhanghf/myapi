<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $created_at = gmdate('Y-m-d H:i:s');
        $updated_at = gmdate('Y-m-d H:i:s');

        $analyticTypesCSV = $this->loadCsv(
            base_path() 
            . DIRECTORY_SEPARATOR 
            . 'data' 
            . DIRECTORY_SEPARATOR 
            . 'AnalyticTypes.csv'
        );
        $propertyCsv = $this->loadCsv(
            base_path() 
            . DIRECTORY_SEPARATOR 
            . 'data' 
            . DIRECTORY_SEPARATOR 
            . 'properties.csv'
        );
        $linkCsv = $this->loadCsv(
            base_path() 
            . DIRECTORY_SEPARATOR 
            . 'data' 
            . DIRECTORY_SEPARATOR 
            . 'PropertyAnalytics.csv'
        );

        //DB::table('analytic_types')->truncate();
        foreach ($analyticTypesCSV as $row) {
            DB::table('analytic_types')->insertOrIgnore(
                array(
                    'id' => $row[0],
                    'name' => $row[1],
                    'units' => $row[2],
                    'is_numeric' => (bool) $row[3],
                    'num_decimal_places' => $row[4],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                )
            );
        }

        //DB::table('properties')->truncate();
        foreach ($propertyCsv as $row) {
            DB::table('properties')->insertOrIgnore(
                array(
                    'id' => $row[0],
                    'guid' => (string) Str::uuid(),
                    'suburb' => $row[1],
                    'state' => $row[2],
                    'country' => $row[3],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                )
            );
        }

        foreach ($linkCsv as $row) {
            DB::table('property_analytics')->insert(
                array(
                    'property_id' => $row[0],
                    'analytic_type_id' => $row[1],
                    'value' => $row[2],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                )
            );
        }
    }

    protected function loadCsv($filename='', $delimiter=',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = null;
        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = $row;
                } 
            }
            fclose($handle);
        }
        return $data;
    }
}
