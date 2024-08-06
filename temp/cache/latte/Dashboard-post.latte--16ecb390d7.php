<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Dashboard/post.latte */
final class Template_16ecb390d7 extends Latte\Runtime\Template
{
	public const Source = '/home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Dashboard/post.latte';

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
		echo "\n";
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['p' => '62'], $this->params) as $ʟ_v => $ʟ_l) {
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

		echo '
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitální animace - Administrace</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .table-header {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>

<div class="background-rectangle"></div>
<div class="background-triangle"></div>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg w-100 shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 fs-2">Administrace - Přehled příspěvků</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:default')) /* line 31 */;
		echo '">Přehled uživatelů</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:comment')) /* line 34 */;
		echo '">Přehled komentářu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 37 */;
		echo '">Domů</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:out')) /* line 40 */;
		echo '">Odhlásit se</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Příspěvky:</h2>
    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titulek</th>
                <th scope="col">Obsah</th>
                <th scope="col">Zhlédnutí</th>
                <th scope="col">Datum vytvoření</th>
                <th scope="col">Akce</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
';
		foreach ($posts as $p) /* line 62 */ {
			echo '                <tr>
                    <td>';
			echo LR\Filters::escapeHtmlText($p->id) /* line 64 */;
			echo '</td>
                    <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Post:show', [$p->id])) /* line 65 */;
			echo '">';
			echo LR\Filters::escapeHtmlText($p->title) /* line 65 */;
			echo '</a></td>
                    <td>';
			echo LR\Filters::escapeHtmlText(($this->filters->truncate)($p->content, 100, '...')) /* line 66 */;
			echo '</td>
                    <td>';
			echo LR\Filters::escapeHtmlText($p->views) /* line 67 */;
			echo '</td>
                    <td>';
			echo LR\Filters::escapeHtmlText($p->created_at) /* line 68 */;
			echo '</td>
                    <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Edit:edit', [$p->id])) /* line 69 */;
			echo '" class="btn btn-primary text-white">Upravit</a></td>
                    <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('deletePost!', [$p->id])) /* line 70 */;
			echo '" class="btn btn-danger text-white">Smazat</a></td>
                </tr>
';

		}

		echo '        </tbody>
    </table>
</div>


</body>
</html>
';
	}
}
