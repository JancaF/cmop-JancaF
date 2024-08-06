<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Home/default.latte */
final class Template_f370080cf2 extends Latte\Runtime\Template
{
	public const Source = '/home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Home/default.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['post' => '32'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<header>
<h1>✪WAR\\BLOG✪</h1>
</header>
<h2>Články:</h2>
<nav class="navbar navbar-dark bg-info navbar-expand-lg w-100 shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
';
		if ($user->isInRole('admin')) /* line 14 */ {
			echo '                        <a class="nav-link btn btn-success text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:default')) /* line 15 */;
			echo '">Administrace</a>
';
		}
		echo '                </li>
                <li class="nav-item">
';
		if (!$user->isLoggedIn()) /* line 19 */ {
			echo '                        <a class="nav-link btn btn-success text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:in')) /* line 20 */;
			echo '">Přihlásit se</a>
                        <a class="nav-link btn btn-success text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:up')) /* line 21 */;
			echo '">Zaregistruj se</a>
';
		} else /* line 22 */ {
			echo '                        <a class="nav-link btn btn-primary text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:out')) /* line 23 */;
			echo '">Odhlásit se</a>
';
		}
		echo '                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
';
		foreach ($posts as $post) /* line 32 */ {
			if ($post->status != 'ARCHIVED' or $user->isLoggedIn() == true) /* line 33 */ {
				echo '                <div class="col">
                    <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Post:show', [$post->id])) /* line 35 */;
				echo '" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body bg-warning border border-3 d-flex flex-column text-dark">
                                <div class="date text-muted">Autor: ';
				echo LR\Filters::escapeHtmlText($post->user->username) /* line 38 */;
				echo ' - ';
				echo LR\Filters::escapeHtmlText(($this->filters->date)($post->created_at, 'F j, Y')) /* line 38 */;
				echo '</div>

                                <h5 class="card-title text-primary">';
				echo LR\Filters::escapeHtmlText($post->title) /* line 40 */;
				echo '</h5>
                                <p class="card-text">';
				echo LR\Filters::escapeHtmlText(($this->filters->truncate)($post->content, 100)) /* line 41 */;
				echo '</p>
';
				if (isset($post->image)) /* line 42 */ {
					echo '                                    <img src="';
					echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 43 */;
					echo '/';
					echo LR\Filters::escapeHtmlAttr($post->image) /* line 43 */;
					echo '" alt="Obrázek k článku ';
					echo LR\Filters::escapeHtmlAttr($post->title) /* line 43 */;
					echo '" class="img-fluid mb-2">
';
				}
				echo '                                <div class="views mt-auto text-success">';
				echo LR\Filters::escapeHtmlText($post->views) /* line 45 */;
				echo ' zobrazení</div>
                            </div>
                        </div>
                    </a>
                </div>
';
			}

		}

		echo '    </div>
</div>
<div class="status_write">
<h2>Výpis statusu:</h2>
<p>1. OPEN = Otevřený -> Viditelné pro všechny, komentáře pro všechny.</p>
<p>2. CLOSED = Uzavřený -> Viditelné pro všechny, komentáře jedině pro přihlášené uživatele.</p>
<p>3. ARCHIVED = Archivovaný -> Příspěvek je archivován, viditelné jedině pro přihlášené uživatele a komentáře jsou uzamčeny.</p>
</div>
';
		if ($user->isLoggedIn()) /* line 60 */ {
			echo '<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:create')) /* line 60 */;
			echo '">Vytvořit příspěvek</a>';
		}
		echo '
<div class="pagination">
';
		if (!$paginator->isFirst()) /* line 62 */ {
			echo '		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [1])) /* line 63 */;
			echo '">První</a>
		&nbsp;|&nbsp;
		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [$paginator->page - 1])) /* line 65 */;
			echo '">Předchozí</a>
		&nbsp;|&nbsp;
';
		}
		echo '
	Stránka ';
		echo LR\Filters::escapeHtmlText($paginator->getPage()) /* line 69 */;
		echo ' z ';
		echo LR\Filters::escapeHtmlText($paginator->getPageCount()) /* line 69 */;
		echo '

';
		if (!$paginator->isLast()) /* line 71 */ {
			echo '		&nbsp;|&nbsp;
		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [$paginator->getPage() + 1])) /* line 73 */;
			echo '">Další</a>
		&nbsp;|&nbsp;
		<a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default', [$paginator->getPageCount()])) /* line 75 */;
			echo '">Poslední</a>
';
		}
		echo '</div>
<footer>
<p>© 2024 - PHP_WEBSITE / CMOP BY FILIP JANČA</p>
</footer>

';
	}
}
