<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Dashboard/comment.latte */
final class Template_fb66b38aea extends Latte\Runtime\Template
{
	public const Source = '/home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Dashboard/comment.latte';

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
			foreach (array_intersect_key(['comment' => '49'], $this->params) as $ʟ_v => $ʟ_l) {
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

		echo '<style>
        .table-header {
            background-color: #343a40;
            color: white;
        }
    </style>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg w-100 shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 fs-2">Administrace - Přehled komentářů</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:default')) /* line 17 */;
		echo '">Přehled uživatelů</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:post')) /* line 20 */;
		echo '">Přehled příspěvků</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 23 */;
		echo '">Domů</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:out')) /* line 26 */;
		echo '">Odhlásit se</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<div class="container mt-5">
    <h2>Komentáře:</h2>
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th scope="col">Příspěvek</th>
                <th scope="col">Autor</th>
                <th scope="col">E-mail</th>
                <th scope="col">Obsah</th>
                <th scope="col">Akce</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
';
		foreach ($comments as $comment) /* line 49 */ {
			echo '            <tr>
                <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Post:show', [$comment->post->id])) /* line 51 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($comment->post->title) /* line 51 */;
			echo '</a></td>
                <td>';
			echo LR\Filters::escapeHtmlText($comment->name) /* line 52 */;
			echo '</td>
                <td>';
			$ʟ_tag[0] = '';
			if ($comment->email) /* line 53 */ {
				echo '<';
				echo $ʟ_tmp = 'a' /* line 53 */;
				$ʟ_tag[0] = '</' . $ʟ_tmp . '>' . $ʟ_tag[0];
				echo ' href="mailto:';
				echo LR\Filters::escapeHtmlAttr($comment->email) /* line 53 */;
				echo '">';
			}
			echo LR\Filters::escapeHtmlText($comment->email) /* line 53 */;
			echo $ʟ_tag[0];
			echo '</td>
                <td>';
			echo LR\Filters::escapeHtmlText(($this->filters->truncate)($comment->content, 100, '...')) /* line 54 */;
			echo '</td>
                <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:comment', [$comment->id])) /* line 55 */;
			echo '" class="btn btn-primary text-white">Upravit</a></td>
                <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('deleteComment!', [$comment->id])) /* line 56 */;
			echo '" class="btn btn-danger text-white">Odebrat</a></td>
            </tr>
';

		}

		echo '        </tbody>
    </table>
</div>
';
	}
}
