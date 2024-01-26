<?php
declare(strict_types=1);
namespace iutnc\deefy\render;

require_once 'Renderer.php';
require_once 'src/classes/audio/tracks/PodcastTrack.php';

class PodcastRenderer extends AudioTrackRenderer
{


    protected function renderCompact(): string
    {
        // Logique de rendu en mode compact pour les podcasts
        return "<div class='compact-podcast'>
                    <span>{$this->track->author}</span>
                    <span>{$this->track->genre}</span>
                </div>";
    }

    protected function renderLong(): string
    {
        // Logique de rendu en mode long pour les podcasts
        return "<div class='long-podcast'>
                    <h2>{$this->track->title}</h2>
                    <p>{$this->track->author}</p>
                    <p>{$this->track->genre}</p>
                    <p>{$this->track->duration} secondes</p>
                    <p>{$this->track->date}</p>
                    <!-- Ajoutez ici la balise audio pour le podcast -->
                </div>";
    }
}


