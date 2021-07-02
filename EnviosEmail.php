<?php

class EnviosEmail
{

    /**
     * Constantes para base de datos
     */
    const DB_HOST = 'localhost';
    const DB_DATABASE = 'envios';
    const DB_USER = 'root';
    const DB_PASS = '1234';


    /**
     * Función que realiza envíos guardándolos en bd y enviándolos
     */
    public function save($asunto, $texto)
    {
        $correo = new stdClass();
        $correo->fecha = date('Y-m-d H:i:s');
        $correo->asunto = $asunto;
        $correo->texto = $texto;

        $cn = mysqli_init();
        mysqli_options($cn, MYSQLI_OPT_LOCAL_INFILE, true);
        mysqli_real_connect($cn, self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_DATABASE);

        $sql = "INSERT INTO envios_email SET fecha = " . $correo->fecha . ", asunto = " . $correo->asunto . ", texto = " . $correo->texto;
        mysqli_query($cn, $sql);
        mysqli_close($cn);


        $this->sendEnvio($correo);
    }

    protected function sendEnvio($correo)
    {
        $para = 'angel@sudespacho.net';
        $asunto = $correo->asunto;
        $mensaje = $correo->texto;
        $cabeceras = 'From: info@sudespacho.net' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();


		mail($para, $asunto, $mensaje, $cabeceras);
    }

    public function view($asunto)
    {


        $cn = mysqli_init();
        mysqli_options($cn, MYSQLI_OPT_LOCAL_INFILE, true);
        mysqli_real_connect($cn, self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_DATABASE);

        $sql = "SELECT * FROM envios_email WHERE asunto like('%" . $asunto . "%')";
        $rs = mysqli_query($cn, $sql);

        $html = "";
        if (mysqli_num_rows($rs) > 0) {


            $html .= '<table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">Asunto</th>
            <th class="text-center">Texto</th>
           
        </tr>
        </thead>
        <tbody>';

            while ($fila = mysqli_fetch_array($rs)) {


                $html .= '<tr>
                <td class="info text-center">' . $fila["asunto"] . '</td>
                <td class="success text-center">' . $fila["texto"] . '</td>

        
            </tr>';
            }

            $html .= '</tbody>
    </table>';


        } else {
            $html .= '<div class="alert alert-info">No se encontraron resultados.</div>';
        }

        mysqli_close($cn);

        $result = array();
        $result['content'] = $html;
        $result['success'] = true;
        return json_encode($result['content']);


    }
}
