<?php
declare(strict_types=1);
namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AudioTrack;

require_once 'Renderer.php';

abstract class AudioTrackRenderer implements Renderer
{
    protected $track;

    public function __construct(AudioTrack $track)
    {
        $this->track = $track;
    }


    public function render(int $selector): string
    {
        $html = "<span>{$this->track->__get('title')}</span>";

        switch ($selector) {
            case Renderer::COMPACT:
                $html .= $this->renderCompact();
                break;
            case Renderer::LONG:
                $html .= $this->renderLong();
                break;
        }

        return $html;
    }

    abstract protected function renderCompact(): string;

    abstract protected function renderLong(): string;
}
