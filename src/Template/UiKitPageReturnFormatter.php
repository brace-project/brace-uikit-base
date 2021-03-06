<?php


namespace Brace\UiKit\Base\Template;


use Brace\Core\BraceApp;
use Brace\Core\ReturnFormatterInterface;
use Psr\Http\Message\ResponseInterface;

class UiKitPageReturnFormatter implements ReturnFormatterInterface
{

    public function __construct (
        private BraceApp $app,
        private string $diConfigName
    ){}

    public function canHandle($input): bool
    {
        if ($input instanceof Page)
            return true;
        return false;
    }

    public function transform($input): ResponseInterface
    {
        if ( ! $input instanceof Page)
            throw new \InvalidArgumentException("Input must be instance of Page");

        $tplData = $input->_getData();
        $renderer = new Renderer($tplData["tpl"]);
        $html = $renderer->render($this->app->resolve($this->diConfigName), $tplData["content"]);

        return $this->app->responseFactory->createResponseWithBody($html)->withHeader("Content-Type", "text/html");
    }
}