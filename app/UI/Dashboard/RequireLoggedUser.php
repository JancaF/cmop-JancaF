<?php

declare(strict_types=1);

namespace App\Presenters;


trait RequireLoggedUser
{
	public function injectRequireLoggedUser(): void
	{
		$this->onStartup[] = function () {
			$user = $this->getUser();
			if ($user->isLoggedIn()) {
				return;
			} elseif ($user->getLogoutReason() === $user::LogoutInactivity) {
				$this->flashMessage('Kvůli neaktivitě jste byl odhlášen. Přihlašte se prosím znova.');
				$this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);
			} else {
				$this->redirect('Sign:in');
			}
		};
	}
}
