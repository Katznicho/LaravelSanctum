<?php

namespace App\Http\Controllers\Agents;

use App\Http\Controllers\Controller;
use App\Models\Agents\FuelAgentModel;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FuelAgentController extends Controller
{
    use LogTrait;
    public function registerAgent(Request $request)
    {
        $this->validate($request, [
            'fuelAgentName' => 'required',
            "fuelAgentPhoneNumber" => "required",
            'secondPhoneNumber' => "required",
            "backIDPhoto" => "required",
            "frontIDPhoto" => "required",
            'stationId' => "required",
        ]);



        //move the image
        $frontIdPhoto = time() * rand(100, 1000) . "_" . strtolower(str_replace(' ', '', $request->fuelAgentName)) . "." .
            $request->frontIDPhoto->extension();
        $backIdPhoto = time() * rand(1000, 100000) . "_" . strtolower(str_replace(' ', '', $request->fuelAgentName)) . "." .
            $request->backIDPhoto->extension();

        //storage destination
        $destination_path = 'public/images/fuelagents';


        $request->file("frontIDPhoto")->storeAS($destination_path, $frontIdPhoto);
        $request->file("backIDPhoto")->storeAS($destination_path, $backIdPhoto);

        // //register agent
        $fuelAgent = FuelAgentModel::create([
            'fuelAgentName' => $request->fuelAgentName,
            "status" => "0",
            "fuelAgentPhoneNumber" => $request->fuelAgentPhoneNumber,
            'anotherPhoneNumber' => $request->secondPhoneNumber,
            "backIDPhoto" => $frontIdPhoto,
            "frontIDPhoto" => $backIdPhoto,
            'stationId' => $request->stationId,

        ]);
        if ($fuelAgent) {
            $this->createActivityLog("Registered Agent", "Agent Registered successfully");
            return  response(["message" => "success", "data" => $fuelAgent, "statusCode" => Response::HTTP_OK], Response::HTTP_OK);
        }
    }
}
