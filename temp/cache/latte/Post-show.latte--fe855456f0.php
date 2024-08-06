<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Post/show.latte */
final class Template_fe855456f0 extends Latte\Runtime\Template
{
	public const Source = '/home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Post/show.latte';

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
			foreach (array_intersect_key(['comment' => '91'], $this->params) as $ʟ_v => $ʟ_l) {
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

		echo '<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL PŘÍSPĚVKU - WAR BLOG</title>
    <link href="path/to/bootstrap.min.css" rel="stylesheet">
    <style>
        .comments {
            margin-top: 20px;
        }

        .comment-card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .comment-card-body {
            padding: 15px;
        }

        .post-card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg w-100 shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 fs-2 text-white" style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">
        <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 35 */;
		echo '" class="text-white text-decoration-none">WAR \\ BLOG</a>
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
';
		if ($user->isInRole('admin')) /* line 43 */ {
			echo '                        <a class="nav-link btn btn-success text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:default')) /* line 44 */;
			echo '">Administrace</a>
';
		}
		echo '                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 48 */;
		echo '">Domů</a>
                </li>
                <li class="nav-item">
';
		if (!$user->isLoggedIn()) /* line 51 */ {
			echo '                        <a class="nav-link btn btn-primary text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:in')) /* line 52 */;
			echo '">Přihlásit se</a>
';
		} else /* line 53 */ {
			echo '                        <a class="nav-link btn btn-danger text-white" href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:out')) /* line 54 */;
			echo '">Odhlásit se</a>
';
		}
		echo '                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card post-card">
        <div class="card-body">
            <h1>';
		echo LR\Filters::escapeHtmlText($post->title) /* line 65 */;
		echo '</h1>
            <div class="post">';
		echo LR\Filters::escapeHtmlText($post->content) /* line 66 */;
		echo '</div>
            <br>
';
		if (isset($post->image)) /* line 68 */ {
			echo '                <img src="';
			echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 69 */;
			echo '/';
			echo LR\Filters::escapeHtmlAttr($post->image) /* line 69 */;
			echo '" alt="Obrázek k článku ';
			echo LR\Filters::escapeHtmlAttr($post->title) /* line 69 */;
			echo '" style="max-width: 500px; height: auto;">
';
		}
		echo '            <br>
            <br>
';
		if ($user->isLoggedIn() && ($user->id === $post->user_id || $user->isInRole('admin'))) /* line 73 */ {
			echo '            <div class="action-buttons">
                <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$post->id])) /* line 75 */;
			echo '" class="btn btn-primary text-white">Upravit příspěvek</a>
                <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('deletePost!', [$post->id])) /* line 76 */;
			echo '" class="btn btn-danger text-white">Smazat příspěvek</a>
            </div>
';
		}
		echo '            <br>
            <div class="views mt-auto text-success">Zobrazení: ';
		echo LR\Filters::escapeHtmlText($post->views) /* line 80 */;
		echo '</div>
            <div class="date">';
		echo LR\Filters::escapeHtmlText(($this->filters->date)($post->created_at, 'F j, Y')) /* line 81 */;
		echo '</div>
        </div>
    </div>
';
		if ($post->status == 'OPEN' and $user->isLoggedIn() == true) /* line 84 */ {
			echo '        <h2 class="mt-5">Napsat komentář:</h2>
';
			$ʟ_tmp = $this->global->uiControl->getComponent('commentForm');
			if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
			$ʟ_tmp->render() /* line 86 */;

		}
		echo '        <h2 class="mt-5">Komentáře:</h2>

        <div class="comments">
';
		foreach ($comments as $comment) /* line 91 */ {
			echo '                <div class="card comment-card">
                    <div class="card-body comment-card-body">
                        <p><b>';
			$ʟ_tag[0] = '';
			if ($comment->email) /* line 94 */ {
				echo '<';
				echo $ʟ_tmp = 'a' /* line 94 */;
				$ʟ_tag[0] = '</' . $ʟ_tmp . '>' . $ʟ_tag[0];
				echo ' href="mailto:';
				echo LR\Filters::escapeHtmlAttr($comment->email) /* line 94 */;
				echo '">';
			}
			echo '
                            ';
			echo LR\Filters::escapeHtmlText($comment->name) /* line 95 */;
			echo '
                        ';
			echo $ʟ_tag[0];
			echo '</b> napsal:</p>
                        <div>';
			echo LR\Filters::escapeHtmlText($comment->content) /* line 97 */;
			echo '</div>
';
			if ($user->isLoggedIn() && ($user->id === $comment->user_id || $user->isInRole('admin'))) /* line 98 */ {
				echo '                            <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:comment', [$comment->id])) /* line 99 */;
				echo '" class="btn btn-primary text-white">Upravit komentář</a>
                            <a href="';
				echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('deleteComment!', [$comment->id])) /* line 100 */;
				echo '" class="btn btn-danger text-white">Odebrat komentář</a>
';
			}
			echo '                    </div>
                </div>
';

		}

		echo '        </div>

</div>

</body>
</html>

';
	}
}
