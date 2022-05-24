<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Repository\UserRepository;
use App\Router\Request;

class ModifyUserStatusController extends Controller
{
    public function __invoke(Request $request): void
    {
        $userRepo = new UserRepository($this->getDBConnexion());
        $userId = $request->getMatches()[1];
        $user = $userRepo->findById($userId);
        $newStatus = $request->getData()['userform'];
        $user->setStatus($newStatus);
        $userRepo->modifyUserStatus($user, $userId);
        header('Location: /administration');
    }
}