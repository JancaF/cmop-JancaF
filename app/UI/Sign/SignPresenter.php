<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\DuplicateNameException;
use App\Model\UserFacade;
use App\Forms\FormFactory;
use Nette;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Form;


/**
 * Presenter for sign-in and sign-up actions.
 */
final class SignPresenter extends Nette\Application\UI\Presenter
{
	/**
	 * Stores the previous page hash to redirect back after successful login.
	 */
	#[Persistent]
	public string $backlink = '';


	// Dependency injection of form factory and user management facade
	public function __construct(
		private UserFacade $userFacade,
		private FormFactory $formFactory,
	) {
	}


	protected function createComponentSignInForm(): Form
	{
		$form = $this->formFactory->create();
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Zadejte prosím své uživatelské jméno.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadejte prosím své heslo.');

		$form->addSubmit('send', 'Přihlásit se');

		$form->onSuccess[] = function (Form $form, \stdClass $data): void {
			try {
				$this->getUser()->login($data->username, $data->password);
				$this->restoreRequest($this->backlink);
				$this->redirect('Home:default');
			} catch (Nette\Security\AuthenticationException) {
				$form->addError('Nesprávné uživatelské jméno nebo heslo.');
			}
		};

		return $form;
	}

	protected function createComponentSignUpForm(): Form
	{
		$form = $this->formFactory->create();
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Zadejte prosím uživatelské jméno.');

		$form->addText('surname', 'Křestní jméno:')
			->setRequired('Zadejte prosím své křestní jméno.');

		$form->addText('lastname', 'Příjmení:')
			->setRequired('Zadejte prosím své přijmení.');

		$form->addEmail('email', 'Váš e-mail:')
			->setRequired('Zadejte prosím váš e-mail.');

		$form->addPassword('password', 'Heslo:')
			->setOption('description', sprintf('potřeba alespoň %d znaků', $this->userFacade::PasswordMinLength))
			->setRequired('Zadejte prosím heslo.')
			->addRule($form::MinLength, null, $this->userFacade::PasswordMinLength);

		$form->addSubmit('send', 'Zaregistrovat se');

		$form->onSuccess[] = function (Form $form, \stdClass $data): void {
			try {
				$this->userFacade->add($data->username, $data->surname, $data->lastname, $data->email, $data->password);
				$this->redirect('Dashboard:');
			} catch (DuplicateNameException) {
				$form['username']->addError('Uživatelské jméno je již zabráno.');
			}
		};

		return $form;
	}

	public function actionOut(): void
	{
		$this->getUser()->logout();
	}
}
