<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\GoalModel;
use App\Models\GoalRealisedModel;
use App\Models\FriendRelation;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $rankingFriend = $userModel->getFriendsRanking($loggedInUserId);
        $rankingWorld = $userModel->getWorldRanking();
        $goalModel = new GoalModel();
        $goals = $goalModel->getWeekGoals();

        $goalRealisedModel = new GoalRealisedModel();
        $goalsRealised = $goalRealisedModel->goalsRealised($loggedInUserId);

        $data = [
            "rankingFriend" => $rankingFriend,
            "rankingWorld" => $rankingWorld,
            'userInfo' => $userInfo,
            'goals' => $goals,
            'goalsRealised' => $goalsRealised,
        ];


        return view('dashboard/index', $data);
    }

    public function goals()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $goalModel = new GoalModel();
        $goals = $goalModel->getWeekGoals();

        $goalRealisedModel = new GoalRealisedModel();
        $goalsRealised = $goalRealisedModel->goalsRealised($loggedInUserId);
        

        $data = [
            'userInfo' => $userInfo,
            'goals' => $goals,
            'goalsRealised' =>$goalsRealised,
        ];

        return view('goals/goalsweek', $data);
    }

    public function validateGoal()
    {
        $request = service('request');

        // Vérifiez si la requête est de type AJAX
        if ($request->isAJAX()) {
            $loggedInUserId = session()->get('loggedInUser');
            $goalId = $request->getVar('goal_id');

            try {
                // Insérer le nouvel enregistrement dans la table greenshift_goalrealised en utilisant le modèle GoalRealisedModel
                $goalRealisedModel = new GoalRealisedModel();
                $goalRealisedModel->addGoalRealised($loggedInUserId, $goalId);

                // Récupérer la valeur de l'objectif validé
                $earning = $goalRealisedModel->getGoalEarning($goalId);

                // Mettre à jour les points de l'utilisateur
                $userModel = new UserModel();
                $userModel->updatePoints($loggedInUserId, $earning);

                return $this->response->setJSON(['success' => true]);
            } catch (\Exception $e) {
                // Log the exception
                log_message('error', 'Error in validateGoal(): ' . $e->getMessage());

                // Return error response
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to validate goal.']);
            }
        }

        return $this->response->setStatusCode(403);
    }

    public function addFriend()
    {
        $request = service('request');

        // Vérifiez si la requête est de type AJAX
        if ($request->isAJAX()) {
            $loggedInUserId = session()->get('loggedInUser');
            $friendId = $request->getVar('id_friend');

            try {
                // Insérer le nouvel enregistrement dans la table greenshift_goalrealised en utilisant le modèle GoalRealisedModel
                $friendRelation = new FriendRelation();
                $friendRelation->addRelation($loggedInUserId, $friendId);

                return $this->response->setJSON(['success' => true]);
            } catch (\Exception $e) {
                // Log the exception
                log_message('error', 'Error in validateGoal(): ' . $e->getMessage());

                // Return error response
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to validate goal.']);
            }
        }

        return $this->response->setStatusCode(403);
    }


    public function relation()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        if ($this->request->isAJAX()) {
            $people = strval($this->request->getGet('search'));
            $users = $userModel->searchUsers($people, $loggedInUserId);
            return $this->response->setJSON($users);
        }

        $data = [
            'userInfo' => $userInfo,
        ];

        return view('relation/search', $data);
    }


    public function relationView()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $friends = $userModel->getFriendsRanking($loggedInUserId);

        if ($this->request->isAJAX()) {
            $people = $this->request->getGet('data');
        } else {
            $people = [];
        }

        $data = [
            'userInfo' => $userInfo,
            'people' => $people,
            'friends' => $friends,
        ];

        return view("classement/searchFriend", $data);
    }
}
