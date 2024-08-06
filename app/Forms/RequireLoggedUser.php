<?php

declare(strict_types=1);

namespace App\Forms;


trait RequireLoggedUser
{
    public function injectRequireLoggedUser(): void
    {
        $this->onStartup[] = function () {
            $user = $this->getUser();
            // If the user isn't logged in, redirect them to the sign-in page
            if ($user->isLoggedIn()) {
                return;
            } elseif ($user->getLogoutReason() === $user::LogoutInactivity) {
                $this->flashMessage('Kvůli neaktivitě jste byli odhlášeni. Přihlašte se prosím znova.');
                $this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);
            } else {
                $this->redirect('Sign:in');
            }
        };
    }
}