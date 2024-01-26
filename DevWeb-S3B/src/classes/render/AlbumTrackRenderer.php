<?php
declare(strict_types=1);
namespace iutnc\deefy\render;

require_once 'src/classes/render/Renderer.php';
// AlbumTrackRenderer.php
require_once 'AudioTrackRenderer.php';

class AlbumTrackRenderer extends AudioTrackRenderer
{


    protected function renderCompact(): string
    {
        // Logique de rendu en mode compact pour les pistes audio d'album
        return "<div class='compact-album-track'>
                    <span>{$this->track->__get('artiste')}</span>
                    <span>{$this->track->__get('album')}</span>
                </div>";
    }

    protected function renderLong(): string
    {

        // Logique de rendu en mode long pour les pistes audio d'album
        return "<div class='long-album-track'>
                    <h2>{$this->track->__get('title')}</h2>
                    <p>{$this->track->__get('artiste')}</p>
                    <p>{$this->track->__get('album')}</p>
                   
                </div>";
    }
}

