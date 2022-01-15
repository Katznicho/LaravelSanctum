<p align="center">API DOCUMENTATION</p>

localhostUrl:http://127.0.0.1:8000
serverUrl:http://appdev.creditplus.ug/bodafuelprojectmobileappapi/public/index.php/api
baseUrl:{envUrl}/api/
//3|9byENgHGQ53aneLv32VyX1aQbwCa5IfzHbw965el

# IMPORTANT

Any request after login requires an accessToken which is valid as long as the user is still logged in
Add Bearer token

# LOGIN API

method:post
url:{baseUrl}/login
content type:application/json
Required fields: email , password
OnSuccess:
Sample Access data
{
"message": "success",
"data": {
"user": {
"email": "katznicho@gmail.com",
"name": "katende nicholas",
"roleId": 1,
"gender": "male",
"phoneNumber": "0759983853",
"profilePicture": null
},
"accessToken": "20|Oo2iITszVVzXR0nME0fKVf54WZJA6Jyq9QKsqzsE"
},
"statusCode": 200
}

OnFailure:
if either the email or provided password is not correct
Sample Failure Data
{
"message": "failure",
"data": "invalid credentials",
"statusCode": 401
}

# LOGOUT API

method:post
url:{baseUrl}/logout
content type:application/json
No fields required
On Success
{
"message": "failure",
"data": "logout successfully",
"statusCode": 401
}

# FUEL STATION API

method:post
url:{baseUrl}/registerfuelstation
content type multi-part form-data
Required fields:fuelStationName(String) ,districtCode(Refer to district API ) ,countyCode(Refer to countyCode API) subCountyCode (Refer to subCounty API), parishCode (Refere Parish API ) , villageCode(Refer to village API ), contactPersonName(String),contactPersonPhone(String),ninNumber(String),bankName(String), longitude(String), latitude(String)
bankBranch(String),AccName(String),AccNumber(String), frontIDPhoto(file), backIDPhoto(file)

