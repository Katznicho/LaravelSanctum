<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\CountyModel;
use App\Models\Data\DistrictModel;
use App\Models\Data\ParishModel;
use App\Models\Data\SubCountyModel;
use App\Models\Data\VillageModel;
use App\Models\Stations\FuelStationModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataController extends Controller
{
    //
    public function getDistricts()
    {
        $districts =  DistrictModel::all();
        return  response(['message' => "success", "data" => $districts, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
        //$districts;
    }

    public function getCounties(Request $request)
    {
        $this->validate(
            $request,
            [
                'districtCode' => 'required',


            ]
        );
        $counties = CountyModel::select("*")->where([
            ['districtCode', '=', $request->districtCode]
        ])->get();
        return response(['message' => "success", "data" => $counties, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
    }

    public function getSubCounties(Request $request)
    {
        $this->validate(
            $request,
            [
                'districtCode' => 'required',
                'countyCode' => 'required'

            ]
        );
        //return "katende";
        $subcounties = SubCountyModel::select("*")->where([
            ['districtCode', '=', $request->districtCode],
            ['countyCode', '=', $request->countyCode]
        ])->get();

        return   response(['message' => "success", "data" => $subcounties, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
    }

    public function getParishes(Request $request)
    {
        $this->validate(
            $request,
            [
                'districtCode' => 'required',
                'countyCode' => 'required',
                'subCountyCode' => 'required'

            ]
        );
        $parishes = ParishModel::select("*")->where(
            [
                ["districtCode", '=', $request->districtCode],
                ['countyCode', '=', $request->countyCode],
                ['subCountyCode', '=', $request->subCountyCode]
            ]
        )->get();
        return response(['message' => "success", "data" => $parishes, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
    }
    public function getVillages(Request $request)
    {
        $this->validate(
            $request,
            [
                'districtCode' => 'required',
                'countyCode' => 'required',
                'parishCode' => 'required'

            ]
        );
        $villages = VillageModel::select("*")->where(
            [
                ["districtCode", '=', $request->districtCode],
                ['countyCode', '=', $request->countyCode],
                ['subCountyCode', '=', $request->subCountyCode],
                ['parishCode', '=', $request->parishCode]
            ]
        )->get();
        return response(['message' => "success", "data" => $villages, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
    }
}
