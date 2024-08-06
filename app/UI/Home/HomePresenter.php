<?php

namespace App\Presenters;

use App\Model\PostFacade;
use Nette;

final class HomePresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private PostFacade $facade,
	) {
	}
	
	public function renderDefault(int $page = 1): void { 
		$this->template->posts = $this->facade
		   ->getPublicArticles()
		   ->limit(5);
		   $articlesCount = $this->facade->getPublishedArticlesCount();
		   $paginator = new Nette\Utils\Paginator;
		   $paginator->setItemCount($articlesCount); 
		   $paginator->setItemsPerPage(4); 
		   $paginator->setPage($page);
   
		   $articles = $this->facade->getPublicArticles($paginator->getLength(), $paginator->getOffset());

		   $this->template->posts = $articles;
		   $this->template->paginator = $paginator;
		   $this->template->isLoggedIn = $this->user->isLoggedIn();
	}
	public function actionShow(int $postId) {
	    $this->flashMessage('Nemáš právo vidět archived, kámo !');
		$this->redirect('Homepage:');
	}

}

