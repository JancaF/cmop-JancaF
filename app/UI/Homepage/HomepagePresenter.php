<?php
namespace App\Presenters;

use Nette;

final class HomepagePresenter extends Nette\Application\UI\Presenter {
public function renderDefault(): void {
    $this->template->action;
    $this->flashMessage('Nemáš právo vidět archived, kámo !');
}
public function addViews(int $postId) {
    $this->template->views = $this->facade->addViews($postId, $views);
     $this->table('posts');
     $this->get($views);
}
}
