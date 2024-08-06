<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/filip/github-classroom/ossp-cz/cmop-JancaF-2/app/UI/Dashboard/default.latte */
final class Template_cc37452a38 extends Latte\Runtime\Template
{
	public const Source = '/home/filip/github-classroom/ossp-cz/cmop-JancaF-2/app/UI/Dashboard/default.latte';

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
			foreach (array_intersect_key(['u' => '59'], $this->params) as $ʟ_v => $ʟ_l) {
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
    <title>WAR \\ BLOG - Administrace</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .table-header {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg w-100 shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 fs-2">Administrace - Přehled uživatelů</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:comment')) /* line 27 */;
		echo '">Přehled komentářů</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Dashboard:post')) /* line 30 */;
		echo '">Přehled příspěvků</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 33 */;
		echo '">Domů</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:out')) /* line 36 */;
		echo '">Odhlásit se</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Uživatelé:</h2>
    <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:up', ['back' => 'admin'])) /* line 45 */;
		echo '" class="nav-link btn btn-success text-white">Přidat nového uživatele</a>
    <br>

    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Uživatelské jméno</th>
                <th scope="col">Jméno</th>
                <th scope="col">Příjmení</th>
                <th scope="col">E-mail</th>
            </tr>
        </thead>
        <tbody>
';
		foreach ($users as $u) /* line 59 */ {
			echo '                <tr>
                    <td>';
			echo LR\Filters::escapeHtmlText($u->id) /* line 61 */;
			echo '</td>
                    <td>';
			echo LR\Filters::escapeHtmlText($u->username) /* line 62 */;
			echo '</td>
                    <td>';
			echo LR\Filters::escapeHtmlText($u->surname) /* line 63 */;
			echo '</td>
                    <td>';
			echo LR\Filters::escapeHtmlText($u->lastname) /* line 64 */;
			echo '</td>
                    <td>';
			echo LR\Filters::escapeHtmlText($u->email) /* line 65 */;
			echo '</td>
                  
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
