<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\CvDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    private $commands;
    private $validations;

    public function __construct()
    {
        $this->commands = DB::select('select * from commands');
        $this->validations = [
            "name" => ["name" => ["required"]],
            "email" => ["email" => ["required", "email:rfc,dns"]],
            "phone" => ["phone" => ["required", "min:11", "max:15"]],
            "address" => ["address" => ["required"]],
            "keywords" => ["keywords" => ["required"]],
            "skills" => ["skills" => ["required"]],
            "description" => ["description" => ["required"]],
            "education" => ["education" => ["required"]],
            "work_experiences" => ["work_experiences" => ["required"]],
            "links" => ["links" => ["required"]],
        ];
    }

    public function index() 
    {
        $response = [
            'message' => 'Hi there! Is there something I can help?',
            'data' => [
                'commands' => $this->commands,
            ]
        ];

        return response($response, 200);
    }

    public function chat(Request $request) 
    {
        $user = $this->getUser($request->input('username'));
        
        $parameter = $request->input('parameter');
        $chat = strip_tags($request->input('message'));
        $isCreatingCV = $request->input('createcv') ? true : false;

        $chat = $this->getSelectedCommandType($chat, $isCreatingCV);

        if($chat == '/help') {
            return $this->helpResponse();
        } else if($chat == '/history') {
            return $this->historyResponse($user);
        } else if ($chat == '/createcv' || $isCreatingCV) {
            return $this->chatResponse($user, $isCreatingCV, $chat, $parameter);
        } else {
            $response = [
                'message' => 'Hi there! Is there something I can help?',
                'data' => [
                    'commands' => $this->commands
                ]
            ];
    
            return response($response, 200);
        }
    }

    public function chatResponse($user, $isCreatingCV, $chat, $parameter) 
    {
        if($chat == '/createcv' && $isCreatingCV) { // Prevent /createcv dan value createcv sedang true
            $response = [
                'message' => 'You are in a create CV process.',
                'data' => [
                    'error' => 'You are in a create CV process.'
                ]
            ];

            return response($response, 400);
        }

        $attributes = (new CvDetail())->getFillable();

        $lastCv = Cv::whereUserId($user->id)->latest()->first();

        if(!$lastCv || $lastCv->url_cv !== null || !$isCreatingCV) { // Belum pernah bikin cv atau yang sebelumnya sudah selesai
            $this->createCv($user->id);

            $response = [
                'message' => 'Please follow this format for making your awesome CV!',
                'data' => [
                    "createcv" => true,
                    "parameter" => "name",
                ]
            ];
            return response($response, 200);
        } else {
            $lastCvDetails = CvDetail::whereCvId($lastCv->id)->first();

            foreach($attributes as $attribute) {
                if($lastCvDetails[$attribute] == null) {
                    if(!$parameter || !$chat) {
                        $response = [
                            'message' => 'Parameter or value cannot be empty!',
                            'data' => [
                                "createcv" => true,
                                "parameter" => $attribute,
                                "error" => "Parameter or value cannot be empty!"
                            ]
                        ];
                        return response($response, 400);
                    }
                }
            }

            $validator = Validator::make([$parameter => $chat], $this->validations[$parameter]);

            if($validator->fails()) {
                $response = [
                    'message' => $validator->errors()->first(),
                    'data' => $validator->errors()
                ];
                return response($response, 400);
            }

            CvDetail::whereCvId($lastCv->id)->update([
                $parameter => $chat
            ]);

            $lastCvDetails = $lastCvDetails->fresh();

            foreach($attributes as $attribute) {
                if($lastCvDetails[$attribute] == null) {
                    $response = [
                        'message' => 'Please follow this format for making your awesome CV!',
                        'data' => [
                            "createcv" => true,
                            "parameter" => $attribute,
                        ]
                    ];
                    return response($response, 200);
                }
            }

            $lastCv->update([
                'url_cv' => route('download-cv', ['cv' => $lastCv->id])
            ]);

            $response = [
                'message' => 'Your CV is complete!',
                'data' => [
                    "url_cv" => route('download-cv', ['cv' => $lastCv->id])
                ]
            ];

            return response($response, 200);
        }
    }

    public function historyResponse($user)
    {
        $cvs = Cv::whereUserId($user->id)->latest()->take(5)->get();

        $response = [
            'message' => 'List all created CVs.',
            'data' => [
                'cvs' => $cvs
            ]
        ];

        return response($response, 200);
    }

    public function helpResponse() 
    {
        $response = [
            'message' => 'Available commands.',
            'data' => [
                'commands' => $this->commands
            ]
        ];

        return response($response, 200);
    }

    public function getUser($username)
    {
        $user = User::whereUsername($username)->first();

        if(!$user) {
            $response = [
                'message' => 'User not found.',
                'data' => [
                    'error' => 'User not found.'
                ]
            ];

            return response($response, 404);
        }

        return $user;
    }

    public function getSelectedCommandType($chat, $isCreatingCV)
    {
        $selectedCommandType = '';
        foreach($this->commands as $index => $command) {
            if($chat == $command->command) {
                $selectedCommandType = $command->command;
            }
        }

        if($selectedCommandType == '' && !$isCreatingCV) {
            $response = [
                'message' => 'Please input the command as instructed.',
                'data' => [
                    'error' => 'Please input the command as instructed.'
                ]
            ];

            return response($response, 400);
        } else {
            $selectedCommandType = $chat;
        }

        return $selectedCommandType;
    }

    public function createCv($userId)
    {
        $cv_id = Cv::create([
            'user_id' => $userId
        ])->id;

        CvDetail::create([
            'cv_id' => $cv_id
        ]);
    }
}
