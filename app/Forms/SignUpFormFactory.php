<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model;
use Nette\Application\UI\Form;


final class SignUpFormFactory
{

    public function __construct(
        private FormFactory $factory,
        private Model\UserFacade $userFacade,
    ) {
    }


    public function create(callable $onSuccess): Form
    {
        $form = $this->factory->create();
        $form->addText('username', 'Uživatelské jméno:')
            ->setRequired('Zadejte prosím uživatelské jméno.');

        $form->addText('surname', 'Křestní jméno:')
            ->setRequired('Zadejte prosím své křestní jméno.');

        $form->addText('lastname', 'Přijmení:')
            ->setRequired('Zadejte prosím své příjmení.');

        $form->addEmail('email', 'E-mail:')
            ->setRequired('Zadejte prosím svůj e-mail.');

        $form->addPassword('password', 'Heslo:')
            ->setOption('description', sprintf('minimálně %d znaků', $this->userFacade::PasswordMinLength))
            ->setRequired('Zvolte prosím heslo.')
            ->addRule($form::MIN_LENGTH, null, $this->userFacade::PasswordMinLength);

        $form->addSubmit('send', 'Zaregistrovat se');

        // Handle form submission
        $form->onSuccess[] = function (Form $form, \stdClass $data) use ($onSuccess): void {
            try {
                // Attempt to register a new user
                $this->userFacade->add($data->username, $data->surname, $data->lastname, $data->email, $data->password);
            } catch (Model\DuplicateNameException $e) {
                // Handle the case where the username is already taken
                $form['username']->addError('Uživatelské jméno je již zabráno.');
                return;
            }
            $onSuccess();
        };

        return $form;
    }
}