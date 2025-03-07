<?php
abstract class Artista
{
    public string $nombre = "";
    private int $edad = 0;
    public bool $genero = true;

    public function __construct(string $nombre, int $edad, bool $genero )
    {
        $this->nombre = $nombre;
        $this->setEdad($edad);
        $this->genero = $genero;
    }
    public function __toString(): string
    {
        return json_encode([
            'Nombre Artista'   => $this->nombre,
            'Edad'             => $this->edad,
            'genero'           => $this->genero ? "Femenino" : "Masculino"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
        public function setEdad(int $edad): void
        {
            if ($edad > 0) {
                $this->edad = $edad;
            }
        }
        public function getEdad(): int
        {
            return $this->edad;
        }  
    
}

class Musico extends Artista {
    public string $instrumento;
}
