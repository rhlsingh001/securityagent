<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Agent;
use App\User;
use App\AgentType;
use App\Traits\HelperTrait;
use App\Traits\ResponseTrait;
use App\AgentDiplomaCertificate;
use DB;

trait AgentTrait
{
    use HelperTrait;

    /**
    * Save agent data to database
    */

    public function registerAgent($request){
    	try{
            DB::beginTransaction();
            $post = array_except($request->all(),['_token']);
            $agentType = json_decode($post['agent_type']);
            $dogInfo = $request->file('dog_info');  
            $roleID = $this->get_user_role_id('agent');
            // Insert data to users table
            $userData = [
                'email' => $post['email'],
                'role_id' => $roleID,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $userID = User::insertGetId($userData);
    	    // Insert data to agents table
            $post['user_id'] = $userID;
            $post['avatar_icon'] = 'dummy_avatar.jpg';
    	    $username = 'agent'.mt_rand(10000, 99999);
    	    $post['username'] = $username;
            // Upload ID Proof Image
            $icard = $request->file('identity_card');   
            $fileName = $username.'_id_'.time().'.'.$icard->getClientOriginalExtension();
            $filePath = public_path('agent/documents');
            $uploadStatus = $icard->move($filePath,$fileName);
            $post['identity_card'] = $fileName;

            // Upload Social Security Number Proof
            $scn = $request->file('social_security_number');   
            $fileName = $username.'_ssn_'.time().'.'.$scn->getClientOriginalExtension();
            $filePath = public_path('agent/documents');
            $uploadStatus = $scn->move($filePath,$fileName);
            $post['social_security_number'] = $fileName;
            
            // Upload Agent CV
            $cv = $request->file('cv');   
            $fileName = $username.'_cv_'.time().'.'.$cv->getClientOriginalExtension();
            $filePath = public_path('agent/documents');
            $uploadStatus = $cv->move($filePath,$fileName);
            $post['cv'] = $fileName;

            $post['status'] = 0;
            $post['work_location_latitude'] = $post['work_location']['lat'];
            $post['work_location_longitude'] = $post['work_location']['long'];
            $post['current_location_lat_long'] = $post['current_location']['lat'].', '.$post['current_location']['long'];
            $post['created_at'] = Carbon::now();
            $post['updated_at'] = Carbon::now();
            //Save Data to Database 
            $certificates = $request->diploma;
            unset($post['work_location'],$post['current_location'],$post['diploma'],$post['email'],$post['agent_type'],$post['dog_info']);
            $agentID = Agent::insertGetId($post);
            // Insert Agent Types
            $is_hostess = 0;
            foreach($agentType as $type){
                $data = [
                    'agent_id' => $agentID,
                    'agent_type' => $type,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                if($type==6){
                    // Upload Dog Mutual Info Document
                    $fileName = $username.'_dog_'.time().'.'.$dogInfo->getClientOriginalExtension();
                    $filePath = public_path('agent/documents');
                    $uploadStatus = $dogInfo->move($filePath,$fileName);
                    $data['dog_info'] = $fileName;
                }
                if($type==7){
                    $is_hostess = 1;
                }
                AgentType::insert($data);
            } 
            if($is_hostess==1){
                $hostess_avatar = 'hostess_avatar.jpg';
                Agent::where('id',$agentID)->update(['avatar_icon'=>$hostess_avatar]);
            }
            //Add diploma certificates
            if(in_array(1, $agentType) || in_array(2, $agentType) || in_array(3, $agentType)){
                if(isset($certificates) && !empty($certificates)){
                    $i=0;
                    foreach($certificates as $certificate) {
                        $fileName = $username.'_dip_'.time().'.'.$certificate->getClientOriginalExtension();
                        $filePath = public_path('agent/documents');
                        $uploadStatus = $certificate->move($filePath,$fileName);
                        $data = [
                            'user_id' => $userID,
                            'file_name' => $fileName,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                        AgentDiplomaCertificate::insert($data);
                        $i++;
                    }
                }
            }
            DB::commit();
            $response['message'] = 'Agent has been registered successfully. You will receive an email for your login credentials.';
            $response['delayTime'] = 5000;
            $response['url'] = url('/');
            return $this->getSuccessResponse($response);
        }catch(\Exception $e){
            DB::rollback();
            return $this->getErrorResponse($e->getMessage());
        }           
    }

    /**
    * Get available agents from database
    */
    public function getAvailableAgents($request){
        $a = Agent::where('status',1)->where('available',1);
        if(isset($request->type) && $request->type=='is_vehicle'){
            $a->where('is_vehicle',$request->value);
        }
        if(isset($request->type) && $request->type=='agent_type'){
            $typeID = $request->value;
            $a->whereHas('types',function($q) use ($typeID){
                $q->where('agent_type',$typeID);
            });
        }
        $agents = $a->select(DB::raw("*, 111.111 *
                    DEGREES(ACOS(LEAST(1.0, COS(RADIANS(".$request->latitude."))
                    * COS(RADIANS(work_location_latitude))
                    * COS(RADIANS(".$request->longitude." - work_location_longitude))
                    + SIN(RADIANS(".$request->latitude."))
                    * SIN(RADIANS(work_location_latitude))))) AS distance_in_km"))->having('distance_in_km', '<', 100)->get();
        $agentArr = [];
        foreach($agents as $agent){
            // Set marker icon
            $markerIcon = asset('avatars/marker-male.png');
            $typeArr = $agent->types->pluck('agent_type')->toArray();
            if(in_array(7, $typeArr)){
                $markerIcon = asset('avatars/marker-female.png');
            }
            $strArr   = [];
            $strArr['username'] = $agent->username;
            $strArr['avatar_icon'] = asset('avatars/'.$agent->avatar_icon);
            $strArr['agent_type'] = $agent->agent_type;
            $strArr['lat'] = trim($agent->work_location_latitude);
            $strArr['long'] = trim($agent->work_location_longitude);
            $strArr['is_vehicle'] = $agent->is_vehicle;
            $strArr['id'] = $agent->id;
            $strArr['types'] = $agent->types;
            $strArr['marker'] = $markerIcon;
            $strArr['distance'] = round($agent->distance_in_km);
            $agentArr[] = $strArr; 
        }
        return $agentArr;
    }
}
