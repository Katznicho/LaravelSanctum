<?php

namespace App\Http\Controllers\Boda;

use App\Http\Controllers\Controller;
use App\Models\Boda\BodaUserModel;
use App\Models\Stages\StageModel;
use App\Traits\LogTrait;
use Bodauser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BodaUserController extends Controller
{
    use LogTrait;
    //
    private function trimNumber($number)
    {
        $phone = $number;
        if (strpos($number, "+256") !== false) {
            $phone =   str_replace("+256", "0", $number);
        }
        if (strpos($number, "256") !== false) {
            $number =  str_replace("256", "0", $number);
        }

        return $phone;
    }

    public function registerBodaUser(Request $request)
    {
        $this->validate($request, [
            'bodaUserName' => "required",
            "bodaUserStatus" => "0",
            'bodaUserNIN' => "required",
            'bodaUserPhoneNumber' => "required",
            "bodaUserBodaNumber" => "required",
            "bodaUserBackPhoto" => "required",
            "bodaUserFrontPhoto" => "required",
            "bodaUserRole" => "required",
            'fuelStationId' => "required",
            "stageId" => "required",
            "longitude" => "required",
            "latitude" => "required"

        ]);

        $phone =  $this->trimNumber($request->bodaUserPhoneNumber);

        //register boda user
        //move the image
        $frontIdPhoto = time() * rand(100, 1000) . "_" . strtolower(str_replace(' ', '', $request->bodaUserName)) . "." .
            $request->bodaUserFrontPhoto->extension();
        $backIdPhoto = time() * rand(1000, 100000) . "_" . strtolower(str_replace(' ', '', $request->bodaUserName)) . "." .
            $request->bodaUserBackPhoto->extension();

        //storage destination
        $destination_path = 'public/images/bodauser';


        $request->file("bodaUserFrontPhoto")->storeAS($destination_path, $frontIdPhoto);
        $request->file("bodaUserBackPhoto")->storeAS($destination_path, $backIdPhoto);

        //check role
        $chairmanId = 0;
        $chairmanId = 0;
        if (strtoupper($request->bodaUserRole) == strtoupper("chairman")) {
            $this->validate($request, ['secondNumber' => "required"]);
            if (BodaUserModel::all()->count() == 0) {
                $chairmanId = 1;
            } else {
                $id = BodaUserModel::all()->last()->bodaUserId;
                $chairmanId = $id + 1;
            }

            //update stage chairman id
            StageModel::where("stageId", $request->stageId)->update(['chairmanId' => $chairmanId]);
            //create boda user
            $bodaUser =  BodauserModel::create([
                'bodaUserName' => $request->bodaUserName,
                "bodaUserStatus" => "0",
                'bodaUserNIN' => $request->bodaUserNIN,
                'bodaUserPhoneNumber' => $phone,
                "bodaUserBodaNumber" => $request->bodaUserBodaNumber,
                "bodaUserBackPhoto" => $frontIdPhoto,
                "bodaUserFrontPhoto" => $backIdPhoto,
                "bodaUserRole" => $request->bodaUserRole,
                "alternativePhotoNumber" => $request->secondNumber,
                'fuelStationId' => $request->fuelStationId,
                "stageId" => $request->stageId,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude
            ]);

            if ($bodaUser) {
                $this->createActivityLog("Registered Boda User", "Boda User Registered successfully");
                return response(["message" => "success", "data" => $bodaUser, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
            }
        } else {
            //BodaUserModel::create([]);
            $bodaUser =  BodauserModel::create(
                [
                    'bodaUserName' => $request->bodaUserName,
                    "bodaUserStatus" => "0",
                    'bodaUserNIN' => $request->bodaUserNIN,
                    'bodaUserPhoneNumber' => $phone,
                    "bodaUserBodaNumber" => $request->bodaUserBodaNumber,
                    "bodaUserBackPhoto" => $frontIdPhoto,
                    "bodaUserFrontPhoto" => $backIdPhoto,
                    "bodaUserRole" => $request->bodaUserRole,
                    'fuelStationId' => $request->fuelStationId,
                    "stageId" => $request->stageId,
                    "latitude" => $request->latitude,
                    "longitude" => $request->longitude
                ]
            );

            if ($bodaUser) {
                $this->createActivityLog("Registered Boda User", "Boda User Registered successfully");
                return response(["message" => "success", "data" => $bodaUser, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
            }
        }
    }
}
