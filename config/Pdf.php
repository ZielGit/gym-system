<?php

namespace Config;

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    private $dompdf;

    public function __construct()
    {
        // Configuración de Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Permite cargar archivos remotos como imágenes

        // Inicializar Dompdf con opciones
        $this->dompdf = new Dompdf($options);
    }

    /**
     * Cargar una vista y generar el contenido HTML.
     *
     * @param string $view El archivo de vista a cargar.
     * @param array $data Datos a pasar a la vista.
     * @return string El contenido HTML renderizado.
     */
    public function loadView($view, $data = [])
    {
        // Convertir notación de puntos a rutas (ej: 'admin.plans' => 'admin/plans.php')
        $viewPath = realpath(__DIR__ . "/../views/" . str_replace('.', '/', $view) . ".php");

        // Verificar si la vista existe
        if (!file_exists($viewPath)) {
            throw new \Exception("View [{$view}] not found.");
        }

        // Extraer los datos como variables
        extract($data);

        // Iniciar el buffer de salida
        ob_start();
        include $viewPath;
        $html = ob_get_clean();

        return $html;
    }

    /**
     * Generar PDF desde HTML o una vista
     *
     * @param string $html Contenido HTML a renderizar en el PDF
     * @param string|null $filename Nombre del archivo PDF a descargar (si es null, solo se muestra)
     */
    public function generate($html, $filename = null)
    {
        // Cargar el HTML en Dompdf
        $this->dompdf->loadHtml($html);

        // Opcionalmente, configurar el tamaño de la página y la orientación
        $this->dompdf->setPaper('A4', 'portrait'); // Tamaño y orientación (vertical)

        // Renderizar el PDF
        $this->dompdf->render();

        // Descargar el PDF o mostrar en pantalla
        if ($filename) {
            $this->dompdf->stream($filename, ["Attachment" => true]); // Descargar
        } else {
            $this->dompdf->stream(); // Mostrar en pantalla
        }
    }
}
