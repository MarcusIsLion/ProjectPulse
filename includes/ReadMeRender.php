<?php

class ReadmeRenderer
{
    private $filePath;

    /**
     * Constructeur pour initialiser le chemin du fichier README.
     *
     * @param string $filePath Chemin complet vers le fichier README.md
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Vérifie si le fichier README.md existe.
     *
     * @return bool Retourne true si le fichier existe, sinon false.
     */
    public function fileExists(): bool
    {
        return file_exists($this->filePath);
    }

    /**
     * Lit le contenu du fichier README.md.
     *
     * @return string Le contenu du fichier ou un message d'erreur.
     */
    public function getContent(): string
    {
        if ($this->fileExists()) {
            return file_get_contents($this->filePath);
        }
        return "No README.md file found at " . htmlspecialchars($this->filePath);
    }

    /**
     * Génère le HTML pour afficher le fichier README.md.
     *
     * @return string Le HTML complet.
     */
    public function render(): string
    {
        $content = $this->getContent();
        return "
            <h3>README.md</h3>
            <div class='readme-content'>
                $content
            </div>";
    }
}
