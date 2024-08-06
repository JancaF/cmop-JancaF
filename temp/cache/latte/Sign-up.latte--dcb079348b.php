<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Sign/up.latte */
final class Template_dcb079348b extends Latte\Runtime\Template
{
	public const Source = '/home/filip/github-classroom/ossp-cz/cmop-JancaF/app/UI/Sign/up.latte';

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


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<nav class="navbar navbar-dark bg-dark navbar-expand-lg w-100 shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 fs-2">Zaregistrovat se</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Home:default')) /* line 11 */;
		echo '">Domů</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>

';
		$this->renderBlock('bootstrap-form', ['signUpForm'] + [], 'html') /* line 19 */;
		echo '
<p class="text-center"><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('in')) /* line 21 */;
		echo '">Už máte účet? Přihlašte se.</a></p>
';
	}
}
