<?php

namespace App\Http\Controllers\Stations;

use App\Http\Controllers\Controller;
use App\Models\Stations\FuelStationModel;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StationController extends Controller
{
    use LogTrait;
    //
    public function registerStation(Request $request)
    {
        $this->validate(
            $request,
            [
                'fuelStationName' => 'required',
                'districtCode' => 'required',
                'countyCode' => 'required',
                'subCountyCode' => 'required',
                'parishCode' => 'required',
                'contactPersonName' => 'required',
                'contactPersonPhone' => 'required',
                'ninNumber' => 'required',
                'bankName' => 'required',
                'bankBranch' => 'required',
                'AccName' => 'required',
                'AccNumber' => 'required',
                'frontIDPhoto' => 'required|mimes:jpg,png,jpeg|max:5048',
                'backIDPhoto' => 'required|mimes:jpg,png,jpeg|max:5048',
                "longitude" => "required",
                "latitude" => "required"

            ]
        );
        //move the image
        $frontIdPhoto = time() * rand(100, 1000) . "_" . strtolower(str_replace(' ', '', $request->fuelStationName)) . "." . $request->frontIDPhoto->extension();
        $backIdPhoto = time() * rand(1000, 100000) . "_" . strtolower(str_replace(' ', '', $request->fuelStationName)) . "." . $request->frontIDPhoto->extension();

        //storage destination
        $destination_path = 'public/images/station';


        $request->file("frontIDPhoto")->storeAS($destination_path, $frontIdPhoto);
        $request->file("backIDPhoto")->storeAS($destination_path, $backIdPhoto);

        //select last to generate merchant code
        $lastId = 0;
        if (FuelStationModel::all()->count() == 0) {
            $lastId = 1;
        } else {
            $lastId = FuelStationModel::all()->last()->fuelStationId;
        }

        //$merchantCode  =
        $merchantCode =  $this->generateMerchantCode(
            $lastId,
            $request->districtCode,
            $request->countyCode,
            $request->subCountyCode,
            $request->parishCode,
            $request->villageCode
        );



        //insert into station
        $insert =  FuelStationModel::create([
            "fuelStationName" => strtoupper($request->fuelStationName),
            "fuelStationContactPerson" => strtoupper($request->contactPersonName),
            "fuelStationContactPhone" => $request->contactPersonPhone,
            "districtCode" => $request->districtCode,
            "countyCode" => $request->countyCode,
            "subCountyCode" => $request->subCountyCode,
            "parishCode" => $request->parishCode,
            "villageCode" => $request->villageCode,
            "merchantCode" => $merchantCode,
            "bankName" => strtoupper($request->bankName),
            "bankBranch" => strtoupper($request->bankBranch),
            "AccName" => strtoupper($request->AccName),
            "AccNumber" => $request->AccNumber,
            "frontIDPhoto" => $frontIdPhoto,
            "backIPhoto" => $backIdPhoto,
            "fuelStationStatus" => "0",
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "NIN" => $request->ninNumber

        ]);

        if ($insert) {

            $this->createActivityLog("Registered Fuel Station", "Fuel Station User Registered successfully");
            return response(['message' => "success", "data" => $insert, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
        } else {
            return response(['Message' => "Failure", "data" => "Error Please Try again", "statusCode" => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        }
    }

    private function generateMerchantCode($lastId, $district, $county, $subcounty, $parish, $village)
    {
        return $district . $county . $subcounty . $parish . $village . $lastId;
    }

    //fetch stations
    public function fetchstations()
    {
        $stations = FuelStationModel::all();
        return response(["message" => "success", "data" => $stations, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
    }
    //fetch stations

    //fetch specific stations
    public function fetchstationsbycounty(Request $request)
    {
        $this->validate($request, ["countyCode" => "required"]);;
        $countyStations = FuelStationModel::where([
            ["districtCode", "=", $request->districtCode],
            ["countyCode", '=', $request->countyCode],
        ])->get();
        if (count($countyStations) == 0) {
            return response(['message' => "Failure", "data" => "No Stations Found", "statusCode" => Response::HTTP_OK]);
        }
        return response(["message" => "success", "data" => $countyStations, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
    }
}
