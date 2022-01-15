<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Models\Stages\StageModel;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class StageController extends Controller
{
    use LogTrait;
    //

    public function registerStage(Request $request)
    {
        $this->validate($request, [
            'stageName' => 'required',
            'fuelStationId' => "required",
            'districtCode' => "required",
            'countyCode' => "required",
            'subCountyCode' => "required",
            'parishCode' => "required",
            'villageCode' => "required",
            "latitude" => "required",
            "longitude" => "required"
        ]);

        $success = StageModel::create([
            'stageName' => strtoupper($request->stageName),
            "stageStatus" => "0",
            'fuelStationId' => $request->fuelStationId,
            'districtCode' => $request->districtCode,
            'countyCode' => $request->countyCode,
            'subCountyCode' => $request->subCountyCode,
            'parishCode' => $request->parishCode,
            'villageCode' => $request->villageCode,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude
        ]);

        if ($success) {
            $this->createActivityLog("Registered Stage", "Stage Registered successfully");
            return response(['message' => "success", "data" => $success, "statuCode" => Response::HTTP_OK], Response::HTTP_OK);
        } else {
            return response(['message' => "Failure", "data" => "Error Please Try again", "statusCode" => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        }
    }


    public function fetchstages()
    {
        $stages = StageModel::all();
        return response(["message" => "success", "data" => $stages, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
    }
}
