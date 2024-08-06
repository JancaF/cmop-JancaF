<?php
namespace App\Presenters;

use Nette;
use App\Model\PostFacade;
use Nette\Application\UI\Form;
final class PostPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $facade,
	) {
	}

    public function renderShow(int $postId): void
    {
        $post = $this->facade->getPostById($postId);
        if (!$post) {
            $this->error('Stránka nebyla nalezena');
        }
        $this->template->post = $post;
        $this->template->comments = $this->getComments($postId);
        $this->facade->addView($postId);

        if (($post->status === "ARCHIVED") && !$this->getUser()->isLoggedIn()) {
            $this->flashMessage('Nemáš právo vidět archivovaný příspěvek.');
            $this->redirect('Home:');
        }
    }
    protected function createComponentCommentForm(): Form
    {
        $form = new Form;

        $form->addTextArea('content', '')->setRequired();
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = [$this, 'commentFormSucceeded'];

        return $form;
    }
    public function commentFormSucceeded(Form $form, \stdClass $values): void
    {
        $postId = $this->getParameter('postId');
        $userId = $this->getUser()->getId();
        $content = $values->content;

        $this->facade->insertComment($postId, $userId, $content);

        $this->flashMessage('Komentář byl úspěšně přidán.', 'success');
        $this->redirect('this');
    }
    public function getComments(int $postId)
    {
        return $this->facade->getComments($postId);
    }
	public function handleDeleteComment(int $commentId, int $postId): void
    {
        $success = $this->facade->deleteComment($commentId);

        if ($success) {
            $this->flashMessage('Komentář byl úspěšně smazán.', 'success');
        } else {
            $this->flashMessage('Komentář se nepodařilo smazat.', 'error');
        }

        $this->redirect('this', ['postId' => $postId]);
    }

	public function addViews(int $postId, int $views) {
		$this->template->views = $this->facade->addViews($postId, $views);
		
		 $this->table('posts');
		 $this->count($views);
		 $this->update($views);
	}
	public function handleDeletePost(int $postId): void
    {
    $success = $this->facade->deletePost($postId);

    if ($success) {
        $this->flashMessage('Příspěvek byl smazán.', 'success');
    } else {
        $this->flashMessage('Příspěvek se nepodařilo smazat.', 'error');
    }

    $this->redirect('Home:default');
    }
    public function actionShow(int $postId)
{
    $post = $this->facade->getPostById($postId);
    if ($post === null) {
        $this->redirect('Home:default');
    }

    if (($post->status === "ARCHIVED") && !$this->getUser()->isLoggedIn()) {
        $this->flashMessage('Nemáš právo vidět archivovaný příspěvek.');
        $this->redirect('Home:');
    }
}
}

