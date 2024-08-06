<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Model\UserFacade;
use App\Model\PostFacade;
use Nette\Application\Responses\VoidResponse;

final class DashboardPresenter extends Nette\Application\UI\Presenter
{

    use RequireLoggedUser;
    private UserFacade $userFacade;
    private PostFacade $postFacade;

    public function __construct(UserFacade $userFacade, PostFacade $postFacade)
    {
        parent::__construct();
        $this->userFacade = $userFacade;
        $this->postFacade = $postFacade;
    }

    public function renderDefault()
    {
        if (!$this->user->isLoggedIn() || !$this->user->isInRole('admin')) {
            $this->flashMessage('K této stránce nemáš oprávnění', 'warning');
            $this->redirect('Sign:in');
        }
        $users = $this->userFacade->getUsers();
        $this->template->users = $users;
    }

    public function renderPost(): void
    {
        $posts = $this->postFacade->getPublicArticles();
        $this->template->posts = $posts;
    }

    public function renderComment(): void
    {
        $comments = $this->postFacade->getAllComments();
        $this->template->comments = $comments;
    }

    public function handleDeleteComment(int $commentId): void
    {
        $success = $this->postFacade->deleteComment($commentId);
        if ($success) {
            $this->flashMessage('Komentář byl úspěšně smazán.', 'success');
        } else {
            $this->flashMessage('Komentář se nepodařilo smazat.', 'error');
        }
    }

    public function handleDeleteUser(int $userId): void
    {

        if (!$this->user->isLoggedIn() || !$this->user->isInRole('admin')) {
            $this->flashMessage('K této akci nemáte oprávnění.', 'error');
            $this->redirect('default');
        }
    
        $success = $this->userFacade->deleteUser($userId);
    
        if ($success) {
            $this->flashMessage('Uživatel byl úspěšně smazán.', 'success');
        } else {
            $this->flashMessage('Uživatele se nepodařilo smazat.', 'error');
        }
    
        $this->redirect('default');
    }

    public function handleDeletePost(int $postId): void
    {
    $success = $this->postFacade->deletePost($postId);

    if ($success) {
        $this->flashMessage('Příspěvek byl úspěšně smazán.', 'success');
    } else {
        $this->flashMessage('Příspěvek se nepodařilo smazat.', 'error');
    }

    $this->redirect('Home:default');
    }
    

}
