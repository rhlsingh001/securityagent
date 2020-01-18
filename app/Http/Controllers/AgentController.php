<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AgentTrait;
use App\Validators\AgentValidator;
use App\Traits\ResponseTrait;


class AgentController extends Controller
{
	use AgentValidator, AgentTrait, ResponseTrait;
    
    /**
     * @param $request
     * @return mixed
     * @method index
     * @purpose Load agent signup view 
     */
    public function index(){
        return view('agent-register');
    }

    /**
     * @param $request
     * @return mixed
     * @method agentRegister
     * @purpose To register as an agent
     */
    public function signup(Request $request){
    	try{
            // Check Agent Table Validation
        	$validation = $this->agentSignupValidations($request);
            if($validation['status']==false){
                return response($this->getValidationsErrors($validation));
            }
            $agentType = json_decode($request->agent_type);
            if(empty($agentType)){
                return $this->getErrorResponse('Choose an agent type');
            }else{
                $cnaps = 0;
                foreach($agentType as $type){
                    if($type > 3){
                        $cnaps = 1;
                    }
                }
                if($cnaps == 1){
                    if(empty(trim($request->cnaps_number))){
                        return $this->getErrorResponse('Please enter CNAPS Number');
                    }
                }
            }
            if(!isset($request->work_location['lat']) || empty($request->work_location['lat'])){
                return $this->getErrorResponse('GPS location is not enabled.');
            }
            // Works on HTTPS
            // if(!isset($request->current_location['lat']) || empty($request->current_location['lat'])){
            //     return $this->getErrorResponse('GPS location is not enabled.');
            // }
            return $this->registerAgent($request);
        }catch(\Exception $e){
            return response($this->getErrorResponse($e->getMessage()));
        }
    }

    /**
     * @param $request
     * @return mixed
     * @method showAvailableAgents
     * @purpose Show available agents on map
     */
    public function showAvailableAgents(Request $request){
        $latitude = '48.8566';
        $longitude = '2.3522';
        $location = 'Paris, France';
        if(isset($request->latitude) && isset($request->longitude)){
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $location = $request->location;
        }
        $search['latitude'] = $latitude;
        $search['longitude'] = $longitude;
        $search['location'] = $location; 
        $agents = $this->getAvailableAgents($request);
        // $this->print($agents);
        return view('available_agents',['data'=>json_encode($agents),'search'=>$search]);
    }

    /**
     * @param $request
     * @return mixed
     * @method index
     * @purpose Load customer signup view 
     */
    public function agentProfileView(){
        return view('agent.profile');
    }

}
