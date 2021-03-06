<?php
include_once("./Config/ConexaoDB.php");

class Ramal
{
    private  $nome;
    private  $numero;
    private  $statusRamalId;
    private  $ip;
    private $userId;

    public function __construct($numero, $nome,  $ip, $statusRamalId, $userId)
    {
        $this->nome = $nome;
        $this->numero = $numero;
        $this->statusRamalId = $statusRamalId;
        $this->ip = $ip;
        $this->userId = $userId;
    }
    function get_nome()
    {
        return $this->nome;
    }
    function get_numero()
    {
        return $this->numero;
    }

    function get_statusRamalId()
    {
        return $this->statusRamalId;
    }

    function get_ip()
    {
        return $this->ip;
    }
    function get_userId()
    {
        return $this->userId;
    }
    function set_nome($nome)
    {
        $this->nome = $nome;
    }
    function set_numero($numero)
    {
        $this->numero = $numero;
    }

    function set_statusRamalId($statusRamalId)
    {
        $this->statusRamalId = $statusRamalId;
    }

    function set_ip($ip)
    {
        $this->ip = $ip;
    }
    function set_userId($userId)
    {
        $this->userId = $userId;
    }

    public function formatObject($obj = [])
    {
        foreach ($obj as $key => $value) {
            if (is_array($value)) $array[$key] = new ArrayObject($value);
        }
        return $obj;
    }


    public function create(Ramal $ramal)
    {
        var_dump($ramal->get_nome());
        $db = new MYSQL();
        $stm = $db->returnConnection();
        $row = $stm->query("INSERT INTO ramal(numero, nome, ip, statusRamalId,userId) VALUES ('$ramal->numero','$ramal->nome','$ramal->ip','$ramal->statusRamalId','$ramal->userId')");
        var_dump($row ? "deu certo" : "deu ruim");
    }
    public function readAll()
    {
        $db = new MYSQL();
        $stm = $db->returnConnection();
        $row = $stm->query("SELECT ra.numero,ra.nome,ra.ip,c.statusRamal  as StatusRamal, u.name as NomeUser  FROM ramais.ramal as ra  inner join usuarios u on u.id = ra.userId  inner join callcenter c  on c.id = ra.statusRamalId ;");
        $results = $this->formatObject($row->fetchAll());
        return json_encode($results);
    }
}
