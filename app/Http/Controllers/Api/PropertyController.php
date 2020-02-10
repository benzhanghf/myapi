<?php
namespace App\Http\Controllers\Api;

use App\Property;
use App\PropertyAnalytics;
use App\AnalyticTypes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->json()->all();
        // auto assign uuid if not exist
        if (!isset($data['guid'])) {
            $data['guid'] = (string) Str::uuid();
        }
        try {
            // validation
            $required = Property::getRequiredAttributes();
            foreach ($required as $r) {
                if (!isset($data[$r])) {
                    throw new \Exception(
                        "Required attribute '" . $r . "' is missing."
                    );
                }
            }
            $property = Property::create($data);
            return response()->json($property, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function allAnalyticByProperty($pid)
    {
        try {
            // validation
            if (!$pid) {
                throw new \Exception('Missing property id');
            }
            $pa = PropertyAnalytics::where('property_id', $pid)->get();
            return response()->json($pa, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function upsertAnalytic(Request $request)
    {
        $data = $request->json()->all();
        try {
            // validate
            if (!isset($data['property_id'])) {
                throw new \Exception('Missing property_id');
            }
            $property = Property::find($data['property_id']);
            if (!$property || !$property->id) {
                throw new \Exception('Invalid property_id: ' . $data['property_id']);
            }
            if (isset($data['id'])) {
                // update
                $pa = PropertyAnalytics::find($data['id']);
                $pa->fill($data);
            } else {
                // create
                $pa = new PropertyAnalytics($data);
            }
            $pa->save();
            return response()->json($pa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function suburbReport(string $suburb)
    {
        try {
            // validation
            if ($suburb === null || $suburb === '') {
                throw new \Exception('Missing suburb');
            }
            // as DB value is text not able to do query
            $result = DB::table('properties')
                ->leftJoin(
                    'property_analytics',
                    'properties.id',
                    '=',
                    'property_analytics.property_id'
                )
                ->select(
                    'properties.id',
                    'properties.suburb',
                    'property_analytics.value'
                )
                ->where('properties.suburb', $suburb)
                ->get();
            $max = null;
            $min = null;
            $cntHasValue = 0;
            $cntNoValue = 0;
            $total = 0;
            foreach ($result as $row) {
                $total++;
                $value = $row->value;
                if ($value === null || $value === '') {
                    $cntNoValue++;
                } else {
                    $cntHasValue++;
                    $number = (double) $value;
                    if ($max === null || $number > $max) {
                        $max = $number;
                    }
                    if ($min === null || $number < $min) {
                        $min = $number;
                    }
                }
            }
            $hasValue = $total > 0 ? round(($cntHasValue / $total) * 100, 2) : 0;
            $noValue = $total> 0? round(($cntNoValue / $total) * 100, 2) : 0;
            $report = [
                'suburb' => $suburb,
                'max_value' => $max,
                'min_value' => $min,
                'percentage_has_value' => $hasValue,
                'percentage_no_value' => $noValue
            ];
            return response()->json($report, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function stateReport(string $state)
    {
        try {
            // validation
            if ($state === null || $state === '') {
                throw new \Exception('Missing state');
            }
            // as DB value is text not able to do query
            $result = DB::table('properties')
                ->leftJoin(
                    'property_analytics',
                    'properties.id',
                    '=',
                    'property_analytics.property_id'
                )
                ->select(
                    'properties.id',
                    'properties.state',
                    'property_analytics.value'
                )
                ->where('properties.state', $state)
                ->get();
            $max = null;
            $min = null;
            $cntHasValue = 0;
            $cntNoValue = 0;
            $total = 0;
            foreach ($result as $row) {
                $total++;
                $value = $row->value;
                if ($value === null || $value === '') {
                    $cntNoValue++;
                } else {
                    $cntHasValue++;
                    $number = (double) $value;
                    if ($max === null || $number > $max) {
                        $max = $number;
                    }
                    if ($min === null || $number < $min) {
                        $min = $number;
                    }
                }
            }
            $hasValue = $total > 0 ? round(($cntHasValue / $total) * 100, 2) : 0;
            $noValue = $total> 0? round(($cntNoValue / $total) * 100, 2) : 0;
            $report = [
                'state' => $state,
                'max_value' => $max,
                'min_value' => $min,
                'percentage_has_value' => $hasValue,
                'percentage_no_value' => $noValue
            ];
            return response()->json($report, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function countryReport(string $country)
    {
        try {
            // validation
            if ($country === null || $country === '') {
                throw new \Exception('Missing country');
            }
            // as DB value is text not able to do query
            $result = DB::table('properties')
                ->leftJoin(
                    'property_analytics',
                    'properties.id',
                    '=',
                    'property_analytics.property_id'
                )
                ->select(
                    'properties.id',
                    'properties.country',
                    'property_analytics.value'
                )
                ->where('properties.country', $country)
                ->get();
            $max = null;
            $min = null;
            $cntHasValue = 0;
            $cntNoValue = 0;
            $total = 0;
            foreach ($result as $row) {
                $total++;
                $value = $row->value;
                if ($value === null || $value === '') {
                    $cntNoValue++;
                } else {
                    $cntHasValue++;
                    $number = (double) $value;
                    if ($max === null || $number > $max) {
                        $max = $number;
                    }
                    if ($min === null || $number < $min) {
                        $min = $number;
                    }
                }
            }
            $hasValue = $total > 0 ? round(($cntHasValue / $total) * 100, 2) : 0;
            $noValue = $total> 0? round(($cntNoValue / $total) * 100, 2) : 0;
            $report = [
                'country' => $country,
                'max_value' => $max,
                'min_value' => $min,
                'percentage_has_value' => $hasValue,
                'percentage_no_value' => $noValue
            ];
            return response()->json($report, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}