On Success
Sample Success data
{
"message": "success",
"data": {
"fuelStationName": "STATIONONE",
"fuelStationContactPerson": "JAMES",
"fuelStationContactPhone": "0759983853",
"districtCode": "140",
"countyCode": "70",
"subCountyCode": "12",
"parishCode": "1",
"villageCode": "1",
"merchantCode": "14070121125",
"bankName": "STANBIC",
"bankBranch": "KAWEMPE",
"AccName": "ACC",
"AccNumber": "1122334",
"frontIDPhoto": "1308657475002_stationone.png",
"fuelStationStatus": "0",
"fuelStationId": 26
},
"statusCode": 200
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}
if fields are missing:
{
"message": "The given data was invalid.",
"errors": {
"districtCode": [
"The district code field is required."
],
"countyCode": [
"The county code field is required."
]
}

# DISTRICT API

method:get
url:{baseUrl}/districts
content-type :application/json
Fields:None required
On Success
{
message:"Success",
[

    "data"=>[
        {

"districtCode": 53,
"districtName": "YUMBE"
},
{
"districtCode": 87,
"districtName": "ZOMBO"
}

    ]
    "statusCode": 200

}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# COUNTY API

method:post
url:{baseUrl}/counties
content-type :application/json
Fields:districtCode
On Success
{
{
"message"=>"success",
"data"=>[
{
"districtCode": 87,
"countyCode": "140",
"countyName": "LABWOR"

}

    ],
    "statusCode"=>200

}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# SUB COUNTY API

method:post
url:{baseUrl}/subcounties
content-type :application/json
Fields:districtCode, countyCode,
On Success:

{
"message"=>"Failure",
"data"=>[
{
"districtCode": 70,
"countyCode": 140,
"subCountyCode": 1,
"subCountyName": "ABIM"
}],
"statusCode"=>"200"

}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# PARISH API

method:post

url:{baseUrl}/parishes
content-type :application/json

Fields:districtCode, countyCode, subCountyCode

On Success

{
"message"=>"Failure",
"data"=>[
{
"districtCode": 70,
"countyCode": 140,
"subCountyCode": 1,
"parishCode": 52,
"parishName": "ABONGEPACH"
},
}],
"statusCode"=>"200"
}

On Failure

if no token in the headers:
{
"message": "Unauthenticated."
}

# VILLAGE API

method:post
content-type :application/json

url:{baseUrl}/villagess

Fields:districtCode, countyCode, subCountyCode, parishCode

On Success

{
"message"=>"Failure",
"data"=>[
{
"districtCode": 70,
"countyCode": 140,
"subCountyCode": 1,
"parishCode": 52,
"villageCode":36,
"villageName": "ABONGEPACH"
},
}],
"statusCode"=>"200"
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# FETCH STATIONS API

method :get
content-type :application/json
url:{baseUrl}/stations
On Success:
{
"message": "success",
"data": [
{
"fuelStationId": 1,
"fuelStationName": "KATENDE NICHOLAS",
"fuelStationContactPerson": "KATENDE NICHOLAS",
"fuelStationContactPhone": "0759983853",
"NIN": null,
"frontIDPhoto": "",
"backIDPhoto": "",
"fuelStationStatus": 1,
"totalAmount": null,
"currentAmount": null,
"bankName": "CENTENARY BANK",
"bankBranch": "KAWEMPE",
"AccName": "LUTS",
"AccNumber": "1233",
"merchantCode": null,
"districtCode": null,
"countyCode": null,
"subCountyCode": null,
"parishCode": null,
"villageCode": null
},
"statusCode"=>"200"
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# FETCH STATIONS BY DISTRICT AND COUNTY

method :post
content-type :application/json
url:{baseUrl}/fetchstationsbycounty
RequiredFields:districtCode(integer), countyCode(integer)
On Success:
{
"message": "success",
"data": [
{
"fuelStationId": 1,
"fuelStationName": "KATENDE NICHOLAS",
"fuelStationContactPerson": "KATENDE NICHOLAS",
"fuelStationContactPhone": "0759983853",
"NIN": null,
"frontIDPhoto": "",
"backIDPhoto": "",
"fuelStationStatus": 1,
"totalAmount": null,
"currentAmount": null,
"bankName": "CENTENARY BANK",
"bankBranch": "KAWEMPE",
"AccName": "LUTS",
"AccNumber": "1233",
"merchantCode": null,
"districtCode": null,
"countyCode": null,
"subCountyCode": null,
"parishCode": null,
"villageCode": null
},
"statusCode"=>"200"
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# REGISTER STAGE

method :post
content-type :application/json
url:{baseUrl}/registerstage
RequiredFields:districtCode(integer), countyCode(integer), fuelStationId(integer , use one of the fetch stations APIs ),
stageName(string),longitude(String), latitude(String)

Success:
{
"message": "success",
"data": {
"stageName": "STAGEONE",
"stageStatus": "0",
"fuelStationId": "1",
"districtCode": "140",
"countyCode": "70",
"subCountyCode": "12",
"parishCode": "1",
"villageCode": "1",
"stageId": 7
},
"statuCode": 200
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# REGISTER BODA USER

method :post
content-type :multi-part form-data
url:{baseUrl}/registerbodauser
RequiredFields:bodaUserName(string), bodaUserPhoneNumber(string), bodaUserBodaNumber(string),
fuelStationId(integer , use one of the fetch stations APIs ), stageId(FETECH STAGE API),
bodaUserBackPhoto(file) bodaUserFrontPhoto(file),bodaUserRole(string),
longitude(String), latitude(String)
Note:BodaUserRole is either Chairman or BodaUser
if the role is Chairman another field called secondNumber must be provided other wise it throws an error

Success:
{
"message": "success",
"data": {
"bodaUserName": "Katende",
"bodaUserStatus": "0",
"bodaUserNIN": "123456",
"bodaUserPhoneNumber": "0759983853",
"bodaUserBodaNumber": "12345",
"bodaUserBackPhoto": "1091917807225_katende.png",
"bodaUserFrontPhoto": "38561939402525_katende.png",
"bodaUserRole": "BodaUser",
"fuelStationId": "1",
"stageId": "1"
},
"statusCode": 200
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}
if some fields are not provided

# FETCH STAGES

method :get
content-type :application/json
url:{baseUrl}/stages
On Success:Returns :
{
"message": "success",
"data": [
{
"stageId": 3,
"stageName": "Kawempe Stage",
"stageStatus": 0,
"chairmanId": "21",
"fuelStationId": 1,
"location": null,
"districtCode": null,
"countyCode": null,
"subCountyCode": null,
"parishCode": null,
"villageCode": null
}],
"statusCode"=>"200"
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}

# REGISTER FUEL AGENT

method :post
content-type :multi-part form-data
url:{baseUrl}/registeragent
RequiredFields:fuelAgentName(string), fuelAgentPhoneNumber(string), secondPhoneNumber(string),
stationId(integer , use one of the fetch stations APIs ),
longitude(String), latitude(String)
backIDPhoto(file) frontIDPhoto(file)

Success:
{
"message": "success",
"data": {
"fuelAgentName": "Daaki",
"status": "0",
"fuelAgentPhoneNumber": "1234656",
"anotherPhoneNumber": "12345",
"backIDPhoto": "1518833450825_daaki.png",
"frontIDPhoto": "119229246880817_daaki.png",
"stationId": "3",
"fuelAgentId": 5
},
"statusCode": 200
}

On Failure
if no token in the headers:
{
"message": "Unauthenticated."
}
if some fields are not provided
