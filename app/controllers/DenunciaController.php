<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Denuncia.php";

class DenunciaController {

    private $db;
    private $denuncia;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->denuncia = new Denuncia($this->db);
    }

    public function index(){
        $busqueda = $_GET['busqueda'] ?? '';
        $estado = $_GET['estado'] ?? '';
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $porPagina = 10;
        
        $totalRegistros = $this->denuncia->contar($busqueda, $estado);
        $totalPaginas = ceil($totalRegistros / $porPagina);
        
        // Validar que la página no sea mayor al total de páginas
        if ($pagina > $totalPaginas && $totalPaginas > 0) {
            $pagina = $totalPaginas;
        }
        if ($pagina < 1) {
            $pagina = 1;
        }
        
        $lista = $this->denuncia->listar($busqueda, $estado, $pagina, $porPagina);
        
        // Variables para la vista
        $variables = [
            'lista' => $lista,
            'busqueda' => $busqueda,
            'estado' => $estado,
            'pagina' => $pagina,
            'totalPaginas' => $totalPaginas,
            'totalRegistros' => $totalRegistros
        ];
        
        extract($variables);
        include __DIR__ . "/../views/lista.php";
    }

    public function crear(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = [
                "titulo" => $_POST['titulo'],
                "descripcion" => $_POST['descripcion'],
                "ubicacion" => $_POST['ubicacion'],
                "estado" => $_POST['estado'] ?? "Pendiente",
                "ciudadano" => $_POST['ciudadano'],
                "telefono_ciudadano" => $_POST['telefono']
            ];

            $this->denuncia->crear($data);

            header("Location: index.php");
            exit;
        }
        include __DIR__ . "/../views/crear.php";
    }

    public function editar(){
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: index.php");
            exit;
        }
        
        $id = (int)$_GET['id'];
        $denuncia = $this->denuncia->obtener($id);

        if (!$denuncia) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                "id" => $id,
                "titulo" => $_POST['titulo'],
                "descripcion" => $_POST['descripcion'],
                "ubicacion" => $_POST['ubicacion'],
                "estado" => $_POST['estado'],
                "ciudadano" => $_POST['ciudadano'],
                "telefono_ciudadano" => $_POST['telefono'],
            ];

            $this->denuncia->actualizar($data);

            header("Location: index.php");
            exit;
        }

        include __DIR__ . "/../views/editar.php";
    }

    public function eliminar(){
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: index.php");
            exit;
        }
        
        $id = (int)$_GET['id'];
        $this->denuncia->eliminar($id);
        header("Location: index.php");
        exit;
    }

    public function obtener(){
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
            exit;
        }
        
        $id = (int)$_GET['id'];
        $denuncia = $this->denuncia->obtener($id);
        
        header('Content-Type: application/json');
        if ($denuncia) {
            echo json_encode(['success' => true, 'denuncia' => $denuncia]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Denuncia no encontrada']);
        }
        exit;
    }
}
